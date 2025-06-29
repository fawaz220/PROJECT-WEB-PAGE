
<?php
session_start();
include "db.php";
$email = $_POST["email"];
$password = $_POST["password"];
$sql = "SELECT username, password FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($username, $hashed_password);
    $stmt->fetch();
    if (password_verify($password, $hashed_password)) {
        $_SESSION["user"] = $username;
        header("Location: welcome.php");
        exit();
    }
}
echo "Invalid email or password.";
?>
