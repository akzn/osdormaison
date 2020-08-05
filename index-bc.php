<?php
    include_once "config/conn.php";
    include_once "config/general_helper.php";
    session_start();
    /*
    $params = explode( "/", $_GET['params'] );
    if ($params[0]=='') {
        $page='home';
    } else {
        $page=$params[0];
    }
    */

    $halaman = $_GET['hal'];
    if ($halaman=='') {
        $halaman='home';
    } 

    //kategori
    $qrykat = "select * from tb_kategori where id_induk=0";
    $sqlkat = mysql_query($qrykat);
    if($sqlkat === FALSE) { 
        die(mysql_error()); 
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wishes Apparel</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
     <link href="<?=BASE?>assets/css/wishes.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <!-- jQuery -->
    <script src="<?=BASE?>assets/js/jquery-1.12.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- custom js -->
     <script src="<?=BASE?>assets/js/wishes.js"></script>

</head>

<body>
    <header>
        <div class="row header-top">
            <div class="col-sm-12 hidden">
                <a href="" class="pull-right">Login</a>
                <a href="" class="pull-right">Register</a>
            </div>
        </div>
        <div class="row header-middle">
            <div class="col-sm-6">
                <img class="img-responsive" src="<?=BASE?>images/logo2.jpg">
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                    <form method="POST" action="<?=BASE?>?hal=search_result">
                        <div class="form-group search-box">
                            <input type="text" class="form-control" name="searchq" id="searchq" placeholder="search"></input>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?hal=home">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori <b class="caret"></b></a> 
                        <ul class="dropdown-menu">
                        <?php while($row = mysql_fetch_array($sqlkat)):?>
                          <li class=""><a href="?hal=kategori&kat=<?=$row['id_kategori']?>"><?=$row['nama_kategori']?></a></li>
                        <?php endwhile;?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=BASE?>?hal=contact">Contact</a>
                    </li>
                    <li>
                        <a href="<?=BASE?>?hal=konfirmasi">Konfirmasi Pembayaran</a>
                    </li>
                    <li class="dropdown hidden">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a> 
                      
                        <ul class="dropdown-menu">
                          <li class="kopie"><a href="#">Dropdown</a></li>
                            <li><a href="#">Dropdown Link 1</a></li>
                            <li class="active"><a href="#">Dropdown Link 2</a></li>
                            <li><a href="#">Dropdown Link 3</a></li>
                          
                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 4</a>
                                <ul class="dropdown-menu">
                                    <li class="kopie"><a href="#">Dropdown Link 4</a></li>
                                    <li><a href="#">Dropdown Submenu Link 4.1</a></li>
                                    <li><a href="#">Dropdown Submenu Link 4.2</a></li>
                                    <li><a href="#">Dropdown Submenu Link 4.3</a></li>
                                    <li><a href="#">Dropdown Submenu Link 4.4</a></li>
                                                                      
                                </ul>
                            </li>
                          
                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 5</a>
                                <ul class="dropdown-menu">
                                    <li class="kopie"><a href="#">Dropdown Link 5</a></li>
                                    <li><a href="#">Dropdown Submenu Link 5.1</a></li>
                                    <li><a href="#">Dropdown Submenu Link 5.2</a></li>
                                    <li><a href="#">Dropdown Submenu Link 5.3</a></li>
                                    
                                    <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
                                        <ul class="dropdown-menu">
                                            <li class="kopie"><a href="#">Dropdown Submenu Link 5.4</a></li>
                                            <li><a href="#">Dropdown Submenu Link 5.4.1</a></li>
                                            <li><a href="#">Dropdown Submenu Link 5.4.2</a></li>
                                            
                                            
                                        </ul>
                                    </li>                           
                                </ul>
                            </li>                                   
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right cart">
                    <div class="cart-button">
                          <a class=""><i class="fa fa-shopping-cart"></i></a>
                          <div class="cart-dropdown">
                             <?php include "process/div_cart.php";?>
                          </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    </header>
    <!-- Page Content -->
    <div class="container">

        <?php include 'view/'.$halaman.'.php';?>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Wishes.com 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

   

</body>

</html>