<?php
require_once 'db_config.php';

try {
    if (!$conn) throw new Exception("Connection failed");

    $action = $_POST['action'] ?? '';
    
    if ($action === 'save') {
        $id = isset($_POST['id']) && !empty($_POST['id']) ? intval($_POST['id']) : null;
        $year = mysqli_real_escape_string($conn, $_POST['year'] ?? '');
        $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
        $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
        $image = mysqli_real_escape_string($conn, $_POST['image'] ?? '');
        $side = mysqli_real_escape_string($conn, $_POST['side'] ?? 'left');
        $aos = ($side === 'left') ? 'fade-right' : 'fade-left';

        if ($id) {
            $query = "UPDATE certificates SET year='$year', title='$title', description='$description', image='$image', side='$side', aos='$aos' WHERE id=$id";
        } else {
            $query = "INSERT INTO certificates (year, title, description, image, side, aos) VALUES ('$year', '$title', '$description', '$image', '$side', '$aos')";
        }
    } elseif ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception("Invalid ID");
        $query = "DELETE FROM certificates WHERE id=$id";
    } else {
        throw new Exception("Invalid action");
    }

    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }

    echo json_encode(['success' => true, 'message' => 'Certificate operation successful']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
