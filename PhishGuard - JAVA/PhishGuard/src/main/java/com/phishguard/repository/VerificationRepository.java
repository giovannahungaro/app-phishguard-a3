package com.phishguard.repository;

import com.phishguard.entity.Verification;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;

public interface VerificationRepository extends JpaRepository<Verification, Long> {


    List<Verification> findByUserId(Long userId);

}
