<?php
    $id = 0;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
    }

    include 'connection.php';

    $sql = "SELECT `title`, `description`, `date`, `file`, `views`, `type` FROM uploads WHERE id = $id";
    $result = $connection->query($sql);
    $upload = $result->fetch_assoc();

    if (mysqli_num_rows($result) == 0) {
        header( 'Location: nope.php' ) ;
    }

    $title = $upload['title'];
    if ($title == "") {
        $mediaType = ucwords($upload['type']);
        $title = "Unnamed $mediaType";
    }
    $pagetitle = $title;
    $description =  $upload['description'];
    if ($description == "") {
        $description = "There's no description for this, clearly it wasn't worth one.";
    }
    $date =  $upload['date'];
    $file =  $upload['file'];
    $views =  $upload['views'];
    $type =  $upload['type'];

    $pageURL = "http://chrishannah.me/uploads/file.php?id=$id";
    $directURL = "http://chrishannah.me/uploads/$file";

    $views++;
    $sql = "UPDATE `uploads` SET `views` = $views WHERE `id` = $id";
    $result = $connection->query($sql);
?>

<?php include 'header.php'; ?>

<div id="content">

    <h1><?php echo $title; ?></h1>

    <p><?php echo $views ?> views</p>

    <p>
        <?php
            if ($type == "image") {
                echo '<img src="'.$file.'">';
            } else if ($type == "video") {
                echo '<video src="'.$file.'" controls/>';
            }
        ?>
    </p>

    <p>
        <strong>Date</strong> <br />
        <?php echo date("d-m-Y", strtotime($date)); ?>
    <p>
        <strong>Description</strong> <br />
        <?php echo $description; ?>
    </p>

    <div id="links">
        <strong>Links</strong><br />
        <ul>
            <li><a href="<?php echo $pageURL; ?>">Web Page</a></li>
            <li><a href="<?php echo $directURL; ?>">Direct Link</a></li>
            <li><a
              href="https://twitter.com/intent/tweet"
              class="twitter-mention-button"
              data-size="large"
              data-text="<?php echo "$title via $site_twitter"; ?>"
              data-related="<?php echo $site_twitter; ?>"
              data-show-count="false">
              Tweet</a>
              <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></li>
        </ul>
    </div>
</div>

<?php include 'footer.php'; ?>
