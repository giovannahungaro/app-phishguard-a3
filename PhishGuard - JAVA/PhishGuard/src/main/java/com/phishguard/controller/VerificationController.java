package com.phishguard.controller;

import com.phishguard.service.VerificationService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api")
public class VerificationController {

    private final VerificationService verificationService;

    public VerificationController(VerificationService verificationService) {
        this.verificationService = verificationService;
    }

    @PostMapping("/scan")
    public ResponseEntity<?> scanUrl(@RequestBody Map<String, Object> requestBody) {
        String url = (requestBody.get("url") != null) ? requestBody.get("url").toString() : null;
        Long userId = null;
        Integer userAge = null;
        String gender = null;
        String agencyLocation = null;

        if (requestBody.get("userId") != null) {
            try { userId = Long.valueOf(requestBody.get("userId").toString()); } catch (Exception ignored) {}
        }
        if (requestBody.get("userAge") != null) {
            try { userAge = Integer.valueOf(requestBody.get("userAge").toString()); } catch (Exception ignored) {}
        }
        if (requestBody.get("gender") != null) {
            gender = requestBody.get("gender").toString();
        }
        if (requestBody.get("agencyLocation") != null) {
            agencyLocation = requestBody.get("agencyLocation").toString();
        }

        if (url == null || url.trim().isEmpty()) {
            return ResponseEntity.badRequest().body(Map.of("status","ERRO","mensagem","URL não fornecida"));
        }

       
        Map<String, Object> result = verificationService.verifyUrlAndSave(url, userId, userAge, gender, agencyLocation);

        return ResponseEntity.ok(result);
    }
}
