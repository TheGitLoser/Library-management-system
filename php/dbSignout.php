<?php
    session_start();
    session_destroy();
    echo session_status();
    echo "<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Succesfully Sign Out.');
            window.location.href='/index.php';
            </SCRIPT>";
?>
