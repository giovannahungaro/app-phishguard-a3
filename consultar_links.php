<?php
// consultar_links.php - PhishGuard
ini_set('display_errors', 1);
error_reporting(E_ALL);

function esc($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

// Ler dados do CSV
$links = [];
$csvFile = 'verifications_all.csv';

if (file_exists($csvFile)) {
    $handle = fopen($csvFile, 'r');
    
    if ($handle !== false) {
        // Ler a primeira linha (cabeçalho)
        $header = fgetcsv($handle, 0, ',');
        
        // Identificar índices das colunas (adapte conforme o seu CSV)
        // Assumindo que as colunas são: url, status (ou resultado)
        $urlIndex = array_search('url', array_map('strtolower', $header));
        $statusIndex = array_search('status', array_map('strtolower', $header));
        
        // Se não encontrar 'status', tenta 'resultado'
        if ($statusIndex === false) {
            $statusIndex = array_search('resultado', array_map('strtolower', $header));
        }
        
        // Ler as linhas de dados
        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            if (count($row) > max($urlIndex, $statusIndex)) {
                $links[] = [
                    'url' => $row[$urlIndex] ?? '',
                    'status' => $row[$statusIndex] ?? ''
                ];
            }
        }
        
        fclose($handle);
    }
} else {
    // Se o arquivo não existir, usar dados de exemplo
    $links = [
        ["url" => "https://www.google.com", "status" => "Seguro"],
        ["url" => "http://sitefake.ru/login", "status" => "Malicioso"],
        ["url" => "https://meusiteprotegido.com", "status" => "Seguro"]
    ];
}

// Barra de pesquisa
$q = trim($_GET['q'] ?? '');

if ($q !== '') {
    $links = array_filter($links, function($row) use ($q) {
        return stripos($row["url"], $q) !== false ||
               stripos($row["status"], $q) !== false;
    });
}

?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Consulta de Links | PhishGuard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">

    <style>
        .page-actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input {
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.12);
            width: 320px;
            background: #0E1A36;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th {
            background: #0A1733;
            color: #E5E5E5;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .status-safe {
            color: #14b854;
            font-weight: bold;
        }

        .status-danger {
            color: #d13232;
            font-weight: bold;
        }

        .card {
            background: rgba(255,255,255,0.05);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .info-message {
            background: rgba(20, 184, 84, 0.1);
            border: 1px solid rgba(20, 184, 84, 0.3);
            color: #14b854;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header>
    <div class="header-left">
       
            <img src="logo.png" alt="PhishGuard Logo" style="width:36px; height:36px; border-radius:6px;">
        
        <div class="header-title">PhishGuard</div>

        <nav>
            <a href="index.html">Home</a>
            <a href="funcionarios.php" >BD - Funcionários</a>
            <a href="consultar_links.php" class="active">Consulta de Links</a>
            <a href="brandbook.php">Brandbook</a>
        </nav>
    </div>

    <div class="header-user">
        <div class="header-user-icon"></div>
        <span>Administrador</span>
    </div>
</header>

<main class="main-container">

    <h1 class="page-title">Consulta de Links</h1>
    <p class="page-subtitle">Verifique URLs identificadas como seguras ou maliciosas.</p>

    <?php if (file_exists($csvFile)): ?>
        <div class="info-message">
            📊 Carregados <?= count($links) ?> registros do arquivo CSV
        </div>
    <?php endif; ?>

    <div class="page-actions">
        <form method="get">
            <input type="search" name="q" value="<?= esc($q) ?>" class="search-input" placeholder="Pesquisar URL...">
        </form>
    </div>

    <div class="card">
        <?php if (!$links): ?>
            <p>Nenhum registro encontrado.</p>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th>Endereço da URL</th>
                    <th style="width:180px;">Resultado da análise</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($links as $l): ?>
                    <tr>
                        <td><?= esc($l['url']) ?></td>
                        <td>
                            <?php if (strtolower($l['status']) === 'seguro'): ?>
                                <span class="status-safe">Seguro</span>
                            <?php else: ?>
                                <span class="status-danger">Malicioso</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</main>

<footer>© 2025 PhishGuard. All rights reserved.</footer>

</body>
</html>
