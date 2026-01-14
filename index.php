<?php
require 'config/db.php';

$busca = $_GET['busca'] ?? '';
$sql = "SELECT jogos.*, categorias.nome as categoria_nome FROM jogos JOIN categorias ON jogos.categoria_id = categorias.id";

if (!empty($busca)) {
    $sql .= " WHERE jogos.titulo LIKE :busca";
}

$stmt = $pdo->prepare($sql);
if (!empty($busca)) { $stmt->bindValue(':busca', "%$busca%"); }
$stmt->execute();
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container" style="margin: 0; width: 100%;">
            <h1><a href="index.php">🎮 GameVault</a></h1>
        </div>
    </header>

    <div class="container">
        <form method="GET" class="search-bar">
            <input type="text" name="busca" placeholder="Pesquisar jogo..." value="<?= htmlspecialchars($busca) ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <?php if(!empty($busca)): ?><a href="index.php" class="btn btn-outline">Limpar</a><?php endif; ?>
        </form>

        <div class="game-grid">
            <?php foreach($jogos as $jogo): ?>
                <div class="card">
                    <div class="card-img-placeholder" style="background-image: url('https://placehold.co/600x400/222/ffc107?text=<?= urlencode($jogo['titulo']) ?>');"></div>
                    <div class="card-body">
                        <div><span class="badge"><?= $jogo['categoria_nome']; ?></span></div>
                        <h3 class="card-title"><?= $jogo['titulo']; ?></h3>
                        <p style="color: #bbb; font-size: 0.9em; flex: 1;"><?= substr($jogo['descricao'], 0, 80) ?>...</p>
                        <a href="detalhes.php?id=<?= $jogo['id']; ?>" class="btn btn-primary" style="text-align: center; margin-top: 15px;">Ver Detalhes</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>