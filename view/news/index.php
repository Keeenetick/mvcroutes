<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php foreach ($newsList as $news): ?>
		<p><?php echo $news['title'];?></p>
		<p><?php echo $news['date'];?></p>
		<p><?php echo $news['short_content'];?></p>
		<a href="/news/<?php echo $news['id'];?>">Читать далее</a>
	<?php endforeach; ?>
	
</body>
</html>