<?php
// funcionarios.php - PhishGuard

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco
$mysqli = new mysqli("localhost", "root", "", "bd_funcionario");
if ($mysqli->connect_error) {
    die("Erro ao conectar: " . $mysqli->connect_error);
}

function esc($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

/* ----------------------------------------------------
   PROCESSA AÇÕES (ADD / EDIT / DELETE)
------------------------------------------------------*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // ADD
    if ($action === 'add') {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $cargo = trim($_POST['cargo']);

        if ($nome && $email && $cargo) {
            $stmt = $mysqli->prepare("INSERT INTO funcionarios (nome, email, cargo) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $cargo);
            $stmt->execute();
        }

        header("Location: funcionarios.php");
        exit;
    }

    // EDIT
    if ($action === 'edit') {
        $id = (int)$_POST['id'];
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $cargo = trim($_POST['cargo']);

        if ($id && $nome && $email && $cargo) {
            $stmt = $mysqli->prepare("UPDATE funcionarios SET nome=?, email=?, cargo=? WHERE id=?");
            $stmt->bind_param("sssi", $nome, $email, $cargo, $id);
            $stmt->execute();
        }

        header("Location: funcionarios.php");
        exit;
    }

    // DELETE
    if ($action === 'delete') {
        $id = (int)$_POST['id'];
        if ($id) {
            $stmt = $mysqli->prepare("DELETE FROM funcionarios WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }

        header("Location: funcionarios.php");
        exit;
    }
}

/* ----------------------------------------------------
   BUSCA
------------------------------------------------------*/
$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM funcionarios";
$params = [];

if ($q !== '') {
    $sql .= " WHERE nome LIKE ? OR email LIKE ? OR cargo LIKE ?";
    $like = "%$q%";
    $params = [$like, $like, $like];
}

$sql .= " ORDER BY id DESC";

if ($params) {
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $params[0], $params[1], $params[2]);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = $mysqli->query($sql);
}

$funcionarios = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Funcionários | PhishGuard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEU STYLE.CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        /* --- Ajustes específicos desta página --- */

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

        .btn-add {
            background: #14b854;
            color: #fff;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
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

        .btn-edit {
            background: #e6b800;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-del {
            background: #d13232;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .card {
            background: rgba(255,255,255,0.05);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .form-inline input,
        .form-inline select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 220px;
        }

        .flex {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
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
            <a href="funcionarios.php" class="active">BD - Funcionários</a>
            <a href="consultar_links.php">Consulta de Links</a>
            <a href="brandbook.php">Brandbook</a>
        </nav>
    </div>

    <div class="header-user">
        <div class="header-user-icon"></div>
        <span>Administrador</span>
    </div>
</header>

<main class="main-container">

    <h1 class="page-title">Funcionários</h1>
    <p class="page-subtitle">Gerencie os funcionários cadastrados no sistema.</p>

    <!-- AÇÕES SUPERIOR -->
    <div class="page-actions">
        <form method="get">
            <input type="search" name="q" value="<?= esc($q) ?>" class="search-input" placeholder="Pesquisar funcionário...">
        </form>

        <button id="btnShowAdd" class="btn-add">+ Adicionar Funcionário</button>
    </div>

    <!-- FORM ADD -->
    <div id="formAdd" class="card" style="display:none;">
        <form method="POST" class="flex">
            <input type="hidden" name="action" value="add">

            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="E-mail" required>

            <select name="cargo" required>
                <option value="">Cargo...</option>
                <option>Analista</option>
                <option>Administrador</option>
                <option>Suporte</option>
                <option>Desenvolvedor</option>
            </select>

            <button class="btn-add" type="submit">Salvar</button>
        </form>
    </div>

    <!-- TABELA -->
    <div class="card">
        <?php if (!$funcionarios): ?>
            <p>Nenhum funcionário encontrado.</p>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th style="width:160px;">Ações</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($funcionarios as $f): ?>
                    <tr>
                        <td><?= esc($f['id']) ?></td>
                        <td><?= esc($f['nome']) ?></td>
                        <td><?= esc($f['email']) ?></td>
                        <td><?= esc($f['cargo']) ?></td>

                        <td>

                            <!-- EDITAR -->
                            <button class="btn-edit" onclick="showEdit(<?= $f['id'] ?>)">Editar</button>

                            <!-- EXCLUIR -->
                            <form method="post" style="display:inline;" onsubmit="return confirm('Excluir funcionário?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $f['id'] ?>">
                                <button class="btn-del" type="submit">Excluir</button>
                            </form>

                        </td>
                    </tr>

                    <!-- FORM EDITAR -->
                    <tr id="edit-<?= $f['id'] ?>" style="display:none; background:#0f1c3b;">
                        <td colspan="5">
                            <form method="POST" class="flex">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= $f['id'] ?>">

                                <input type="text" name="nome" value="<?= esc($f['nome']) ?>" required>
                                <input type="email" name="email" value="<?= esc($f['email']) ?>" required>

                                <select name="cargo" required>
                                    <option <?= $f['cargo']=="Analista" ? "selected":"" ?>>Analista</option>
                                    <option <?= $f['cargo']=="Administrador" ? "selected":"" ?>>Administrador</option>
                                    <option <?= $f['cargo']=="Suporte" ? "selected":"" ?>>Suporte</option>
                                    <option <?= $f['cargo']=="Desenvolvedor" ? "selected":"" ?>>Desenvolvedor</option>
                                </select>

                                <button class="btn-add" type="submit">Salvar</button>
                                <button type="button" class="btn-del" onclick="hideEdit(<?= $f['id'] ?>)">Cancelar</button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</main>

<footer>© 2025 PhishGuard. All rights reserved.</footer>

<script>
    // Toggle form de adicionar
    const btnShowAdd = document.getElementById("btnShowAdd");
    const formAdd = document.getElementById("formAdd");

    btnShowAdd.onclick = () => {
        formAdd.style.display = formAdd.style.display === "none" ? "block" : "none";
    };

    // Mostrar e esconder edição
    function showEdit(id) {
        document.querySelectorAll('[id^="edit-"]').forEach(e => e.style.display = 'none');
        document.getElementById("edit-"+id).style.display = "table-row";
    }
    function hideEdit(id) {
        document.getElementById("edit-"+id).style.display = "none";
    }
</script>

</body>
</html>
