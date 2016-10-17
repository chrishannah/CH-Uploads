<?php
    include 'connection.php';

    $sql = "SELECT `id`, `title` FROM uploads";
    $result = $connection->query($sql);

    $pagetitle = "All Uploads";
    include 'header.php';
?>

<div id="content">
    <h1>All Uploads</h1>

   <table id="uploads">

        <?php
            while($row = $result->fetch_assoc()) {
                echo '<tr><td><a href="file.php?id=';
                echo $row['id'];
                echo '">';
                echo $row['title'];
                echo '</a></td></tr>';
            }
        ?>
    </table>

</div>

<?php include 'footer.php'; ?>
