package com.phishguard.entity;

import jakarta.persistence.*;
import lombok.Data;

@Entity
@Table(name = "suspect_links")
@Data
public class SuspectLink {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(unique = true, nullable = false, length = 512)
    private String url;
    

    private String reason; 
}