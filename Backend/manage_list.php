<?php
require_once 'db_config.php';

try {
    if (!$conn) throw new Exception("Connection failed");

    $action = $_POST['action'] ?? '';
    $type = $_POST['type'] ?? ''; // education, strengths, technical_knowledge
    $valid_types = ['education', 'strengths', 'technical_knowledge'];

    if (!in_array($type, $valid_types)) {
        throw new Exception("Invalid list type");
    }

    if ($action === 'add') {
        $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
        if (empty($title)) throw new Exception("Title is required");
        $query = "INSERT INTO $type (title) VALUES ('$title')";
    } elseif ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception("Invalid ID");
        $query = "DELETE FROM $type WHERE id=$id";
    } else {
        throw new Exception("Invalid action");
    }

    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }

    echo json_encode(['success' => true, 'message' => ucfirst($action) . ' successful']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
