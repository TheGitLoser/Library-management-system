<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    
    #Create Table
        // Create connection
        $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
        // Check connection
        if (!$conn) {
            die("<br>Connection failed: " . mysqli_connect_error());
        }
    #Register
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $loginId = $_POST["userId"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT, ['cost'=> 11]);
        $guardianName = $_POST["guardianName"];
        $dob = $_POST["dob"];
        $address = $_POST["address"];
        $phone1 = $_POST["phone1"];
        $phone2 = $_POST["phone2"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];

        //check duplicate
        $sql = "SELECT count(*) FROM Login WHERE UserLoginId='$loginId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row["count(*)"] >= 1) {
            echo"<br>Login Id already exists";
            mysqli_close($conn);
            echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Login Id has been used.');
                    window.location.href='javascript:history.back()';
                    </SCRIPT>";
        }else{
            $sql = "INSERT INTO Login (UserLoginId, UserPassword, UserType) VALUES ('$loginId','$password','user')";
            if (mysqli_query($conn, $sql)) {
                $sql = "SELECT UserId FROM Login WHERE UserLoginId='$loginId'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION["UserId"] = $row["UserId"];
                $today = date("y-m-d");
                $userId = $row["UserId"];
                $sql = "INSERT INTO User (UserId, UserFirstName, UserLastName, UserGuardianName, UserDateOfBirth,
                        UserJoiningDate, UserAddress, UserPhone1, UserPhone2, UserEmail, UserGender, UserTotalBorrow) VALUES
                        ($userId,'$firstName','$lastName','$guardianName', '$dob', '$today', '$address', '$phone1', '$phone2', '$email', '$gender', 0)";
                if (mysqli_query($conn, $sql)) {
                    echo "<br>New record created successfully";
                }else{
                    echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
                echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Succesfully Registered.');
                        window.location.href='/pages/main.php';
                        </SCRIPT>";
            } else {
                echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
                mysqli_close($conn);
            }
        }




?>
