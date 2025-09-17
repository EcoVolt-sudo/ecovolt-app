<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVolt - Ranking</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">⚡ EcoVolt</div>
        <div class="nav-menu">
            <a href="?action=dashboard">Dashboard</a>
            <a href="?action=game">Jogo</a>
            <a href="?action=ranking" class="active">Ranking</a>
            <a href="?action=logout">Sair</a>
        </div>
    </nav>

    <div class="container">
        <div class="ranking-header">
            <h2>🏆 Ranking dos Eco Warriors</h2>
            <p>Os maiores economizadores de energia</p>
        </div>

        <div class="ranking-list">
            <?php foreach ($ranking as $index => $player): ?>
                <div class="ranking-item <?= $player['username'] === $_SESSION['username'] ? 'current-user' : '' ?>">
                    <div class="rank">
                        <?php if ($index === 0): ?>
                            🥇
                        <?php elseif ($index === 1): ?>
                            🥈
                        <?php elseif ($index === 2): ?>
                            🥉
                        <?php else: ?>
                            <?= $index + 1 ?>º
                        <?php endif; ?>
                    </div>
                    <div class="player-info">
                        <div class="username"><?= $player['username'] ?></div>
                        <div class="level">Nível <?= $player['level'] ?></div>
                    </div>
                    <div class="points"><?= $player['points'] ?> pts</div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="ranking-actions">
            <a href="?action=game" class="btn-primary">Completar Tarefas</a>
            <a href="?action=dashboard" class="btn-secondary">Voltar ao Dashboard</a>
        </div>
    </div>

    <script src="public/js/app.js"></script>
</body>
</html>