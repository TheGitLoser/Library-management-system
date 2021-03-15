<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    $loginId = $_POST["userId"];
    $password = $_POST["password"];
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }

    //check account
    $sql = "SELECT UserId, UserPassword, UserType FROM Login WHERE UserLoginId='$loginId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(strlen($row) == 1 && password_verify($password, $row["UserPassword"])){
        session_start();
        $_SESSION["UserId"] = $row["UserId"];
        if ($row["UserType"] == "admin"){
            mysqli_close($conn);
            echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Admin Succesfully Login.');
                    window.location.href='/pages/admin/main.php';
                    </SCRIPT>";
        }else{
            mysqli_close($conn);
            echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Succesfully Login.');
                    window.location.href='/pages/main.php';
                    </SCRIPT>";
        }
    }else{
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Invalid login ID or password.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";

    }

?>
