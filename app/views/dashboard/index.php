<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVolt - Dashboard</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">⚡ EcoVolt</div>
        <div class="nav-menu">
            <a href="?action=dashboard" class="active">Dashboard</a>
            <a href="?action=game">Jogo</a>
            <a href="?action=ranking">Ranking</a>
            <a href="?action=logout">Sair</a>
        </div>
    </nav>

    <div class="container">
        <div class="user-stats">
            <div class="stat-card">
                <h3><?= $user['points'] ?></h3>
                <p>Pontos</p>
            </div>
            <div class="stat-card">
                <h3>Nível <?= $user['level'] ?></h3>
                <p>Atual</p>
            </div>
            <div class="stat-card">
                <h3><?= count($badges) ?></h3>
                <p>Badges</p>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>Consumo de Energia</h3>
                <canvas id="consumptionChart" width="300" height="200"></canvas>
            </div>

            <div class="card">
                <h3>Tarefas Disponíveis</h3>
                <div class="task-list">
                    <?php foreach (array_slice($tasks, 0, 5) as $task): ?>
                        <div class="task-item">
                            <span><?= $task['title'] ?></span>
                            <span class="points">+<?= $task['points'] ?>pts</span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="?action=game" class="btn-secondary">Ver Todas</a>
            </div>

            <div class="card">
                <h3>Suas Badges</h3>
                <div class="badges-grid">
                    <?php foreach ($badges as $badge): ?>
                        <div class="badge">
                            <div class="badge-icon">🏆</div>
                            <div class="badge-name"><?= $badge['name'] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card">
                <h3>Alertas</h3>
                <div class="alerts">
                    <div class="alert success">Parabéns! Você economizou 15% este mês!</div>
                    <div class="alert warning">Consumo alto detectado ontem às 14h</div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/app.js"></script>
    <script>
        drawConsumptionChart(<?= json_encode($consumptionData) ?>);
    </script>
</body>
</html>