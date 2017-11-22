<?php
require_once('header.php');

if(empty($_SESSION['token-object'])){//if not logged in redirect to
	header('Location: oauth.php');
} else {
	refresh_token();

echo '<!DOCTYPE html>
<html>
<head>';

echo'<meta charset="utf-8">';

echo '<title>EUni BLAP Fittings</title>
</head>
<body>';

echo '

';


echo '</body>
</html>';

}

?>
