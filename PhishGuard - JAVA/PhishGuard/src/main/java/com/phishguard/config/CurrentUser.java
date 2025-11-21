package com.phishguard.config;

import org.springframework.stereotype.Component;

@Component
public class CurrentUser {
    private Long id;

    public synchronized Long getId() {
        return id;
    }

    public synchronized void setId(Long id) {
        this.id = id;
    }
}
