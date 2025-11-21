package com.phishguard.entity;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDateTime;

@Entity
@Table(name = "verifications")
@Data
public class Verification {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String url;

    @Enumerated(EnumType.STRING)
    private Status status; // SEGURO, SUSPEITO, MALWARE

    @Column(name = "verification_date")
    private LocalDateTime verificationDate = LocalDateTime.now();


    private Long userId;
    private Integer userAge;
    private String gender;
    private String agencyLocation;

    @Lob
    private String vtResponse; 

    public enum Status {
        SEGURO, SUSPEITO, MALWARE, INCONCLUSIVO
    }
}
