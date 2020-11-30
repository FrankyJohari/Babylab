
<?php
include "support/koneksi.php";


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
  
  <h2 class="login-header">Change Password</h2>

  <form class="login-container" method="POST">
    <p><input type="type" name="username" value="<?php echo $_SESSION['username']?>" readonly></p>
    <p><input type="password" name="oldpw" placeholder="Old Password"></p>
    <p><input type="password" name="newpw" placeholder="New Password"></p>
    <p><input type="password" name="newpw2" placeholder="Confirm New Password"></p>
    <p><button type="submit" name="changepw">Confirm</button></p>
  </form>
</div>

</body>
</html>
