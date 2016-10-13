<?php

    $connection = new mysqli("127.0.0.1", "uploader", "upload123", "uploads");
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    ?>