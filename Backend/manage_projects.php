<?php
require_once 'db_config.php';

try {
    if (!$conn) throw new Exception("Connection failed");

    $action = $_POST['action'] ?? '';
    
    if ($action === 'save') {
        $id = isset($_POST['id']) && !empty($_POST['id']) ? intval($_POST['id']) : null;
        $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
        $category = mysqli_real_escape_string($conn, $_POST['category'] ?? '');
        $link = mysqli_real_escape_string($conn, $_POST['link'] ?? '');
        $image = mysqli_real_escape_string($conn, $_POST['image'] ?? '');
        $technologies = mysqli_real_escape_string($conn, $_POST['technologies'] ?? '');

        if ($id) {
            $query = "UPDATE projects SET title='$title', category='$category', link='$link', image='$image', technologies='$technologies' WHERE id=$id";
        } else {
            $query = "INSERT INTO projects (title, category, link, image, technologies) VALUES ('$title', '$category', '$link', '$image', '$technologies')";
        }
    } elseif ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception("Invalid ID");
        $query = "DELETE FROM projects WHERE id=$id";
    } else {
        throw new Exception("Invalid action");
    }

    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }

    echo json_encode(['success' => true, 'message' => 'Project operation successful']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
