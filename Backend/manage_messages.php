<?php
require_once 'db_config.php';

try {
    if (!$conn) throw new Exception("Connection failed");

    $action = $_REQUEST['action'] ?? 'fetch';
    
    if ($action === 'fetch') {
        $result = mysqli_query($conn, "SELECT * FROM contacts ORDER BY created_at DESC");
        $messages = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $messages]);
    } elseif ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception("Invalid ID");
        $query = "DELETE FROM contacts WHERE id=$id";
        if (!mysqli_query($conn, $query)) throw new Exception(mysqli_error($conn));
        echo json_encode(['success' => true, 'message' => 'Message deleted successfully']);
    } elseif ($action === 'clear') {
        $query = "TRUNCATE TABLE contacts";
        if (!mysqli_query($conn, $query)) throw new Exception(mysqli_error($conn));
        echo json_encode(['success' => true, 'message' => 'All messages cleared']);
    } else {
        throw new Exception("Invalid action");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
