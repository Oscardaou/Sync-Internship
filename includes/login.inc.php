<?php

if (isset($_POST['login-submit'])){
    require 'db.inc.php';

    $mail= htmlspecialchars($_POST['mail']);
    $password= htmlspecialchars($_POST['pwd']);

    if (empty($mail) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    else {
        $sql = "SELECT * FROM users where username=? OR mail=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt , $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ss",$mail,$mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck= password_verify($password,$row['pwd']);
                if($pwdCheck== false){
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userUsername'] = $row['username'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("Location: ../header.php");
    exit();
}