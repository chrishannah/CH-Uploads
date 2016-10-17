CREATE TABLE `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(50),
  `description` varchar(200),
  `date` datetime,
  `file` varchar(100),
  `views` int(11),
  `type` varchar(5)
  );
