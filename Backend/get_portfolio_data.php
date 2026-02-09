<?php
require_once 'db_config.php';

    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    $response = [
        'success' => true,
        'data' => []
    ];

    // Fetch About
    $aboutResult = mysqli_query($conn, "SELECT * FROM about LIMIT 1");
    $response['data']['about'] = mysqli_fetch_assoc($aboutResult);

    // Fetch Education
    $eduResult = mysqli_query($conn, "SELECT * FROM education ORDER BY id ASC");
    $response['data']['education'] = mysqli_fetch_all($eduResult, MYSQLI_ASSOC);

    // Fetch Strengths
    $strengthResult = mysqli_query($conn, "SELECT * FROM strengths ORDER BY id ASC");
    $response['data']['strengths'] = mysqli_fetch_all($strengthResult, MYSQLI_ASSOC);

    // Fetch Technical Knowledge
    $techResult = mysqli_query($conn, "SELECT * FROM technical_knowledge ORDER BY id ASC");
    $response['data']['technical_knowledge'] = mysqli_fetch_all($techResult, MYSQLI_ASSOC);

    // Fetch Projects
    $projectsResult = mysqli_query($conn, "SELECT * FROM projects ORDER BY id ASC");
    $response['data']['projects'] = mysqli_fetch_all($projectsResult, MYSQLI_ASSOC);

    // Fetch Certificates
    $certResult = mysqli_query($conn, "SELECT * FROM certificates ORDER BY year ASC");
    $response['data']['certificates'] = mysqli_fetch_all($certResult, MYSQLI_ASSOC);

    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
