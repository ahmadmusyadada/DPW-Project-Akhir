<?php
require 'php/functions.php';
if(isset($_POST['submitedit'])){
    if(edit($_POST) > 0){
        echo "
        <script>
            alert('data berhasil diperbaharui');
            document.location.href='profile.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diperharui');
            document.location.href='profile.php';
        </script>
        ";
        echo "<br>";
        echo mysqli_error($conn);
    }
}

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

  $usernme = $_SESSION["login"];
  $conn=mysqli_connect("localhost","root","","phpdatabase");
  $result=mysqli_query($conn,"SELECT * FROM profileuser where username = '$usernme'");
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
  <link rel="stylesheet" href="login.php">

  <title>Free Music | Profile</title>

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
      <a href="home.php" class="logo">Free <span class="lite">Music</span></a>
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
                  echo '<a href="login.php"><span>Login/Register</span></a></li>';
                }
              ?>
              </span>
            <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="profile.php"><i class="icon_profile"></i> My Profile</a>
              </li>
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
            <a class="" href="home.php">
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
              <li><a class="" href="profile.php">Profile</a></li>
              <li><a class="" href="login.php"><span>Login Page</span></a></li>
            </ul>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="icon_documents_alt"></i>Pages</li>
              <li><i class="fa fa-user-md"></i>Profile</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <!-- profile-widget -->
          <div class="col-lg-12">
            <div class="profile-widget profile-widget-info">
              <div class="panel-body">
              </div>
            </div>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading tab-bg-info">
                <ul class="nav nav-tabs"> 
                  <li class="active">
                    <a data-toggle="tab" href="#profile">
                      <i class="icon-user"></i>
                      Profile
                    </a>
                  </li>
                  <li class="">
                    <a data-toggle="tab" href="#edit-profile">
                      <i class="icon-envelope"></i>
                      Edit Profile
                    </a>
                  </li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">
                  <!-- profile -->
                  <div id="profile" class="tab-pane active">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1>Bio Graph</h1>
                        <div class="row">
                        <?php while($row=mysqli_fetch_assoc($result)):?>
                          <div class="bio-row">
                            <p><span>First Name </span>: <?= $row["firstname"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Last Name </span>: <?= $row["lastname"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Birthday</span>: <?= $row["birthday"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Country </span>: <?= $row["country"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Occupation </span>: <?= $row["occupation"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Email </span>: <?= $row["email"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Mobile </span>: <?= $row["mobilenumber"]; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Phone </span>: <?= $row["phonenumber"]; ?></p>
                          </div>
                        </div>
                      </div>
                    </section>
                    <section>
                      <div class="row">
                      </div>
                    </section>
                  </div>
                  <!-- edit-profile -->
                  <div id="edit-profile" class="tab-pane">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1> Profile Info</h1>
                        <form action="" method="post" class="form-horizontal" role="form">
                        <input type="hidden" name="username" value="<?= $row["username"] ?>">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                          <div class="form-group">
                            <label class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="f-name" id="f-name" value="<?= $row["firstname"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="l-name" id="l-name" value="<?= $row["lastname"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Country</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="country" id="country" value="<?= $row["country"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Birthday</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="b-day" id="b-day" value="<?= $row["birthday"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Occupation</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="occupation" id="occupation" value="<?= $row["occupation"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="email" id="email" value="<?= $row["email"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Mobile</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="mobile" id="mobile" value="<?= $row["mobilenumber"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Phone</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="phone" id="phone" value="<?= $row["phonenumber"]; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" name="submitedit" class="btn btn-primary">Save</button>
                              <button type="submit" class="btn btn-danger">Cancel</button>
                            </div>
                          </div>
                          <?php endwhile;?>
                        </form>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>

        <!-- page end-->
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
  <!-- jquery knob -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>
  <script>
    //knob
    $(".knob").knob();
  </script>
</body>
</html>