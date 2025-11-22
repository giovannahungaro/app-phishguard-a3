App PhishGuard (Projeto A3 - Bradesco)

👥 Integrantes do Grupo:

Giovanna de Souza Húngaro - 1252429573

Guilherme Araújo Mesquita - 12524228428

Gustavo Henrique da Silva - 12523161925

Júlia Cardoso Miranda - 12523173767

Kennedy de Souza Aragão - 1252423977

📌 Resumo da Proposta

O PhishGuard é um sistema web desenvolvido em Java com Spring Boot, projetado para analisar URLs e identificar possíveis golpes de phishing, uma das modalidades de fraude mais frequentes no setor financeiro.

A aplicação java:

✔ Recebe uma URL fornecida pelo usuário
✔ Aplica regras internas de detecção de phishing
✔ Consulta a API pública do VirusTotal
✔ Classifica o link como:

SEGURO

SUSPEITO

MALWARE

INCONCLUSIVO

✔ Armazena todas as verificações no banco de dados
✔ Exibe um histórico completo
✔ Permite exportar dados em CSV
✔ Cria um usuário automático a cada execução do sistema (runtime user)

A interface foi construída em Thymeleaf, seguindo layout mobile-first inspirado no padrão visual do Bradesco.

🛠️ Tecnologias Utilizadas
🔹 Linguagem

Java 17+

🔹 Framework / Backend

Spring Boot

Spring MVC

Spring Data JPA

Thymeleaf

🔹 Banco de Dados

MySQL (relacional)

🔹 Ferramentas e APIs

VirusTotal API (verificação externa de links)

WebClient (consumo da API)

🔹 Outras Funcionalidades Técnicas

Arquitetura em camadas (Controller – Service – Repository – Entity – View)

Geração de relatórios CSV

Validações internas de URL

Fluxo de telas responsivo e adequado ao mobile

🚀 Principais Funcionalidades:
✔ Verificação de URLs

Processa o link em consulta à API externa do VirusTotal.

✔ Classificação do link

Exibe interface específica para cada tipo de resultado (SEGURO / MALWARE ou MALISIOSO / INCONCLUSIVO).

✔ Histórico completo

Lista todas as URLs verificadas por qualquer usuário.

✔ Exportação de dados

CSV com todas as verificações do banco

CSV com todos os usuários cadastrados no sistema

✔ Usuário gerado automaticamente

A cada execução, o sistema cria um runtime user no banco para registrar as operações.

📦 Como Rodar o Projeto

Instale MySQL e crie o banco:

utlize os .sql disponibilizados aqui no repositorio github na pasta "Database"

Configure o application.properties:

spring.datasource.url=jdbc:mysql://localhost:3306/phishguard
spring.datasource.username=SEU_USUARIO
spring.datasource.password=SUA_SENHA
spring.jpa.hibernate.ddl-auto=update


Adicione sua API KEY do VirusTotal: (Necessario pois se não todas as verificações retornarão inconclusivo)

virustotal.api.key=SUA_KEY

Para conseguir uma key do VirusTotal acesse https://docs.virustotal.com/docs/please-give-me-an-api-key e siga as instruções.

Rodar pelo NetBeans ou Maven


Acessar no navegador pra fazer as verificações:

http://localhost:8080/

Acessar no navegador para consultar as verificações ja feitas e fazer o download do csv de usuarios e de verificações:

http://localhost:8080/history

🧪 Testes de URL

URL segura:

https://www.google.com


URL maliciosa (VirusTotal detecta):

http://malware.testing.google.test/testing


URL inconclusiva:

https://exemploqualquer.com

*Projeto foi colocado no Azure Microsoft 

Link Home: 

https://phishguard-rg-gbgmfxf7acg2f0g8.brazilsouth-01.azurewebsites.net/index.html

BD funvionario:

https://phishguard-rg-gbgmfxf7acg2f0g8.brazilsouth-01.azurewebsites.net/funcionarios.php

Consulta de Link:

https://phishguard-rg-gbgmfxf7acg2f0g8.brazilsouth-01.azurewebsites.net/consultar_links.php

Brandbook:

https://phishguard-rg-gbgmfxf7acg2f0g8.brazilsouth-01.azurewebsites.net/brandbook.php
