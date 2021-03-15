<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }



    //insert sql
    $sql = "UPDATE Reservation SET RevCompleted=True WHERE RevId='$_GET[RevId]'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header('Location: /php/dbBorrowBook.php?BookId='.$_GET['BookId']);
    } else {
        echo "Error borrowing: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful borrow book.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }
?>
