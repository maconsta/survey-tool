<?php

session_start();

if (!$_SESSION["redirected"]) {
    header("Location: index.html?error=unauthorised");
} else { 
    $_SESSION["redirected"] = false;
    require "includes/database.php";

    //the following check will make sure that the session has not expired
    if (!array_key_exists('user', $_SESSION)) {
        header("Location: index.html?error=session_expired");
        exit();
    }
}
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
        <div class="download-links">
            <span>Click <a href="<?php $_SESSION["from_link"]=true; ?>downloads.php" target="_blank">here </a>to download evaluations.</span>
        </div>

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