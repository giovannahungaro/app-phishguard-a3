<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Brandbook | PhishGuard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: #010914;
            color: #e5e5e5;
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
        }

        .section {
            padding: 60px 10%;
            animation: fadeIn 1.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1, h2 {
            color: #57a5ff;
            text-shadow: 0 0 10px rgba(87,165,255,0.4);
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.9rem;
            margin-top: 50px;
        }

        p {
            color: #cfcfcf;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        .card {
            background: rgba(255,255,255,0.05);
            padding: 22px;
            border-radius: 12px;
            border: 1px solid rgba(87,165,255,0.18);
            margin-top: 18px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 15px rgba(87,165,255,0.25);
        }

        .colors {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .color-box {
            padding: 18px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
        }

        .color-preview {
            width: 100%;
            height: 60px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .contact {
            text-align: center;
            margin-top: 70px;
            padding: 40px;
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        .contact a {
            color: #57a5ff;
            text-decoration: none;
            font-weight: bold;
        }

        .contact a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header>
    <div class="header-left">
        <div class="logo-icon"></div>
        <div class="header-title">PhishGuard</div>

        <nav>
            <a href="index.html">Home</a>
            <a href="funcionarios.php">BD - Funcionários</a>
            <a href="consultar_links.php">Consulta de Links</a>
            <a href="brandbook.php" class="active">Brandbook</a>
        </nav>
    </div>

    <div class="header-user">
        <div class="header-user-icon"></div>
        <span>Administrador</span>
    </div>
</header>


<main class="main-container">

    <h1 class="page-title">Brandbook</h1>
    <p class="page-subtitle">Identidade visual do projeto PhishGuard</p>

    <!-- INTRO -->
    <div class="section">
        <h1>PhishGuard – Identidade Visual</h1>

        <p>
            O <strong>PhishGuard</strong> é uma plataforma criada com o objetivo de combater e prevenir ataques de phishing por meio de análises inteligentes de URLs.
            <br><br>
            O projeto nasceu em <strong>2025</strong>, desenvolvido pelos alunos da 
            <strong>Universidade Anhembi Morumbi</strong>:
            <br><br>
            <strong>Júlia Cardoso</strong>, 
            <strong>Giovanna Hungaro</strong>, 
            <strong>Gustavo H. Silva</strong>, 
            <strong>Kennedy Aragão</strong> e 
            <strong>Guilherme Mesquita</strong>.
        </p>
    </div>

    <!-- TIPOGRAFIA -->
    <div class="section">
        <h2>Tipografia Oficial</h2>

        <div class="card">
            <p><strong>Fonte Principal:</strong> Poppins</p>
            <p><strong>Fonte Secundária:</strong> Arial (fallback)</p>
            <p>Utilizadas para transmitir uma personalidade moderna, tecnológica e profissional.</p>
        </div>
    </div>

    <!-- CORES -->
    <div class="section">
        <h2>Cores da Marca</h2>
        <p>A paleta foi definida para refletir segurança, confiança e tecnologia.</p>

        <div class="colors">

            <div class="color-box">
                <div class="color-preview" style="background:#010914;"></div>
                <strong>Azul Marinho Escuro</strong>
                <p>#010914<br>RGB (1, 9, 20)</p>
            </div>

            <div class="color-box">
                <div class="color-preview" style="background:#0F1E36;"></div>
                <strong>Azul Secundário</strong>
                <p>#0F1E36<br>RGB (15, 30, 54)</p>
            </div>

            <div class="color-box">
                <div class="color-preview" style="background:#57A5FF;"></div>
                <strong>Azul Primário</strong>
                <p>#57A5FF<br>RGB (87, 165, 255)</p>
            </div>

            <div class="color-box">
                <div class="color-preview" style="background:#C6C6C6;"></div>
                <strong>Cinza</strong>
                <p>#C6C6C6<br>RGB (198, 198, 198)</p>
            </div>

            <div class="color-box">
                <div class="color-preview" style="background:#FFD447;"></div>
                <strong>Amarelo</strong>
                <p>#FFD447<br>RGB (255, 212, 71)</p>
            </div>

            <div class="color-box">
                <div class="color-preview" style="background:#FF4B4B;"></div>
                <strong>Vermelho</strong>
                <p>#FF4B4B<br>RGB (255, 75, 75)</p>
            </div>

            <div class="color-box">
                <div class="color-preview" style="background:#42FF8E;"></div>
                <strong>Verde</strong>
                <p>#42FF8E<br>RGB (66, 255, 142)</p>
            </div>

        </div>
    </div>

    <!-- CONTATO -->
    <div class="contact">
        <h2>Contatar</h2>
        <p>
            Para suporte ou informações sobre o projeto:<br>
            <a href="mailto:phishguardTeam@suporte.com">phishguardTeam@suporte.com</a>
        </p>
    </div>

</main>

<!-- FOOTER -->
<footer>© 2025 PhishGuard. All rights reserved.</footer>

</body>
</html>
