<?php
require 'includes/db_connect.php';

$name = "Super Admin";
$email = "admin@glorious.com";
$password = password_hash("Admin@123", PASSWORD_DEFAULT); // Change password as needed
$role = "admin";

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $name, $email, $password, $role);

if($stmt->execute()){
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->error;
}
?>
