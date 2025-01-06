<?php
// Définir l'en-tête pour retourner du JSON
header('Content-Type: application/json');

// Chemin vers le fichier JSON contenant les données des courses
$coursesFile = 'courses.json';

// Vérifier si le fichier existe et le charger
if (!file_exists($coursesFile)) {
    http_response_code(500);
    echo json_encode(['error' => 'Fichier courses.json introuvable']);
    exit;
}

$coursesData = json_decode(file_get_contents($coursesFile), true);

// Vérifier si un ID de course est fourni en paramètre
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    // Parcourir les données des courses pour trouver celle qui correspond à l'ID
    foreach ($coursesData as $course) {
        if ($course['id'] == $courseId) {
            // Retourner les données de la course en format JSON
            echo json_encode($course);
            exit;
        }
    }

    // Si la course avec cet ID n'est pas trouvée
    http_response_code(404);
    echo json_encode(['error' => 'Course not found']);
    exit;
} else {
    // Si aucun ID n'est fourni
    http_response_code(400);
    echo json_encode(['error' => 'ID is required']);
    exit;
}
?>
