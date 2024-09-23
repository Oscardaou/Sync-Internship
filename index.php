<?php
session_start();
include_once 'includes/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <Link rel="stylesheet" href="css/index.css">

</head>
<body>
    <header>
    <div class="container">
            
            <div class="grid-item logo-section">
                <img src="img/sync-logo.png" alt="Logo" class="logo">
                <p class="description">Welcome to Our Website</p>
            </div>
            <div class="url-indexes">
            <a  href="login.php">SignIn</a>
            <a  href="signup.php">signup</a>

            </div>
    </header>

    <main>

        <?php

            $sql = "SELECT * FROM users";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) >0) {
                while ($row = mysqli_fetch_assoc($result)){
                    $id=$row['id'];

                    $sqlImg= "SELECT * FROM profileimg WHERE usersid = '$id' ";
                    $stmtImg = mysqli_prepare($conn,$sqlImg);
                    mysqli_stmt_execute($stmtImg);
                    $resultImg = mysqli_stmt_get_result($stmtImg);
                    while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                        echo "<div>";
                        if ($rowImg['status'] == 0) {
                            echo "<img src ='Uploads/profile".$id.".jpeg'>";

                        }else {
                            echo "<img src ='Uploads/profiledefault.jpeg'>";
                        }
                        echo $row['username'];
                        echo "</div>";
                    }
                }
            }
            else {
                echo "There are no user yet!";
            }
            mysqli_stmt_close($stmt);
            if(isset($_SESSION['userId'])){
                echo "Welcome,your logged in as user ID: " . $_SESSION['userId'];
                echo "<br>Your username is: " . $_SESSION['userUsername'];
                echo '<a href="includes/logout.inc.php">logout<br></a>';
                echo    '<form action="upload.php" method ="POST" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <button type="submit" name="submit-upload">Upload File</button>
                        </form>';
            }
            else {
                echo "You are not logged in!";
            }
            ?>
            

        
        <?php
            // Check if there's a message
            if (isset($_SESSION['upload_message'])) {
                echo '<p>' . htmlspecialchars($_SESSION['upload_message']) . '</p>';

                // Clear the message after displaying
                unset($_SESSION['upload_message']);
            }
        ?>
    </main>

</body>
</html>