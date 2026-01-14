<?php
require 'config/db.php';
$id_jogo = $_GET['id'] ?? null;
if (!$id_jogo) { die("Jogo não encontrado!"); }

// Salvar Avaliação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];
    $sql_insert = "INSERT INTO avaliacoes (jogo_id, usuario_nome, nota, comentario) VALUES (?, ?, ?, ?)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([$id_jogo, $nome, $nota, $comentario]);
    header("Location: detalhes.php?id=" . $id_jogo);
    exit;
}

// Buscar Jogo e Avaliações
$stmt = $pdo->prepare("SELECT jogos.*, categorias.nome as cat_nome, plataformas.nome as plat_nome FROM jogos JOIN categorias ON jogos.categoria_id = categorias.id JOIN plataformas ON jogos.plataforma_id = plataformas.id WHERE jogos.id = ?");
$stmt->execute([$id_jogo]);
$jogo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$jogo) { die("Jogo não existe!"); }

$stmt_av = $pdo->prepare("SELECT * FROM avaliacoes WHERE jogo_id = ? ORDER BY id DESC");
$stmt_av->execute([$id_jogo]);
$avaliacoes = $stmt_av->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $jogo['titulo'] ?> - GameVault</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header><div class="container" style="margin: 0;"><h1><a href="index.php">🎮 GameVault</a></h1></div></header>

    <div class="container">
        <a href="index.php" class="btn btn-outline" style="margin-bottom: 20px;">&larr; Voltar</a>
        <div class="detail-header">
            <div class="detail-img" style="background-image: url('https://placehold.co/600x400/222/ffc107?text=<?= urlencode($jogo['titulo']) ?>');"></div>
            <div class="detail-info">
                <h1><?= $jogo['titulo'] ?></h1>
                <div><span class="badge">📂 <?= $jogo['cat_nome'] ?></span> <span class="badge">🎮 <?= $jogo['plat_nome'] ?></span></div>
                <p style="margin: 20px 0; color: #ccc;"><?= $jogo['descricao'] ?></p>
            </div>
        </div>

        <div class="reviews-box">
            <h2>Avaliações</h2>
            <form method="POST" style="margin-bottom: 30px;">
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="nome" class="form-control" placeholder="Seu Nome" required style="flex: 2;">
                    <select name="nota" class="form-control" required style="flex: 1;">
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                    </select>
                </div>
                <textarea name="comentario" class="form-control" rows="3" placeholder="Comentário..."></textarea>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>

            <?php foreach($avaliacoes as $av): ?>
                <div class="review-item">
                    <strong><?= htmlspecialchars($av['usuario_nome']) ?></strong> <span style="color: var(--accent-color);"><?= str_repeat("★", $av['nota']) ?></span>
                    <p style="margin: 5px 0; color: #ccc;">"<?= htmlspecialchars($av['comentario']) ?>"</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>