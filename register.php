<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "suvidha_kendra");
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

$msg = "";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM agents WHERE email='$email'");
    if($check->num_rows > 0){
        $msg = "Email already registered!";
    } else {
        $conn->query("INSERT INTO agents (name,email,password) VALUES ('$name','$email','$password')");
        $msg = "Registration successful! You can now login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Hamara Suvidha Kendra</title>
<style>
body{font-family:Arial,sans-serif;background:linear-gradient(135deg,#dde6f7,#ffffff);margin:0;padding:0}
.container{max-width:450px;margin:80px auto;padding:40px;background:#fff;border-radius:20px;box-shadow:0 8px 25px rgba(0,0,0,.15)}
h2{text-align:center;color:#0a2a66;margin-bottom:25px}
input[type=text],input[type=email],input[type=password]{width:100%;padding:12px 15px;margin:10px 0;border-radius:12px;border:1px solid #ccc;font-size:14px}
input[type=submit]{width:100%;padding:12px;background:#0a7cff;color:#fff;font-weight:bold;font-size:16px;border:none;border-radius:12px;margin-top:10px;cursor:pointer;transition:.3s}
input[type=submit]:hover{background:#085ec3}
.msg{text-align:center;color:#c0392b;margin-bottom:10px;font-weight:bold}
a{display:block;text-align:center;margin-top:12px;color:#0a7cff;text-decoration:none;font-weight:bold}
a:hover{color:#085ec3}
</style>
</head>
<body>
<div class="container">
<h2>Agent Registration</h2>
<?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>
<form method="POST">
<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<input type="password" name="cpassword" placeholder="Confirm Password" required>
<input type="submit" name="register" value="Register">
</form>
<a href="login.php">Already have an account? Login</a>
</div>
</body>
</html>