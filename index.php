<?php
ob_start(); // cegah output sebelum session_start
session_start();
date_default_timezone_set('Asia/Jakarta');
error_log("SESSION STARTED: " . print_r($_SESSION, true));
require_once __DIR__ . '/helpers/routes.php';
