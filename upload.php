<?php

   function generateRandomString($length = 10) {
     return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
   }

   if(isset($_FILES['uploadFile'])){
      $errors= array();
      $file_name = $_FILES['uploadFile']['name'];
      $file_size = $_FILES['uploadFile']['size'];
      $file_tmp = $_FILES['uploadFile']['tmp_name'];
      $file_type = $_FILES['uploadFile']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['uploadFile']['name'])));

      if(empty($errors)==true) {
         include'customisation.php';
         include 'connection.php';

         $title = mysqli_real_escape_string($connection, $_POST["title"]);
         $description = mysqli_real_escape_string($connection, $_POST["description"]);
         $file_name = mysqli_real_escape_string($connection, $file_name);
         $type =  pathinfo($file_name, PATHINFO_EXTENSION);

         $fileExists = true;

         while ($fileExists) {
           $randString = generateRandomString();
           $randFileName = $randString.'.'.$type;
           if (!file_exists($uploadDirectory.$randFileName)) {
             $fileExists = false;
           }
         }

         move_uploaded_file($file_tmp,$uploadDirectory.$randFileName);

         $mediaType = "something";

         switch ($type) {
             case "mp4":
             case "mkv":
             case "mov":
             case "ogg":
             case "webm":
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

         $sql = "INSERT INTO uploads (title, description, date, file, views, type) VALUES ('$title', '$description', NOW(), '$randFileName', '0', '$mediaType')";


        // SQL Debugging
        // echo '<p><strong>SQL Query</strong><br />'.$sql.'</p>';

         $result = $connection->query($sql);
         $sql = "SELECT COUNT(id) FROM uploads;";
         $result = $connection->query($sql);
         $upload = $result->fetch_assoc();
         $id = $upload["COUNT(id)"];

         header('Location: file.php?id='.$id) ;

      }else{
         print_r($errors);
      }
   }
?>
