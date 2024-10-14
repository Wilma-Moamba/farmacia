

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" type="text/css" rel="stylesheet"/>
    <title>Login</title>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="../routes/userRoutes.php?action=login" method="post">
            <div class="loginItem">
                <legend>Email</legend>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="loginItem">
                <legend>Password</legend>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="loginItem">
                <button type="submit" id="button">Login</button>
            </div>
        </form>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
