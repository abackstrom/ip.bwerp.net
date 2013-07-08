<?php

switch( $_SERVER['QUERY_STRING'] ) {
	case 'txt':
	case 'simple': die( $_SERVER['REMOTE_ADDR'] );
	case 'fail': header('HTTP/1.0 404 Not Found'); die('404 Not Found');
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title><?php echo $_SERVER['HTTP_HOST']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
	* { margin: 0; padding: 0; }
	body { background-color: black; font-family: Trebuchet MS, Arial, sans-serif; }
	p { color: white; text-align: center; margin-top: 2em; }
	p#ip { font-size: 300%; }
	p#host { margin-bottom: 0; }
	p#custom { margin-top: 1ex; }
	p#ua { margin-top: 5em; }
	</style>
</head>

<body>

<?php

if($_SERVER['HTTP_HOST'] == 'ip.bwerp.net')
{
	$ip = $_SERVER["REMOTE_ADDR"];
	$host = gethostbyaddr($ip);

	if($host == $ip)
	{
		$host = '';
	}

	$customs = array(
		'sixohthree.com' => 'server5.bwerp.net',
		'cpe-76-178-194-111.maine.res.rr.com' => 'server4.bwerp.net'
	);

	?>

	<p id="ip"><?php echo $ip; ?></p>

	<?php if($host != ''): ?>
		<p id="host"><?php echo $host; ?></p>
	<?php endif; ?>

	<?php if(array_key_exists($host, $customs)): ?>
		<p id="custom"><?php echo $customs[$host]; ?></p>
	<?php endif;
}
elseif($_SERVER['HTTP_HOST'] == 'ua.bwerp.net')
{
	?>
	<p id="ua"><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
	<?php
}
?>

</body>

</html>
