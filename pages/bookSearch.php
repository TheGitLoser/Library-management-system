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
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/navbar.php"; ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/sidebar.php"; ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Book search
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Search by</h4>
                                    <p class="card-description">  </p>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <input type="text" name="book" class="form-control" placeholder="Book Information" onkeyup="showHint(this.value)"><br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <div class="table-responsive" id = "output">
                                        <table>
                                            <tr>
                                                <th>Book Title</th>
                                                <th>Author</th>
                                                <th>Publisher</th>
                                                <th>Publisher Address</th>
                                                <th>BookType</th>
                                                <th>Published Year</th>
                                                <th>Price</th>
                                                <th>ISBN</th>
                                                <th>Ebook</th>
                                                <th>Available</th>
                                                <th>Borrow / Reserve</th>
                                            </tr>
                                        </table>
            
                                    </div>
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
    <script>
        function showHint(name) {
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("output").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "/php/dbBookSearch.php?name="+name, true);
            xhttp.send();
        }
        showHint('')
    </script>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/endScript.php"; ?>
</body>

</html>