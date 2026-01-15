<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "suvidha_kendra");
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

$msg = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM agents WHERE email='$email'");
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['agent_name'] = $row['name'];
            $_SESSION['agent_email'] = $row['email'];
            header("Location: homepage.html"); // Redirect after login
            exit;
        } else {
            $msg = "Incorrect password!";
        }
    } else {
        $msg = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Hamara Suvidha Kendra</title>
<style>
body{font-family:Arial,sans-serif;background:linear-gradient(135deg,#eaffea,#ffffff);margin:0;padding:0}
.container{max-width:400px;margin:80px auto;padding:40px;background:#fff;border-radius:20px;box-shadow:0 8px 25px rgba(0,0,0,.15)}
h2{text-align:center;color:#0a2a66;margin-bottom:25px}
input[type=email],input[type=password]{width:100%;padding:12px 15px;margin:10px 0;border-radius:12px;border:1px solid #ccc;font-size:14px}
input[type=submit]{width:100%;padding:12px;background:#0a7cff;color:#fff;font-weight:bold;font-size:16px;border:none;border-radius:12px;margin-top:10px;cursor:pointer;transition:.3s}
input[type=submit]:hover{background:#085ec3}
.msg{text-align:center;color:#c0392b;margin-bottom:10px;font-weight:bold}
a{display:block;text-align:center;margin-top:12px;color:#0a7cff;text-decoration:none;font-weight:bold}
a:hover{color:#085ec3}
</style>
</head>
<body>
<div class="container">
<h2>Agent Login</h2>
<?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<input type="submit" name="login" value="Login">
</form>
<a href="register.php">Don't have an account? Register</a>
</div>
</body>
</html>