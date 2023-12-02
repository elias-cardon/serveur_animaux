<?php
//Pointe automatiquement vers l'URL du chemin, que ce soit en local ou en ligne
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));