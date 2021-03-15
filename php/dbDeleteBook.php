<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    $BookId = $_GET['BookId'];
    // Create connection
    $conn = new mysqli("localhost","root","","comp2411");
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }


    $sql = "DELETE FROM BookInventory WHERE BookId='$BookId'";
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
