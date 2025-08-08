<?php

// Static files
if (file_exists($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'])) {
    return false;
}

// Laravel bootstrap
require_once __DIR__ . '/public/index.php';