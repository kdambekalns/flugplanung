<?php
session_save_path(realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
session_destroy();
header("Location: login_page.php");
exit;
