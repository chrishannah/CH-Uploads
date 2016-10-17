<?php
	include 'connection.php';

	$sql = "SELECT `id`, `title`, `type`, `views` FROM uploads";
	$result = $connection->query($sql);

	echo '<table id="uploads>"';
	echo '<thead><th>Title</th><th>Views</th><th>Type</th></thead>';

	while($row = $result->fetch_assoc()) {
			$title = $row['title'];
			if ($title == "") {
					$mediaType = ucwords($row['type']);
					$title = "Unnamed $mediaType";
			}

			echo '<tr><td>';
			echo '<a href="file.php?id='.$row['id'].'">'.$title.'</a></td>';
			echo '<td>'.$row['views'].'</td>';
			echo '<td>'.ucwords($row['type']).'</td></tr>';
	}

	echo '</table>';

	?>
