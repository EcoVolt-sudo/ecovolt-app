<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVolt - Login</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="auth-page">
    <div class="container">
        <div class="auth-card">
            <div class="logo">
                <h1>⚡ EcoVolt</h1>
                <p>Economize energia, ganhe pontos!</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST" class="auth-form">
                <input type="text" name="username" placeholder="Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit" class="btn-primary">Entrar</button>
            </form>
            
            <p class="auth-link">
                Não tem conta? <a href="?action=register">Registre-se</a>
            </p>
        </div>
    </div>
</body>
</html>