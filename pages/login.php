<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/header.php"; ?>
    <title>Login</title>
</head>
<body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-8 mx-auto">
                <div class="auth-form-light text-left p-5">
                <div class="brand-logo"> </div>
                <h4>Hello! Welcome to <?php echo TITLE?></h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form name="login" action="/php/dbLogin.php" method="post" class="pt-3 input" onsubmit="return(validate());">
                    <div class="form-group">
                        <input type="text" name="userId" placeholder="Login ID" class="form-control form-control-lg"><br>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Login Password" class="form-control form-control-lg"><br>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="submit" value="Login" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"/>
                    </div>
                    <div class="text-center mt-4 font-weight-light"> Don't have an account? 
                        <a href="/pages/register.php" class="text-primary">Create</a>
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
    function validate()
    {
      //id validation
       if( document.login.userId.value == "")
       {
       alert( "Please provide the Login ID." );
       document.login.userId.focus() ;
       return false; }
       //pw validation
        if( document.login.password.value == "")
        {
        alert( "Please provide the Password." );
        document.login.password.focus() ;
        return false; }
    return( true );
    }
    </script>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/endScript.php"; ?>
</body>
</html>