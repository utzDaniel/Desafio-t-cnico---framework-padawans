<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<title>Daniel dos Anjos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
	<body>
<?php
	$url = "https://jsonplaceholder.typicode.com/todos/1";
	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$resultTotal = json_decode(curl_exec($ch));

	foreach ($resultTotal as $resultado){
		echo $resultado;
	}
?>
    </body>
</html>