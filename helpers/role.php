<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function requireRole($role) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
        error_log("Session not set or role mismatch. Current session: " . print_r($_SESSION, true));
        header('Location: index.php?action=login');
        exit;
    }
}


function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=login');
        exit;
    }
}
