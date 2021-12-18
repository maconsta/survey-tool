<?php

if (isset($_POST["submit-btn"])) {
    require "database.php";
    $nlanguage = $_POST["nlanguage"];
    $email = $_POST["email"];

    if (empty($nlanguage) || empty($email)) {
        header("Location: index.html?error=empty_fields");
        exit();
    } else if (!preg_match("/(^.{1,64})(@)(.{1,254})/", $email)) {
        header("Location: index.html?error=bad_email_form");
        exit();
    } else {
        $query = "SELECT email FROM users WHERE email = ?";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $query)) {
            header("Location: index.html?error=sql_error");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "s", $email);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $user_exists = mysqli_stmt_num_rows($statement); //function returns 1 or 0, 1 if user exists, 0 if not

            if ($user_exists > 0) {
                header("Location: index.html?error=already_enrolled");
                exit();
            } else {
                $query = "INSERT INTO users (nlanguage, email) VALUES (?,?)";
                $statement = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($statement, $query)) {
                    header("Location: index.html?error=sql_error");
                    exit();
                } else {
                    mysqli_stmt_bind_param($statement, "ss", $nlanguage, $email);
                    mysqli_stmt_execute($statement);
                    mysqli_stmt_store_result($statement);
                    header("Location: survey.php?success");
                    exit();
                }
            }
        }
    }
}
