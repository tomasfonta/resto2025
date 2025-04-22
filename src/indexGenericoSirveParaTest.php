<?php
$host = 'db';
$user = 'testuser';
$pass = 'testpass';
$db = 'testdb';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

echo "🎉 Hello World from PHP!<br>";
echo "✅ Connected to MariaDB successfully!";
