<?php

require "includes/database.php";
?>


<!DOCTYPE HTML>

<html>

<head>
    <meta charset="UTF-8">
    <title>Internet News - Emotion Survey</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <main>
        <div class="description">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
        </div>
        <form action="admin_validation.php" method="post">
            <div class="login-field-wrapper">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group" id="spaced">
                    <label>Password</label>
                    <input type="password" name="password">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="button submit-btn" value="Login">
                </div>
            </div>
        </form>

    </main>


    <footer>
        <div class="footer-content">
            <div class="footer-img">
                <a href="https://computerscience.nbu.bg/">
                    <img id="logo" src="images/NBU.png" alt="logo">
                    <span id="dept-name">Department of Informatics</span>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>