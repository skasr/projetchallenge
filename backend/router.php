<?php
// Routeur pour le serveur PHP
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Retire le slash du début
$uri = ltrim($uri, '/');

// Si vide, redirige vers login
if (empty($uri) || $uri === '/') {
    $uri = 'views/login.php';
}

// Construit le chemin complet
$file = __DIR__ . '/' . $uri;

// Si le fichier existe, l'inclut
if (file_exists($file) && !is_dir($file)) {
    return false; // Laisse PHP servir le fichier
} else {
    // Fichier non trouvé
    http_response_code(404);
    echo "Fichier non trouvé : $uri";
}
?>