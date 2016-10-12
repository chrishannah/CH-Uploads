<!doctype html>
<html>

<?php
    
    $connection = new mysqli("127.0.0.1", "uploader", "upload123", "uploads");
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    $sql = "SELECT `id`, `title` FROM uploads";
    $result = $connection->query($sql);
?>


<head>
    <title>Chris Hannah | <?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    
<body>
    <div id="header">
        <strong>Chris Hannah</strong> Uploads
    </div>
    <div id="content">
        <h1>All Uploads</h1>
        
        <ul>
            <?php
                while($row = $result->fetch_assoc()) {
                    echo '<li><a href="file.php?id=';
                    echo $row['id'];
                    echo '">';
                    echo $row['title'];
                    echo '</a></li>';
                }
            ?>
        </ul>
        
    </div>
    <div id="footer">
        <a href="http://www.twitter.com/chrishannah">Chris Hannah</a> &copy; 2016
    </div>
</body>
    
</html>