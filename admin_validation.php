<?php

session_start();

if (isset($_POST["submit-btn"])) {
    require "includes/database.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        header("Location: index.html?error=empty_fields");
        exit();
    } else {
        $query = "SELECT username, password FROM admin WHERE username = ?";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $query)) {
            header("Location: index.html?error=sql_error");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)) {
                if (strcmp($row["password"], $password) == 0) {
                    $_SESSION['user'] = $user;
                    $_SESSION["redirected"] = true;
                    header("Location: stats.php");
                    exit();
                } else {
                    header("Location: index.html?error=bad_credentials");
                    exit();
                }
            } else {
                header("Location: index.html?error=bad_credentials");
                exit();
            }
        }
    }
} else {
    header("Location: index.html?");
}
