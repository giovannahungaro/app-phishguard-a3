package com.phishguard.repository;

import com.phishguard.entity.SuspectLink;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import java.util.Optional;

@Repository
public interface SuspectLinkRepository extends JpaRepository<SuspectLink, Long> {

    Optional<SuspectLink> findByUrl(String url);
}