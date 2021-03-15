<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    #Create Table
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }
    
    date_default_timezone_set("Asia/Hong_Kong");
    $now = date("Y-m-d H:i:s");
    //insert sql
    $sql = "INSERT INTO BorrowedBook (UserId, BookId, BorrowDate, BorrowCompleted) VALUES
            ('$_SESSION[UserId]','$_GET[BookId]', '$now', False)";
    if (mysqli_query($conn, $sql)) {
        $sql = "UPDATE BookInventory SET Available=False WHERE BookId='$_GET[BookId]'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Succesfully Borrowed book.');
                window.location.href='/pages/main.php';
                </SCRIPT>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful Borrowe book.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }
?>
