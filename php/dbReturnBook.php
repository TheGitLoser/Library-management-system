<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }


    //insert sql
    $sql = "UPDATE BorrowedBook SET BorrowCompleted = True WHERE BorrowId=$_GET[BorrowId]";
    if (mysqli_query($conn, $sql)) {
        $sql = "UPDATE BookInventory SET Available=True WHERE BookId='$_GET[BookId]'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Succesfully Return book.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful Return book.');
               //window.location.href='javascript:history.back()';
                </SCRIPT>";
    }
?>
