<!doctype html>
<html>

<?php
    
    $id = 0;
    
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    
    $connection = new mysqli("127.0.0.1", "uploader", "upload123", "uploads");
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    $sql = "SELECT `title`, `description`, `date`, `file`, `views`, `type` FROM uploads WHERE id = $id";
    $result = $connection->query($sql);
    $upload = $result->fetch_assoc();
    
    if (mysqli_num_rows($result) == 0) {
        header( 'Location: nope.php' ) ;
    }
    
    
    $title = $upload['title'];
    $description =  $upload['description'];
    $date =  $upload['date'];
    $file =  $upload['file'];
    $views =  $upload['views'];
    $type =  $upload['type'];
    
    $pageURL = "http://www.chrishannah.me/uploads/file.php?id=$id";
    $directURL = "http://www.chrishannah.me/uploads/$file";
    
    $views++;
    $sql = "UPDATE `uploads` SET `views` = $views WHERE `id` = $id";
    $result = $connection->query($sql);
    
    $mediaType = "something";
    
    switch ($type) {
        case "mp4":
        case "mkv":
        case "mov":
            $mediaType = "video";
            break;
        case "jpg":
        case "jpeg":
        case "gif":
        case "png":
        default: 
            $mediaType = "image";
            break;
    }
    
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
        <h1><?php echo $title; ?></h1>
        <p>
            <?php echo $views ?> views
        </p>
        
        <p>
            <?php
                if ($mediaType == "image") {
                    echo '<img src="';
                    echo $file;
                    echo '">';
                }
                
                if ($mediaType == "video") {
                    echo '<video src="';
                    echo $file;
                    echo '" controls/>';
                }
            
            ?>
        </p>
        
        <p>
            <strong>Date</strong> <br />
            <?php echo $date; ?></p>
        <p>
            <strong>Description</strong> <br />
            <?php echo $description; ?>
        </p>
        <div id="links">
            <strong>Links</strong><br />
            <ul>
                <li><a href="<?php echo $pageURL; ?>">Web Page</a></li>
                <li><a href="<?php echo $directURL; ?>">Direct Link</a></li>
                
                <?php 
                    $tweet = "$title via @chrishannah";
                ?>
                    
                <li><a href="https://twitter.com/intent/tweet" class="twitter-mention-button" data-size="large" data-text="<?php echo $tweet; ?>" data-related="chrishannah" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></li>
            </ul>
        </div>
    </div>
    <div id="footer">
        <a href="http://www.twitter.com/chrishannah">Chris Hannah</a> &copy; 2016
    </div>
</body>
    
</html>