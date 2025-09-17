<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVolt - Registro</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="auth-page">
    <div class="container">
        <div class="auth-card">
            <div class="logo">
                <h1>⚡ EcoVolt</h1>
                <p>Junte-se à revolução verde!</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST" class="auth-form">
                <input type="text" name="username" placeholder="Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit" class="btn-primary">Registrar</button>
            </form>
            
            <p class="auth-link">
                Já tem conta? <a href="?action=login">Faça login</a>
            </p>
        </div>
    </div>
</body>
</html>