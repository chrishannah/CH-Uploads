<?php
    
    include 'connection.php';
    
    $sql = "SELECT `id`, `title` FROM uploads";
    $result = $connection->query($sql);
?>

<?php include 'header.php'; ?>

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

<?php include 'footer.php'; ?>