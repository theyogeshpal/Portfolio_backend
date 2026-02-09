<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(['success' => true, 'message' => 'Upload endpoint is alive. Post multipart/form-data here.']);
    exit;
}

try {
    file_put_contents('upload_debug.log', "[" . date('Y-m-d H:i:s') . "] Hit with " . $_SERVER['REQUEST_METHOD'] . "\n", FILE_APPEND);
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    }

    if (!isset($_FILES['image'])) {
        $input = file_get_contents('php://input');
        file_put_contents('upload_debug.log', "No image in FILES. POST data: " . json_encode($_POST) . " Raw input length: " . strlen($input) . "\n", FILE_APPEND);
        throw new Exception("No image uploaded. Check if the field name is 'image'.");
    }

    $file = $_FILES['image'];
    file_put_contents('upload_debug.log', "Received file: " . $file['name'] . " Size: " . $file['size'] . " Error: " . $file['error'] . "\n", FILE_APPEND);

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Upload error code: " . $file['error']);
    }

    $allowed_types = [
        'image/jpeg', 'image/png', 'image/webp', 'image/gif',
        'application/pdf', 'application/msword', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception("Invalid file type: " . $file['type'] . ". Allowed: JPG, PNG, WEBP, GIF, PDF, DOC, DOCX");
    }

    // Max 5MB
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception("File too large. Max size is 5MB.");
    }

    $upload_dir = '../images/';
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            throw new Exception("Failed to create upload directory: " . $upload_dir);
        }
    }

    if (!is_writable($upload_dir)) {
        throw new Exception("Upload directory is not writable: " . realpath($upload_dir));
    }

    $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($file['name']));
    $target_path = $upload_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        file_put_contents('upload_debug.log', "Success: Saved to " . $target_path . "\n", FILE_APPEND);
        echo json_encode([
            'success' => true, 
            'path' => './images/' . $filename,
            'message' => 'Image uploaded successfully'
        ]);
    } else {
        throw new Exception("Failed to move uploaded file. Check permissions or temp path.");
    }
} catch (Exception $e) {
    file_put_contents('upload_debug.log', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
