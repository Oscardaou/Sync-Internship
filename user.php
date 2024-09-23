<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User log in</title>
    <Link rel="stylesheet" href="css/users.css">

</head>
<body>
    <header>

        <?php
            session_start();



            if (!isset($_SESSION['userId'])) {
                header("Location: login.php");
                exit();
            }

            echo "Welcome, user ID: " . $_SESSION['userId'];
            echo "<br>Your username is: " . $_SESSION['userUsername'];
            ?>
            <a href="includes/logout.inc.php">logout</a>
    </header>

    <main>
        
    </main>


</body>
</html>