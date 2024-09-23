<?php
    session_start();
    /*if (isset($_SESSION['userId'])) {
        header("Location: index.php"); 
        exit(); 
    }*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in</title>
    <Link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>           
            <div class="home">

                <a  href="index.php">Back to Home</a>

            </div>
            
            <div class="container">
            
                <div class="grid-item logo-section">
                    <img src="img/sync-logo.png" alt="Logo" class="logo">
                    <p class="description">Welcome to Our Website</p>
                </div>
                
                <div class="login-section >
                <?php
                    if(!isset($_SESSION['userId'])){
                        echo '<p class="description">SignIn</p>

                            <form action="includes/login.inc.php" method="POST" class="login-form">
                                <input type="text" name="mail" placeholder="Email" >
                                <input type="password" name="pwd" placeholder="Password" >
                                <button type="submit" name="login-submit" >Sign-In</button>
                            </form>
                            <a href="signup.php">Sign-up</a>
                        ';

                    }
                    else{
                        echo '
                            
                            <form action="includes/logout.inc.php" method="POST">
                                <button type="submit" name="logout-submit" >Logout</button>
                            </form>
                        ';
                    }
                ?>
                    
                    
                </div>
            </div>
        </nav>
    </header>
</body>
</html>