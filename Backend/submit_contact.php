<?php
require_once 'db_config.php';

try {

    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        throw new Exception("Missing required fields");
    }

    // Sanitize
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $message = mysqli_real_escape_string($conn, $message);

    $sql = "INSERT INTO contacts (name, email, mobile, message) VALUES ('$name', '$email', '$mobile', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
    } else {
        throw new Exception("Failed to save message: " . mysqli_error($conn));
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
