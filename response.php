<?php

session_start();

require "includes/database.php";

if (isset($_POST["submit-btn"])) {

    //the following check will make sure that the session has not expired while the user was filling in the survey
    if (!array_key_exists('user', $_SESSION)) {
        header("Location: index.html?error=session_expired");
        exit();
    }

    $article1 = $_POST["article1"];
    $article2 = $_POST["article2"];
    $article3 = $_POST["article3"];
    $article4 = $_POST["article4"];
    $article5 = $_POST["article5"];
    $user = $_SESSION['user'];
    $news1 = $_SESSION['news1'];
    $news2 = $_SESSION['news2'];
    $news3 = $_SESSION['news3'];
    $news4 = $_SESSION['news4'];
    $news5 = $_SESSION['news5'];
    $newsId1 = $_SESSION['newsId1'];
    $newsId2 = $_SESSION['newsId2'];
    $newsId3 = $_SESSION['newsId3'];
    $newsId4 = $_SESSION['newsId4'];
    $newsId5 = $_SESSION['newsId5'];
    $variant = $_SESSION['variant'];

    //the following algorithm will check if the form is being submitted twice (page refresh, etc.)
    $hash = md5($user . $article1 . $article2 . $article3 . $article4 . $article5 . $newsId1 . $newsId2 . $newsId3 . $newsId4 . $newsId5);
    $stored_hash = isset($_SESSION['hash']) ? $_SESSION['hash'] : "";
    if ($hash == $stored_hash) {
        header("Location: index.html?error=resubmit");
        exit();
    } else {
        $_SESSION['hash'] = $hash;
    }


    $query = "INSERT INTO user_variants (userId, variant) VALUES (?,?)";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $query)) {
        header("Location: index.html?error=sql_error");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, "is", $user, $variant);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $trial = $statement->insert_id;

        $queryEv = "INSERT INTO evaluations (trial, newsId, grouped) VALUES (?,?,?)";
        $statementEv = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statementEv, $queryEv)) {
            header("Location: index.html?error=sql_error");
            exit();
        } else {
            mysqli_stmt_bind_param($statementEv, "iis", $trial, $newsId1, $article1);
            mysqli_stmt_execute($statementEv);
            mysqli_stmt_store_result($statementEv);

            mysqli_stmt_bind_param($statementEv, "iis", $trial, $newsId2, $article2);
            mysqli_stmt_execute($statementEv);
            mysqli_stmt_store_result($statementEv);

            mysqli_stmt_bind_param($statementEv, "iis", $trial, $newsId3, $article3);
            mysqli_stmt_execute($statementEv);
            mysqli_stmt_store_result($statementEv);

            mysqli_stmt_bind_param($statementEv, "iis", $trial, $newsId4, $article4);
            mysqli_stmt_execute($statementEv);
            mysqli_stmt_store_result($statementEv);

            mysqli_stmt_bind_param($statementEv, "iis", $trial, $newsId5, $article5);
            mysqli_stmt_execute($statementEv);
            mysqli_stmt_store_result($statementEv);
        }
    }
} else {
    header("Location: index.html?error=parsed");
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
        <h1>Thank you for taking the time to read provide answers for this survey.</h1>
        <div class="description">
            <h3>You can now exit the survey by closing this window.</h3>
            <p>Are you interested in doing the survey again? Click <a href="index.html">here</a>.</p>
            <p>You can leave feedback by filling in the form below:</p>
        </div>
        <form action="feedback.php" method="post">
            <div class="feedback-wrapper">
                <div class="input-field-wrapper">
                    <label for="email">Email:</label>
                    <input name="email" id="email" required>
                </div>
                <div class="input-field-wrapper feedback">
                    <label for="opinion">Feedback:</label>
                    <textarea name="opinion" id="opinion" placeholder="Enter text here..." required></textarea>
                </div>
                <div class="lower-row-wrapper">
                    <button class="button submit-btn" name="submit-btn" value="submit-btn">Submit</button>
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
            <a id="login-link" href="admin.php">Admin</a>
        </div>
    </footer>
</body>

</html>