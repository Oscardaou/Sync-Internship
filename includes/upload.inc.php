<?php
session_start();

if (isset($_POST['submit-upload'])){

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //to take a part of name (name.jpg) and to split it 
    $fielExt = explode('.', $fileName) ;
    $fileActualExt = strtolower(end($fielExt));

    $allowed = array('jpg','jpeg','pnd','pdf');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if($fileSize < 1000000000){
                $fileNameNew = uniqid("", true).".".$fileActualExt;
                $fileDestination = 'Uploads/'.$fileNameNew ;
                move_uploaded_file($fileTmpName,$fileDestination);
                $_SESSION['upload_message'] = "File successfully uploaded!";
            }else {
                $_SESSION['upload_message'] = "Your file is too big!";
            }
        }else {
            $_SESSION['upload_message'] = "There was an error uploading your file!";
        }
    }else {
        $_SESSION['upload_message'] = "You cannot upload a file of this type!";
    }
    header('Location: index.php');
    exit();
}