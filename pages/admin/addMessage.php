<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/header.php"; ?>
    <title><?php echo TITLE;?></title>
</head>

<body>
    <div class="container-scroller">
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/adminNavbar.php"; ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/adminSidebar.php"; ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Broadcast new message
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-description"> </p>
                                    <form name="login" action="/php/dbAddMessage.php" method="post" class="forms-sample" onsubmit="return(validate());">
                                        <div class="form-group">
                                            <label>New message </label>
                                            <textarea name="message" placeholder="Message" class="form-control"></textarea>
                                        </div>
                                        
                                        <input type="submit" name="submit" value="Add message" class="btn btn-gradient-primary mr-2"/>
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
      //message validation
       if( document.login.message.value == "" ||document.login.message.value.length >255)
       {
       alert( "Please provide a correct Message. (length = 1 - 255)" );
       document.login.message.focus() ;
       return false; }

    return( true );
    }
    </script>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/endScript.php"; ?>
</body>

</html>