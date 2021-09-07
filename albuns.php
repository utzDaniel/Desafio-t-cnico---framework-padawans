<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<title>ALBUNS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(95, 52, 115)">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="posts.php">POSTAGENS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="albuns.php">ALBUNS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="todos.php">TODOS</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<table class="table table-hover text-center table-dark m-0">
			<thead>
				<tr>
					<th scope="col" >#</th>
					<th> userId </th>
					<th> id </th>
					<th> title </th>
				</tr>
			</thead>
<?php
	$url = "https://jsonplaceholder.typicode.com/albums";
	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$resultTotal = json_decode(curl_exec($ch));
	$paginaAtual = (!isset($_GET['pagina'])) ? 1 : $_GET['pagina'];
	$exibirQts = 10;
	$totalPag=ceil((count($resultTotal)/$exibirQts));
	$exibirQtsPag = ($exibirQts * $paginaAtual)-$exibirQts;
	if($paginaAtual==1)
		$numero=1;
	else
		$numero=(10*$paginaAtual)-9;
	$resultLimit = $exibirQts;
	if($paginaAtual == $totalPag){
		$resultLimit = count($resultTotal) - (($totalPag-1)*$exibirQts);
	}
	for($j=0;$j < $resultLimit;$j++)
	{
		echo"<tbody class='bg-secondary'>";
		echo "<tr>";
		echo "<th scope='row'>".$numero."</th>";
		echo "<td> ".$resultTotal[$numero-1]->userId." </td>";
		echo "<td> ".$resultTotal[$numero-1]->id." </td>";
		echo "<td> ".$resultTotal[$numero-1]->title." </td>";
		$numero++;
	}
	echo "</tbody>";
	echo "</table>";
	echo"<nav class='bg-dark mx-auto text-warning navbar-default' style='font-size: 12px;'>";
		echo"<ul class='pagination justify-content-center p-3'>";
			echo"<li class='page-item'>";
			$Anterior=$paginaAtual;                         
				if($paginaAtual>1)
					$Anterior=$paginaAtual-1;
				echo"<a class='page-link text-warning bg-dark border-white' href='?pagina=".$Anterior."'>Anterior</a>";
			echo"</li>";
			for($i=1;$i<=$totalPag;$i++){
				if($i == $paginaAtual){
					echo "<li class='page-item m-1'><a class='page-link bg-warning text-white border-white' >".$i."</a></li>";
				}else{
					echo"<li class='page-item '><a class='page-link text-warning bg-dark border-white' href='?pagina=".$i."'>".$i."</a></li>";
				}
			}
			echo"<li class='page-item'>";
				$Proximo=$paginaAtual;  
				if($paginaAtual<$totalPag)
					$Proximo=$paginaAtual+1;
				echo"<a class='page-link text-warning bg-dark border-white' href='?pagina=".$Proximo."'>Próximo</a>";
			echo"</li>";
		echo"</ul>";
	echo"</nav>";
?>
    </body>
</html>