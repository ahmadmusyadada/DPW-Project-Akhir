<?php
//membuat koneksi
$conn=mysqli_connect("localhost","root","","phpdatabase");

if(!$conn){
    die('Koneksi Error: '.mysqli_connect_errno().' - '.mysqli_connect_error());
}

function edit ($data){
    global $conn;

    $username       = htmlspecialchars($data["username"]);
    $firstname      = htmlspecialchars($data["f-name"]);
    $lastname       = htmlspecialchars($data["l-name"]);
    $country        = htmlspecialchars($data["country"]);
    $birthday       = htmlspecialchars($data["b-day"]);
    $occupation     = htmlspecialchars($data["occupation"]);
    $email          = htmlspecialchars($data["email"]);
    $mobilenumber   = htmlspecialchars($data["mobile"]);
    $phonenumber    = htmlspecialchars($data["phone"]);

    $query = "UPDATE profileuser SET
                firstname = '$firstname',
                lastname = '$lastname',
                country = '$country',
                birthday = '$birthday',
                occupation = '$occupation',
                email = '$email',
                mobilenumber = '$mobilenumber',
                phonenumber = '$phonenumber'
                WHERE username = '$username'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
}

function registrasi($data){
    global $conn;

    $username=strtolower(stripcslashes($data['fullname']));

    $password=mysqli_real_escape_string($conn, $data['password']);
    $password2=mysqli_real_escape_string($conn, $data['password2']);

    $result=mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");

    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('username sudah ada');
            </script>
        ";
        return false;
    }

    if($password!==$password2){
        echo "
            <script>
                alert('password anda tidak sama');
            </script>
        ";
        return false;
    }

    // $password=md5($password);
    $password=password_hash($password, PASSWORD_DEFAULT);
    var_dump($password);

    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$password')");
    mysqli_query($conn, "INSERT INTO profileuser VALUES ('', '$username', '', '', '', '', '', '', '', '')");
    
    return mysqli_affected_rows($conn);
}
?>