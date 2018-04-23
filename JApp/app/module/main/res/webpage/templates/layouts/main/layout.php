<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html">

		<meta name="Content-Language" content="hi" >
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

		<link rel="shortcut icon" href="<?= $this->app()->url() ?>/resource/icons/favicon.ico">

		<?= $head ;?>

		<link rel="stylesheet" href="<?= $this->app()->url() ?>/resource/app/icons.css" />
		<link rel="stylesheet" href="<?= $this->app()->url() ?>/resource/app/style.css" />
	</head>

	<body>

	<div class="_body">
		<div class="_header">
		<?= $body->get('header') ; ?>
		</div>

		<div class="_content">
		<?= $body->get('content') ; ?>
		</div>

		<div class="_footer">
		<?= $body->get('footer') ; ?>
		</div>
	</div>
	<?= $body->script() ; ?>
	</body>
</html>
