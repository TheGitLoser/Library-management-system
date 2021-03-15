<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";

    $message = $_POST["message"];

    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }

    date_default_timezone_set("Asia/Hong_Kong");
    $now = date("Y-m-d H:i:s");

    //update sql
    $sql = "INSERT INTO message (UserId, message, messageDate	) VALUES ('$_SESSION[UserId]','$message', '$now')";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Succesfully added message.');
                window.location.href='/pages/admin/main.php';
                </SCRIPT>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful added message.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }

?>
