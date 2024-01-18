<?php
try {
    $db = new PDO("pgsql:host=ip.fidanhome.ovh;dbname=SAE", "DraCorporation", "PJFWf3EMjlNZ314C2sRg");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>