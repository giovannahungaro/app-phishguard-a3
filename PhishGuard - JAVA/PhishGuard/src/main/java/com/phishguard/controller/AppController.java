package com.phishguard.controller;

import com.phishguard.service.VerificationService;
import com.phishguard.config.CurrentUser;
import com.phishguard.repository.VerificationRepository;
import com.phishguard.repository.UsuarioRepository;
import com.phishguard.entity.Verification;
import com.phishguard.entity.Verification.Status;
import jakarta.servlet.http.HttpServletResponse;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
public class AppController {

    private final VerificationService verificationService;
    private final VerificationRepository verificationRepository;
    private final UsuarioRepository usuarioRepository;
    private final CurrentUser currentUser;

    public AppController(
            VerificationService verificationService,
            VerificationRepository verificationRepository,
            UsuarioRepository usuarioRepository,
            CurrentUser currentUser
    ) {
        this.verificationService = verificationService;
        this.verificationRepository = verificationRepository;
        this.usuarioRepository = usuarioRepository;
        this.currentUser = currentUser;
    }


    @GetMapping("/")
    public String home() {
        return "home";
    }


    @PostMapping("/verificar")
    public String verificar(@RequestParam("url") String url, Model model) {

        Long runtimeUserId = currentUser.getId();
        var result = verificationService.verifyUrlAndSave(url, runtimeUserId, null, null, null);
        String status = result.get("status").toString();

        model.addAttribute("url", url);
        model.addAttribute("resultMap", result);
        model.addAttribute("userId", runtimeUserId);

        switch (status) {
            case "MALWARE":
            case "SUSPEITO":
                return "resultado_ruim";

            case "SEGURO":
                return "resultado_bom";

            default:
                return "resultado_inconclusivo";
        }
    }


    @GetMapping("/history")
    public String history(Model model) {
        List<Verification> all = verificationRepository.findAll();
        model.addAttribute("verifications", all);
        model.addAttribute("usuarioId", currentUser.getId()); // caso precise
        return "history";
    }


    @GetMapping("/history/export")
    public void exportAllVerifications(HttpServletResponse response) throws Exception {

        response.setContentType("text/csv");
        response.setHeader("Content-Disposition", "attachment; filename=verifications_all.csv");

        List<Verification> list = verificationRepository.findAll();

        StringBuilder sb = new StringBuilder();
        sb.append("ID,URL,STATUS,DATA,USER_ID,AGE,GENDER,AGENCY,VT_RESPONSE\n");

        for (Verification v : list) {
            sb.append(v.getId()).append(",")
                    .append(v.getUrl()).append(",")
                    .append(v.getStatus()).append(",")
                    .append(v.getVerificationDate()).append(",")
                    .append(v.getUserId()).append(",")
                    .append(v.getUserAge()).append(",")
                    .append(v.getGender()).append(",")
                    .append(v.getAgencyLocation()).append(",")
                    .append("\"").append(v.getVtResponse().replace("\"", "'")).append("\"\n");
        }

        response.getWriter().write(sb.toString());
    }

    @GetMapping("/usuarios/export")
    public void exportAllUsers(HttpServletResponse response) throws Exception {

        response.setContentType("text/csv");
        response.setHeader("Content-Disposition", "attachment; filename=usuarios_all.csv");

        var list = usuarioRepository.findAll();

        StringBuilder sb = new StringBuilder();
        sb.append("ID,FULL_NAME,EMAIL,PHONE,PASSWORD,TOTAL_VERIFICATIONS,MALICIOUS_COUNT\n");

        for (var u : list) {
            sb.append(u.getId()).append(",")
                    .append(u.getFullName()).append(",")
                    .append(u.getEmail()).append(",")
                    .append(u.getPhone()).append(",")
                    .append(u.getPassword()).append(",")
                    .append(u.getTotalVerifications()).append(",")
                    .append(u.getMaliciousCount())
                    .append("\n");
        }

        response.getWriter().write(sb.toString());
    }


    @PostMapping("/history/delete/{id}")
    public String deleteVerification(@PathVariable Long id) {
        verificationRepository.findById(id).ifPresent(v -> {
            Long userId = v.getUserId();
            Status status = v.getStatus();

            // remove a verificação do banco
            verificationRepository.deleteById(id);

            // atualiza contadores do usuário, se existir
            if (userId != null && userId > 0) {
                usuarioRepository.findById(userId).ifPresent(u -> {
                    // decrementa garantindo não ficar negativo
                    int total = (u.getTotalVerifications() == null ? 0 : u.getTotalVerifications());
                    int malicious = (u.getMaliciousCount() == null ? 0 : u.getMaliciousCount());

                    u.setTotalVerifications(Math.max(0, total - 1));
                    if (status == Status.MALWARE) {
                        u.setMaliciousCount(Math.max(0, malicious - 1));
                    }
                    usuarioRepository.save(u);
                });
            }
        });


        return "redirect:/history";
    }
}
