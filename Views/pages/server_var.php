<?php
// Obtener la carpeta principal
$path_parts = explode('/', $_SERVER['REQUEST_URI']);
$principal_fold = $path_parts[1];

// Obtener el protocolo
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Obtener el host
$host = $_SERVER['HTTP_HOST'];

// URL principal 
$princ_url = $protocol . $host . '/' . $principal_fold;
