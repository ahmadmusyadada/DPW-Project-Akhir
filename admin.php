<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['msg'] = "You must log in first";
 	header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}

if(isset($_POST['submit'])){
  $target = 'file/'; 
  $target = $target.basename($_FILES['file']['name']); 
  if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
    echo "Complete";
  } else {
    echo "<script>alert('Error');
      document.location.href='admin.php';
      </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Free Music | Admin</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style2.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="" class="logo">Free <span class="lite">Music</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="username">
                <?php
                  if($_SESSION['login']==true) { 
                    echo $_SESSION["login"];
                  } elseif($_SESSION['logged']==false) {
                    echo '<a href="registerform.html"><span>Login/Register</span></a></li>';
                  }
                ?>
              </span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li>
                <a href="login.php"><i class="icon_key_alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="admin.php">
              <i class="icon_house_alt"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_documents_alt"></i>
              <span>Pages</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="login.php"><span>Login Page</span></a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class=" wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body">Upload a new file
                <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file"/>
                <input type="submit" name="submit" value="Upload"/>
              </form>
              </div>
            </section>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <section class="panel">
              <div class="panel-body"><b>Instrumental</b> 
                <br>
                  <?php
                  $dirname = "file/instrumental/";
                  $files = scandir($dirname);
                  $ignore = array(".", "..", ".DS_Store");

                  echo '<ul>';
                  foreach($files as $curfile){
                    if(!in_array($curfile, $ignore)) {
                      echo "<li><a href='?file=".$curfile."' id='$curfile'>$curfile</a></li>";
                      if(isset($_GET['file']) && $curfile == ($_GET['file'])){
                        $file = $_GET['file'];
                    
                        echo '<object>
                        <audio controls="controls" autobuffer="autobuffer" autoplay="pause">
                        <source src="'.$dirname.$file.'">
                        </audio>
                        </object><br>';
                      }  
                      echo "<td><a class='btn btn-danger' href='delete.php?file=".$curfile."'>Delete</a></td>";
                      echo "<td><a style='button' class='btn btn-warning' id='$curfile' onclick='myFunction(id)'>Rename</a></td>";
                    }
                  }
                  ?>
                  
                  <script>
                  function myFunction(id) {
                    var temp;
                    var x;
                    var site = prompt("Please enter Something", id);  
                    if (site != null) {
                      temp = id;
                      x = site;
                      document.getElementById(id).innerHTML = x;
                      ChangeFileName(temp, x);
                    }

                  function ChangeFileName(id, site) {
                    var fso, f;
                    fso = new ActiveXObject("Scripting.FileSystemObject");
                    f = fso.GetFile("file/" + id);
                    f.name = site;
                    }
                  }
                  </script>
              </div>
            </section>
          </div>
          <div class="col-lg-6">
            <section class="panel">
              <div class="panel-body">Music
              <br>
              <?php
                $dirname = "file/music/";
                $files = scandir($dirname);
                $ignore = array(".", "..", ".DS_Store");

                echo '<ul>';
                foreach($files as $curfile){
                  if(!in_array($curfile, $ignore)) {
                    echo "<li><a href='?file=".$curfile."' id='$curfile'>$curfile</a></li>";
                    if(isset($_GET['file']) && $curfile == ($_GET['file'])){
                      $file = $_GET['file'];
                  
                      echo '<object>
                      <audio controls="controls" autobuffer="autobuffer" autoplay="pause">
                      <source src="'.$dirname.$file.'">
                      </audio>
                      </object><br>';
                    }  
                    echo "<td><a class='btn btn-danger' href='delete.php?file=".$curfile."'>Delete</a></td>";
                    echo "<td><a class='btn btn-warning' id='$curfile' onclick='myFunction(id)'>Rename</a></td>";
                  }
                }
              ?>
              </div>
            </section>
          </div>
        </div>
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
    </div>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

  <!--custome script for all page-->
  <script src="js/scripts.js"></script>
</body>
</html>