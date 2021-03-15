<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
     
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }

    date_default_timezone_set("Asia/Hong_Kong");
    $now = date("Y-m-d H:i:s");
    //insert sql
    $sql = "INSERT INTO Reservation (UserId, BookId, RevDate, RevCompleted) VALUES
            ('$_SESSION[UserId]','$_GET[BookId]', '$now', False)";
    if (mysqli_query($conn, $sql)) {

        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Succesfully Reserved book.');
                window.location.href='/pages/main.php';
                </SCRIPT>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful Reserve book.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }
?>
