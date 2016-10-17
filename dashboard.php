<?php
    include 'connection.php';

    $sql = "SELECT `id`, `title`, `views`, `type` FROM uploads";
    $result = $connection->query($sql);

    $pagetitle = "All Uploads";
    include 'header.php';
?>

<div id="content">

    <h1>Upload</h1>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="uploadFile" id="uploadFile"><br />
        <input type="text" id="title" name="title" placeholder="Title" /><br />
        <textarea id="description" name="description" placeholder="Description"rows="3"></textarea><br />
        <input type="submit" value="Upload" name="submit">
    </form>

    <h1>Analytics</h1>

    <?php include('uploads-table.php'); ?>

</div>

<?php include 'footer.php'; ?>
