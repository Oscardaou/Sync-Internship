<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <h1>Sign-up</h1>
    
    <div class="urlindexes">

        <a href="index.php">Home</a>
        <a href="login.php">Log in</a>
        
    </div>

    <div class="signupContainer">

    <div class="grid-item logo-section">
        <img src="img/sync-logo.png" alt="Logo" class="logo">
        <p class="description">Welcome to Our Website</p>
    </div>

    <form action="includes/signup.inc.php" method="POST" class="signup-section">
        <div class="errore">

            <?php
        if(isset($_GET['error'])){
            if($_GET['error'] == "emptyfields"){
                echo '<p > Fill in all fields!</p>';
            }
            else if ($_GET['error'] == "invalidemailuid"){
                echo '<p > Invalid email!</p>';
            }
            
            else if ($_GET['error'] == "invalidusername&mail="){
                echo '<p > User name has wrong characters!</p>';
            }
            
            else if ($_GET['error'] == "passwordcheck&uid="){
                echo '<p > Password are not the same!</p>';
            }
            
            else if ($_GET['error'] == "sqlerror&uid="){
                echo '<p > Wrong sql !</p>';
            }
            else if ($_GET['signup'] == "success"){
                echo '<p > Sign up successfull !</p>';
            }
            
        }
        ?>
        </div>
        <input type="text" name="uid" placeholder="Username" >
        <input type="text" name="mail" placeholder="Email" >
        <input type="password" name="pwd" placeholder="Password" >
        <input type="password" name="pwd-repeat" placeholder="Repeat password" >
        <button type="submit" name="signup-submit" >Sign-up</button>       
        
    </form>
    </div>
</body>
</html>


