<?php

if (isset($_POST["submit-btn"])) {
    require "includes/database.php";

    $email = $_POST["email"];
    $opinion = $_POST["opinion"];

    $query = "INSERT INTO feedback (email, opinion) VALUES (?,?)";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $query)) {
        header("Location: index.html?error=sql_error");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, "ss", $email, $opinion);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
    }
    header("Location: response.php");
}
