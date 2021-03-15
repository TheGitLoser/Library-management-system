<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    
    $UserId = $_GET["UserId"] ;
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $oldPassword = $_POST["oldPassword"];

    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost'=> 11]);

    $guardianName = $_POST["guardianName"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];
    $phone1 = $_POST["phone1"];
    $phone2 = $_POST["phone2"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }

    //check old password
    $sql = "SELECT UserPassword FROM Login WHERE UserId='$UserId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(!(password_verify($oldPassword, $row["UserPassword"]))){
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Invalid Original password.');
                </SCRIPT>";
    }

    //update password
    if ($password != ''){
        $sql = "UPDATE Login SET UserPassword='$password' WHERE UserId='$UserId'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
            mysqli_close($conn);
            echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Unsuccesful Update.');
                    window.location.href='javascript:history.back()';
                    </SCRIPT>";
        }
    }

    $sql = "UPDATE User SET
            UserFirstName='$firstName',
            UserLastName='$lastName',
            UserGuardianName='$guardianName',
            UserDateOfBirth='$dob',
            UserAddress='$address',
            UserPhone1='$phone1',
            UserPhone2='$phone2',
            UserEmail='$email',
            UserGender='$gender' WHERE UserId='$UserId'";
    //update user information
    if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
            mysqli_close($conn);
            if($_SESSION['UserId']==$UserId){
                echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Succesfully Update.');
                        window.location.href='/pages/main.php';
                        </SCRIPT>";
            }else{
                echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Succesfully Update.');
                        window.location.href='/pages/admin/manageUser.php';
                        </SCRIPT>";
            }
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful Update.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }

?>
