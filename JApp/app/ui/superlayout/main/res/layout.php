<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en-US" prefix="og: http://ogp.me/ns#"><!--<![endif]-->
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="Content-Language" content="en" >
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		{{super_head}}
		<?= $mData->metaTags() ?>
		<title><?= $mData->title() ?></title>
	</head>

	<body>

	<div class="_body">
		<div class="_header"><div class="_reset">{{super_header}}</div></div>

		<div class="_content"><div class="_reset">{{super_content}}</div></div>

		<div class="_footer"><div class="_reset" >{{super_footer}}</div></div>
	</div>

	{{super_script}}

	</body>
</html>
