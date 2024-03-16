<?php
// Starting this session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroying the session
session_destroy();

// Response
http_response_code(200);
?>
