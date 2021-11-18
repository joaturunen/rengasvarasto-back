<?php
session_start();
require_once '../inc/headers.php';
require_once '../inc/functions.php';
session_destroy();
header('HTTP/1.1 200 OK');
