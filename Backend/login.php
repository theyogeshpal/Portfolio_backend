<?php
require_once 'db_config.php';

try {

    // In PHP 8.1+, mysqli_connect throws an exception on failure if not configured otherwise.
    // However, we still check $conn for safety.
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username == '' || $password == '') {
        echo json_encode(['success' => false, 'message' => 'Username or password missing']);
        exit;
    }

    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        throw new Exception("Database query failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user) {
        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'username' => $user['username']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }

} catch (mysqli_sql_exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
