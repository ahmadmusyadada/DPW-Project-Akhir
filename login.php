<?php
session_start();

require 'php/functions.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['username'])){
    $id=$_COOKIE['id'];
    $key=$_COOKIE['key'];

    $result=mysqli_query($conn, "SELECT username FROM user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_POST["login"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $result=mysqli_query($conn, "SELECT *FROM users WHERE username='$username'");

    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION["login"]=true;
            if(isset($_POST['remember'])){
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash(sha256, $row['username']), time()+60);
                setcookie('login','true',time()+60);
            }
            header("Location:home.php");
            exit;
        }
    }
    $error=true;
}

if(isset($_POST['register'])){
  if(registrasi($_POST) > 0){
      echo "
          <style>
              alert('user berhasil ditambahkan');
          </style>
      ";
  } else {
      echo mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="wrapper">
  <div class="login is-active" style="padding-top: 60%" >
    <form id="Form" onsubmit="return validateForm()" method="post">
        <div class="form-element" >
            <span><i class="fa fa-envelope"></i></span><input type="username" name="username" placeholder="Username"/>
          </div>
          <div class="form-element">
            <span><i class="fa fa-lock"></i></span><input type="password" name="password" placeholder="Password"/>
          </div>
          <?php if(isset($error)):?>
        <p style = "color: red; font-style=bold">
        Username dan Password salah</p>

    <?php endif?>
          <button class="btn-login" type="submit" value="Submit" name="login">login</button>
    </form>
  </div>

  <div class="register down">
    <form id="regisForm" onsubmit="return validateRegisForm()" method="post">
        <div class="form-element" >
            <span><i class="fa fa-user"></i></span><input type="text" name="fullname" placeholder="Full Name"/>
          </div>
          <div class="form-element">
            <span><i class="fa fa-lock"></i></span><input type="password" name="password" placeholder="Password"/>
          </div>
          <div class="form-element">
            <span><i class="fa fa-lock"></i></span><input type="password" name="password2" placeholder="Re-Enter Password"/>
          </div>
          <button class="btn-register" type="submit" value ="Submit" name="register">register</button>
    </form>
  </div>

  <div class="login-view-toggle">
    <div class="sign-up-toggle is-active">Don't have an account? <a href="#">Sign Up</a></div>
    <div class="login-toggle">Already have an account? <a href="#">Login</a></div>
  </div>
</div>
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  <script src="js/index.js"></script>
  <script src="js/function.js"></script>
</body>
</html>