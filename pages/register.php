<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/header.php"; ?>
    <title>Register</title>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-8 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo"></div>
                        <h4>Hello! Welcome to <?php echo TITLE?></h4>
                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                        <form name="login" action="/php/dbRegister.php" method="post" class="input" style="top:5%;" onsubmit="return(validate());">
                            <div class="form-group">
                                <input type="text" name="firstName" placeholder="First Name" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="text" name="lastName" placeholder="Last Name" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="text" name="userId" placeholder="Login ID" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Login Password" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="password" name="cfmPassword" placeholder="Confirm Password" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="text" name="guardianName" placeholder="Guardian Name" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="date" name="dob" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <textarea name="address" placeholder="Address(Optional)" class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone1" placeholder="Phone 1" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone2" placeholder="Phone 2(Optional)" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-mail" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="radio" name="gender" value="M" checked> Male
                                <input type="radio" name="gender" value="F"> Female
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="submit" value="Create Account" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"/>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                    href="/pages/login.php" class="text-primary">Login</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
    
    <script type="text/javascript">
        function validate(){
            //firstName validation
            if( document.login.firstName.value == "" ||document.login.firstName.value.length >16)
            {
            alert( "Please provide a correct First Name. (length = 1 - 16)" );
            document.login.firstName.focus() ;
            return false; }
            else if (!document.login.firstName.value.match(/^[A-Za-z ]+$/))
            { alert("Please provide a correct First Name. (only alphabetic characters, A ~ Z, and white space are acceptable.)");
            document.login.firstName.focus() ;
            return false;
            }

            //lastName validation
            if( document.login.lastName.value == "" ||document.login.lastName.value.length >10){
            alert( "Please provide a correct Last Name. (length = 1 - 10)");
            document.login.lastName.focus();
            return false;
            }else if (!document.login.lastName.value.match(/^[A-Za-z ]+$/)) {
            alert("Please provide a correct last name. (only alphabetic characters, A ~ Z, and white space are acceptable.)")
            document.login.lastName.focus() ;
            return false;
            }
            //userIdid validation
            if( document.login.userId.value == "" || document.login.userId.value.length > 28 || document.login.userId.value.length < 6)
            {
            alert( "Please provide a correct Login ID. (length = 6 - 28)" );
            document.login.userId.focus() ;
            return false; }

            //pw validation
            if( document.login.password.value == "" )
            {
            alert( "Please provide a correct Password." );
            document.login.password.focus() ;
            return false; }
            if( document.login.password.value.length <6)
            {
            alert( "Your Password is too short. (length = 6 - 28)" );
            document.login.password.focus() ;
            return false; }
            if( document.login.password.value.length >28 )
            {
            alert( "Your Password is too long. (length = 6 - 28)" );
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