<?php
require_once 'db_config.php';

try {
    if (!$conn) throw new Exception("Connection failed");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
    $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $location = mysqli_real_escape_string($conn, $_POST['location'] ?? '');
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin'] ?? '');
    $github = mysqli_real_escape_string($conn, $_POST['github'] ?? '');
    $instagram = mysqli_real_escape_string($conn, $_POST['instagram'] ?? '');
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook'] ?? '');
    $discord = mysqli_real_escape_string($conn, $_POST['discord'] ?? '');
    $twitter = mysqli_real_escape_string($conn, $_POST['twitter'] ?? '');
    $cv = mysqli_real_escape_string($conn, $_POST['cv'] ?? '');

    // Check if contact record exists
    $check = mysqli_query($conn, "SELECT id FROM contact LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $id = $row['id'];
        $query = "UPDATE contact SET 
                    name='$name', 
                    phone='$phone', 
                    whatsapp='$whatsapp', 
                    email='$email', 
                    location='$location', 
                    linkedin='$linkedin', 
                    github='$github', 
                    instagram='$instagram', 
                    facebook='$facebook', 
                    discord='$discord', 
                    twitter='$twitter', 
                    cv='$cv' 
                  WHERE id=$id";
    } else {
        $query = "INSERT INTO contact (name, phone, whatsapp, email, location, linkedin, github, instagram, facebook, discord, twitter, cv) 
                  VALUES ('$name', '$phone', '$whatsapp', '$email', '$location', '$linkedin', '$github', '$instagram', '$facebook', '$discord', '$twitter', '$cv')";
    }

    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }

    echo json_encode(['success' => true, 'message' => 'Contact details updated successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
