<?php
session_start();
if(isset($_GET["id"])) {
    $_SESSION["creation_id"] = $_GET["id"];
}

echo 'Session variable set successfully.';
?>
