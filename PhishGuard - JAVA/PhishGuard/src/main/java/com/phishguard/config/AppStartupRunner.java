package com.phishguard.config;

import com.phishguard.entity.Usuario;
import com.phishguard.repository.UsuarioRepository;
import org.springframework.boot.ApplicationArguments;
import org.springframework.boot.ApplicationRunner;
import org.springframework.stereotype.Component;

@Component
public class AppStartupRunner implements ApplicationRunner {

    private final UsuarioRepository usuarioRepository;
    private final CurrentUser currentUser;

    public AppStartupRunner(UsuarioRepository usuarioRepository, CurrentUser currentUser) {
        this.usuarioRepository = usuarioRepository;
        this.currentUser = currentUser;
    }

    @Override
    public void run(ApplicationArguments args) {
        Usuario u = new Usuario();
        String ts = String.valueOf(System.currentTimeMillis());
        u.setFullName("runtime_user_" + ts);
        u.setEmail("runtime_user_" + ts + "@local");
        u.setPassword("auto_generated"); 
        u.setPhone("000000000");
        usuarioRepository.save(u);
        currentUser.setId(u.getId());
        System.out.println(">> Runtime user created: id=" + u.getId() + " email=" + u.getEmail());
    }
}
