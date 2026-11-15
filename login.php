<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Apply for a position at Opentra.">

    <title>Opentra | Login </title>
</head>

<body>

        <?php include 'includes/header.inc'; ?>
        <main>
                <h1>Login Form</h1>
                <section class="manage-intro">
                    <p>
                        Welcome!
                        Please login into your account
                    </p>
                </section>
        
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
