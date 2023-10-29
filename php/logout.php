<?php 
if (!isset($_SESSION)) {
    session_start();
}

session_destroy();

header("Location: /inovafin_site/index.html");
exit();
?>