<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }   
    
    // $UserId = $_GET["UserId"];
    $UserId = $_SESSION["UserId"];
    $sql = "SELECT * FROM Login l, User u WHERE l.UserId='$UserId' AND l.UserId=u.UserId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/header.php"; ?>
    <title><?php echo TITLE;?></title>
</head>

<body>
    <div class="container-scroller">
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/navbar.php"; ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/sidebar.php"; ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Update user information
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $row["UserFirstName"], '  ', $row["UserLastName"];?></h4>
                                    <p class="card-description"> </p>
                                    <form name="login" action="/php/dbUpdateUser.php?UserId=<?php echo $UserId;?>" method="post" class="forms-sample" onsubmit="return(validate());">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="firstName" value="<?php echo $row["UserFirstName"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lastName" value="<?php echo $row["UserLastName"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Original Password</label>
                                            <input type="password" name="oldPassword" placeholder="Password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="password" placeholder="New Password(Optional)" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="cfmPassword" placeholder="Confirm Password(Optional)" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Guardian Name</label>
                                            <input type="text" name="guardianName" value="<?php echo $row["UserGuardianName"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Date Of Birth</label>
                                            <input type="date" name="dob" value="<?php echo $row["UserDateOfBirth"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" placeholder="Address (Optional)" class="form-control"><?php echo $row["UserAddress"];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone 1</label>
                                            <input type="text" name="phone1" value="<?php echo $row["UserPhone1"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone 2</label>
                                            <input type="text" name="phone2" placeholder="Phone 2(Optional)" value="<?php echo $row["UserPhone2"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?php echo $row["UserEmail"];?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" value="M" <?php if ($row["UserGender"]=='M') echo "checked"; ?> class="form-check-input"> Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" value="F" <?php if ($row["UserGender"]=='F') echo "checked"; ?> class="form-check-input"> Female
                                                </label>
                                            </div>
                                        </div> 
                                        
                                        <input type="submit" name="submit" value="Update Account" class="btn btn-gradient-primary mr-2"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/footer.php"; ?>
                
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script type="text/javascript">
        function validate()
        {
        //firstName validation
        if( document.login.firstName.value == "" ||document.login.firstName.value.length >16)
        {
        alert( "Please provide a correct First Name. (length = 1 - 16)" );
        document.login.firstName.focus() ;
        return false; }
        else if (!document.login.firstName.value.match(/^[A-Za-z ]+$/))
        { alert("Please provide a correct name. (only alphabetic characters, A ~ Z, and white space are acceptable.)");
            document.login.firstName.focus() ;
        return false;
        }

        //lastName validation
        if( document.login.lastName.value == "" ||document.login.lastName.value.length >10)
        {
        alert( "Please provide a correct Last Name. (length = 1 - 10)");
        document.login.lastName.focus() ;
        return false; }
        else if (!document.login.lastName.value.match(/^[A-Za-z ]+$/))
        { alert("Please provide a correct name. (only alphabetic characters, A ~ Z, and white space are acceptable.)")
            document.login.lastName.focus() ;
        return false;
        }
        //old password validation
        if( document.login.oldPassword.value == "")
        {
        alert( "Please provide a correct Original Passowrd");
        document.login.oldPassword.focus() ;
        return false; }

            //new pw validation
            if( document.login.password.value.length <6 && document.login.password.value.length>=1)
            {
            alert( "Your New Password is too short. (length = 6 - 28)" );
            document.login.password.focus() ;
            return false; }
            if( document.login.password.value.length >28 )
            {
            alert( "Your New Password is too long. (length = 6 - 28)" );
            document.login.password.focus() ;
            return false; }

            //confirm pw validation
            if(document.login.cfmPassword.value!=document.login.password.value )
            {
            alert( "Your Password does not match, please try again." );
            document.login.cfmPassword.focus() ;
            return false; }

            //guardianName validation
            if( document.login.guardianName.value == "" ||document.login.guardianName.value.length >20)
            {
            alert( "Please provide a correct Guardian Name.(length = 1 to 20)");
            document.login.guardianName.focus() ;
            return false; }
            else if (!document.login.guardianName.value.match(/^[A-Za-z ]+$/))
            { alert("Please provide a correct Guardian Name. (only alphabetic characters, A ~ Z, and white space are acceptable.)")
            document.login.guardianName.focus() ;
            return false;
            }

            //date validation
            if( document.login.dob.value == "" )
            {
            alert( "Please provide a correct Birthday.");
            document.login.dob.focus() ;
            return false; }

            //address validation
            if(document.login.address.value.length >255)
            {
            alert( "Please provide a correct Address. (length = 1 - 255)" );
            document.login.address.focus() ;
            return false; }

            //phone validation
            var phoneno = /^\d{8}$/;
            if( document.login.phone1.value == ""||phoneno.test(document.login.phone1.value) ==false)
            {
            alert( "Please provide a correct Phone Number 1." );
            document.login.phone1.focus() ;
            return false;
            }
            if( document.login.phone2.value.length>=1 && phoneno.test(document.login.phone2.value) ==false){
            alert( "Please provide a correct Phone Number 2." );
            document.login.phone2.focus() ;
            return false;
            }
            //email validation
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{1,4})$/;
            if( document.login.email.value == "" )
            {
            alert( "Please provide a correct E-mail." );
            document.login.email.focus() ;
            return false;
            }
            else if(reg.test(document.login.email.value) == false){

            alert( "Please provide a correct E-mail." );
            document.login.email.focus() ;
            return false;
            }
            else if(document.login.email.value.length>50){

            alert( "Please provide a correct E-mail. (length = 1 - 50)" );
            document.login.email.focus() ;
            return false;
            }

        return( true );
        }
    </script>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/endScript.php"; ?>
</body>

</html>