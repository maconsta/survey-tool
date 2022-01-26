<?php

session_start();

if (isset($_POST["submit-btn"])) {
    require "includes/database.php";
    $nlanguage = $_POST["nlanguage"];
    $english_level = $_POST["english_level"];

    $query = "INSERT INTO users (nlanguage,english_level) VALUES (?,?)";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $query)) {
        header("Location: index.html?error=sql_error");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, "ss", $nlanguage, $english_level);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $user = $statement->insert_id; // taking userid from db
        $_SESSION['user'] = $user;
        $_SESSION["redirected"] = true;
        header("Location: survey.php");
        exit();
    }
} else {
    header("Location: index.html");
}
