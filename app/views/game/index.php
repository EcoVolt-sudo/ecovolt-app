<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVolt - Jogo</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">⚡ EcoVolt</div>
        <div class="nav-menu">
            <a href="?action=dashboard">Dashboard</a>
            <a href="?action=game" class="active">Jogo</a>
            <a href="?action=ranking">Ranking</a>
            <a href="?action=logout">Sair</a>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($_SESSION['new_badges'])): ?>
            <div class="badge-notification">
                <h3>🎉 Nova Badge Conquistada!</h3>
                <?php foreach ($_SESSION['new_badges'] as $badge): ?>
                    <div class="new-badge">
                        <span class="badge-icon">🏆</span>
                        <span><?= $badge['name'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['new_badges']); ?>
        <?php endif; ?>

        <div class="game-header">
            <div class="player-info">
                <h2>Olá, <?= $_SESSION['username'] ?>!</h2>
                <div class="progress-bar">
                    <div class="progress" style="width: <?= ($user['points'] % 100) ?>%"></div>
                </div>
                <p><?= $user['points'] % 100 ?>/100 para o próximo nível</p>
            </div>
        </div>

        <div class="tasks-section">
            <h3>Tarefas de Economia</h3>
            <div class="tasks-grid">
                <?php foreach ($tasks as $task): ?>
                    <div class="task-card">
                        <h4><?= $task['title'] ?></h4>
                        <div class="task-points">+<?= $task['points'] ?> pontos</div>
                        <form method="POST" action="?action=complete_task">
                            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                            <button type="submit" class="btn-complete">Completar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="badges-section">
            <h3>Suas Conquistas</h3>
            <div class="badges-grid">
                <?php foreach ($badges as $badge): ?>
                    <div class="badge earned">
                        <div class="badge-icon">🏆</div>
                        <div class="badge-name"><?= $badge['name'] ?></div>
                        <div class="badge-desc"><?= $badge['description'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="public/js/app.js"></script>
</body>
</html>