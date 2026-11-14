<?php include 'includes/header.inc'; ?>

        <h1>Login Form</h1>

        <form method="post" action="process.php">
            <label for ="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for ="username">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="hidden" name="token" value="Opentrarandomnumbers">
            <input type="submit" value="Login" class="form-buttons">
        </form>
<?php include 'includes/footer.inc'; ?>
