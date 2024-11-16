<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
    <form action="/register/store" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= set_value('name') ?>" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= set_value('email') ?>" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirm">Confirm Password</label>
            <input type="password" name="password_confirm" id="password_confirm" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>