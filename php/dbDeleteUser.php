<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    $UserId = $_GET['UserId'];
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }


    $sql = "DELETE FROM User WHERE UserId=$UserId";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM Login WHERE UserId=$UserId";
    mysqli_query($conn, $sql);

    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Succesfully Delete.');
                window.location.href='/pages/admin/main.php';
                </SCRIPT>";
    }else{
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful Delete.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";

    }

?>
