package com.phishguard.service;

import com.phishguard.entity.Verification;
import com.phishguard.entity.Verification.Status;
import com.phishguard.repository.VerificationRepository;
import com.phishguard.repository.UsuarioRepository;
import com.phishguard.entity.Usuario;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;
import org.springframework.web.reactive.function.client.WebClient;

import reactor.core.publisher.Mono;

import java.time.LocalDateTime;
import java.util.HashMap;
import java.util.Map;

@Service
public class VerificationService {

    private final VerificationRepository verRepository;
    private final UsuarioRepository usuarioRepository;
    private final WebClient webClient;

    @Value("${virustotal.api.key:}")
    private String virustotalApiKey;

    public VerificationService(VerificationRepository verRepository, UsuarioRepository usuarioRepository) {
        this.verRepository = verRepository;
        this.usuarioRepository = usuarioRepository;
        this.webClient = WebClient.create("https://www.virustotal.com/api/v3");
    }

    public Map<String, Object> verifyUrlAndSave(String url, Long userId, Integer userAge, String gender, String agencyLocation) {

        Map<String, Object> resp = new HashMap<>();
        Status status = Status.SEGURO;  
        String vtSummary = "";

        // ----------------------------------------------------------------------
        //  REGRAS LOCAIS BÁSICAS
        // ----------------------------------------------------------------------
        boolean localSus = url.contains("login")
                || url.contains("secure")
                || (url.contains("bradesco") && !url.startsWith("https://www.bradesco.com"));

        if (localSus) {
            status = Status.SUSPEITO;

        } else {

            // ----------------------------------------------------------------------
            //  INTEGRAÇÃO REAL COM VIRUSTOTAL 
            // ----------------------------------------------------------------------
            if (virustotalApiKey == null || virustotalApiKey.isBlank()) {
                status = Status.INCONCLUSIVO;
                vtSummary = "VT_NOT_CONFIGURED";

            } else {
                try {
                    // 1) Codifica a uro em em Base64
                    String urlBase64 = java.util.Base64.getUrlEncoder()
                            .withoutPadding()
                            .encodeToString(url.getBytes());

                    // 2) Consulta REAL no virusTotal
                    Mono<String> getMono = webClient.get()
                            .uri("/urls/" + urlBase64)
                            .header("x-apikey", virustotalApiKey)
                            .retrieve()
                            .bodyToMono(String.class);

                    String result = getMono.block();
                    vtSummary = result;

                    // olha a   resposta da api real
                    if (result.contains("\"malicious\":") && !result.contains("\"malicious\": 0")) {
                        status = Status.MALWARE;

                    } else if (result.contains("\"suspicious\":") && !result.contains("\"suspicious\": 0")) {
                        status = Status.SUSPEITO;

                    } else {
                        status = Status.SEGURO;
                    }

                } catch (Exception e) {
                    status = Status.INCONCLUSIVO;
                    vtSummary = "VT_ERROR: " + e.getMessage();
                }
            }
        }

      
        Verification v = new Verification();
        v.setUrl(url);
        v.setStatus(status);
        v.setVerificationDate(LocalDateTime.now());
        v.setUserId(userId != null ? userId : 0L);
        v.setUserAge(userAge);
        v.setGender(gender);
        v.setAgencyLocation(agencyLocation);
        v.setVtResponse(vtSummary);

        verRepository.save(v);

       
        final Status finalStatus = status;

        if (userId != null && userId > 0) {
            usuarioRepository.findById(userId).ifPresent(u -> {
                u.setTotalVerifications(u.getTotalVerifications() + 1);

                if (finalStatus == Status.MALWARE) {
                    u.setMaliciousCount(u.getMaliciousCount() + 1);
                }

                usuarioRepository.save(u);
            });
        }

        resp.put("status", status.name());
        resp.put("id", v.getId());
        resp.put("vt", vtSummary);

        return resp;
    }
}
