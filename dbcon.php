<?php
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "login-system-1");

    $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if(!$conn) {
        die("Connection failed");
    }

    echo "Connection successful";