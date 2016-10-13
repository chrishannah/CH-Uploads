<?php

    $connection = new mysqli("localhost", "uploader", "uploader123", "uploads");
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    ?>