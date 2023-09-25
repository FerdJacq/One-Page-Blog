<?php
session_start();

// Unset and destroy the isAdmin session variable
unset($_SESSION['isAdmin']);
session_destroy();
?>