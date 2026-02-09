<?php
require_once 'db_config.php';

try {
    if (!$conn) throw new Exception("Connection failed");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    $para1 = mysqli_real_escape_string($conn, $_POST['para1'] ?? '');
    $para2 = mysqli_real_escape_string($conn, $_POST['para2'] ?? '');
    $para3 = mysqli_real_escape_string($conn, $_POST['para3'] ?? '');
    $profile_image = mysqli_real_escape_string($conn, $_POST['profile_image'] ?? '');
    $about_image = mysqli_real_escape_string($conn, $_POST['about_image'] ?? '');

    // Check if about record exists
    $check = mysqli_query($conn, "SELECT id FROM about LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $id = $row['id'];
        $query = "UPDATE about SET para1='$para1', para2='$para2', para3='$para3', profile_image='$profile_image', about_image='$about_image' WHERE id=$id";
    } else {
        $query = "INSERT INTO about (para1, para2, para3, profile_image, about_image) VALUES ('$para1', '$para2', '$para3', '$profile_image', '$about_image')";
    }

    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }

    echo json_encode(['success' => true, 'message' => 'About section updated successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
