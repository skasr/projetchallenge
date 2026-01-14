<?php
// Gestion des sessions

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getCurrentUser() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'nom' => $_SESSION['user_nom'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role']
        ];
    }
    return null;
}

function login($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nom'] = $user['nom'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];
}

function logout() {
    session_destroy();
    header('Location: /views/login.php');
    exit();
}

function hasRole($role) {
    if (!isLoggedIn()) {
        return false;
    }
    return $_SESSION['user_role'] === $role;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /views/login.php');
        exit();
    }
}
?>