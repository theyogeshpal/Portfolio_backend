<?php
require_once 'db_config.php';
    if (!$conn) throw new Exception("Connection failed");
    $result = mysqli_query($conn, "SELECT * FROM strengths ORDER BY id ASC");
    if (!$result) throw new Exception(mysqli_error($conn));
    echo json_encode(['success' => true, 'data' => mysqli_fetch_all($result, MYSQLI_ASSOC)]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
