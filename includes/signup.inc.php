<?php

if (isset($_POST['signup-submit'])){
    require 'db.inc.php';

    $username = htmlspecialchars($_POST['uid']);
    $email = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['pwd']);
    $passwordRepeat = htmlspecialchars($_POST['pwd-repeat']);

    if(empty($username) ||empty($email) ||empty($password) ||empty($passwordRepeat)  ){
        header("location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!filter_var($email , FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-z0-9*$/", $username)) {
        header("Location: ../signup.php?error=invalidemailuid");
        exit();
    }

    else if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&uid=".$username);
        exit();
    }

    else if (!preg_match("/^[a-zA-Z0-9*]+$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&mail=".$email);
        exit();
    }

    else if($password!==$passwordRepeat){
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
    }
    else{
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../signup.php?error=sqlerror&uid=".$username."&mail=".$email);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s" ,$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck= mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (	username,mail,pwd) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    header("Location: ../signup.php?error=sqlerror&uid=".$username."&mail=".$email);
                    exit();
                }
                else {
                    $hashedPwd= password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss" ,$username,$email,$hashedPwd);
                    mysqli_stmt_execute($stmt);

                    //add profile image
                    $sqlImg = "SELECT * FROM users WHERE username = ? AND mail=? ";
                    $stmtImg = mysqli_prepare($conn,$sql);
                    mysqli_stmt_execute($stmtImg);
                    $resultImg = mysqli_stmt_get_result($stmtImg);
                    if( mysqli_num_rows($resultImg)>0){
                        while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                            $userid = $rowImg['id'];
                            $sqlInsertImg = "INSERT INTO profileimg (usersid , status ) VALUES (?,?)";
                            $stmtInsertImg = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmtInsertImg,$sqlInsertImg)) {
                                header("Location: ../signup.php?error=sqlerror&uid=".$username."&mail=".$email);
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($stmtInsertImg, "ii" ,$userid,1);
                                mysqli_stmt_execute($stmtInsertImg);
                            }
                        }
                    }else{
                        echo "You have an error!";
                    }
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}
else{
    header("Location: ../signup.php");
    exit();
}