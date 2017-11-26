<?php
require_once('oauth-header.php');

if(empty($_SESSION['token-object'])){//if not logged in redirect to
	header('Location: oauth.php');
} else {
	refresh_token();

echo '<!DOCTYPE html>
<html>
<head>';

echo'
<meta charset="utf-8">
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="js/form.js"></script>
';

echo '<title>EUni BLAP Fittings</title>
</head>
<body>';

echo '
<h2>EFT Fit:</h2>
<form id="fitting_form">
<p><textarea name="fit" rows="25" cols="70"></textarea></p>
<input type="submit">
</form>
';


echo '</body>
</html>';

}

?>
