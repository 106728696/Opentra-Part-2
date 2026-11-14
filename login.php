<?php include 'includes/header.inc'; ?>
<main>
        <h1>Login Form</h1>

        <form method="post" action="process.php" class="application-form">

            <div class="form-group">    
                    <label for ="username">Username:</label>
                    <input type="text" name="username" id="username" required>
            </div>

        <div class="form-group">
            <label for ="username">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

            <input type="hidden" name="token" value="Opentrarandomnumbers">

        <div class="form-buttons">
            <button type="submit" value="Login">Login</button>
                <button type="reset">Clear</button>
        </div>
        </form>
</main>
                    
<?php include 'includes/footer.inc'; ?>
