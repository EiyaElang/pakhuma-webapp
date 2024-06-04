<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['psw'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Prepare Error: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Sign-Up berhasil! Silakan login.');window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Sign-Up gagal! Silakan coba lagi.');window.location.href='signup.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edamame Travel</title>
    <link href="style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
</head>
<body>

<div class="nav-box">
<div class="nav">
    <a href="index.html"><div class="nav-judul">Edamame Travel</div></a>
    <div class="nav-page">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.php">Pesan Tiket</a></li>
            <li><a href="login.php">Log-In</a></li>
            <li><a href="signup.php" class="sign">Sign-Up</a></li>
        </ul>
    </div>
</div>
</div> 

<div class="box-form">
    <div class="form-judul">Sign-Up</div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-text">
            Username
            <br>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <br>
            Email
            <br>
            <input type="email" placeholder="Enter Email" name="email" required>
            <br>
            Password
            <br>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <br>
            <button type="submit">Sign-Up</button>
        </div>
    </form>
</div>

</body>
</html>