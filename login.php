
<?php
include "support/koneksi.php";

session_start();
if( isset($_SESSION["login"])) {
 header("Location: index.php");
 exit;
} 
$error="";

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
 
  $result = mysqli_query($connect, "SELECT * FROM login where username ='$username'");

  if (mysqli_num_rows($result) === 1) {
   $row = mysqli_fetch_assoc($result);
   if ($password == $row["password"])
   {
    $_SESSION['username'] = $username;
    $_SESSION ["login"] = true;
    header("Location: index.php");
    // echo $row["username"];

    exit; 
   }
  }  else {
   $error = "*Username/Password salah";
  }
 }
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

body {
  background: #456;
  font-family: 'Open Sans', sans-serif;
}

.login {
  width: 400px;
  margin: 16px auto;
  font-size: 16px;
}

/* Reset top and bottom margins from certain elements */
.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

/* The triangle form is achieved by a CSS hack */
.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #28d;
}

.login-header {
  background: #28d;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

/* Every row inside .login-container is defined with p tags */
.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="email"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

/* Text fields' focus effect */
.login input[type="email"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login button[type="submit"] {
  box-sizing: border-box;
  display: block;
  width: 100%;
  padding: 16px;
  background: #28d;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #17c;
}

/* Buttons' focus effect */
.login input[type="submit"]:focus {
  border-color: #05a;
}
</style>
</head>
<body>

<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in</h2>

  <form class="login-container" method="POST">
    <p><input type="text" name="username" placeholder="Username" autocomplete="off" required></p>
    <p><input type="password" name="password" placeholder="Password" required></p>
    <p><button type="submit" name="login" >Log in</button></p>
    <p style="color:red;"><i><?php echo $error;?></i></p>
  </form>
</div>

</body>
</html>

