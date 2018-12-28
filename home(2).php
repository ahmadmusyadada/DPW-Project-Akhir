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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylehome.css">
    <link rel="stylesheet" href="login.php">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Free Music</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Instrumental</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if($_SESSION['login']==true)
                { 
                    echo $_SESSION["login"];
                    echo '<a href="php/logout.php"><span>   Logout</span></a></li>';
                }
                elseif($_SESSION['logged']==false)
                {
                    echo '<a href="registerform.html"><span>Login/Register</span></a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <h2>Responsive Two Column Layout</h2>
    <p>Resize the browser window to see the responsive effect (the columns will stack on top of each other instead of floating next to each other, when the screen is less than 600px wide).</p>

<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>Instrumental</h2>
        <p>
        <?php
        $dirname = "file/";
        $files = scandir($dirname);
        $ignore = array(".", "..", ".DS_Store");

        echo '<ul>';
        foreach($files as $curfile){
            if(!in_array($curfile, $ignore)) {
                echo "<li><a href='?file=".$curfile."'>$curfile</a></li>";
            }
        } 
        echo '</ul>'; 
        if(isset($_GET['file'])){
        $file = $_GET['file'];

        echo '<object>
        <audio controls="controls" autobuffer="autobuffer" autoplay="pause">
        <source src="'.$dirname.$file.'">
        </audio>
        </object>';
        }  
        ?>
        </p>

</body>
</html> 
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>Column 2</h2>
    <p>Some text..</p>
  </div>
</div>
</body>
</html>