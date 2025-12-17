<?php
require "src/Lib/Database.php";

use Src\Lib\Database;

$db = new Database();
$conn = $db->pdo();

echo "Connected Successfully!";


