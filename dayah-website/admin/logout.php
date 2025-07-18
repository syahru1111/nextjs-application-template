<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Log activity if user is logged in
if (isLoggedIn()) {
    logActivity('logout', 'Admin logout', $_SESSION['admin_id']);
}

// Destroy session
session_destroy();

// Redirect to login page with success message
redirect(SITE_URL . '/admin/?logout=success');
?>
