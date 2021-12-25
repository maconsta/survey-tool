<?php

if (isset($_POST["submit-btn"])) {
    require "database.php";
    $nlanguage = $_POST["nlanguage"];
    $email = $_POST["email"];

    $query = "INSERT INTO users (nlanguage, email) VALUES (?,?)";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $query)) {
        header("Location: index.php?error=sql_error");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, "ss", $nlanguage, $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        header("Location: survey.php");
        exit();
    }
}
