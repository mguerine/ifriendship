<html>
	<head>
		<title>IFriendship: Sistema de Recomendação de Amizades</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="images/as.png">
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<h1><a href="#">IFriendship <span>by Luis and Fran</span></a></h1>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.html">Home</a></li>
					<li><a href="index.html#2">Metodologia</a></li>
					<li><a href="generic.html">Formulário</a></li>
					
				</ul>
			</nav>

		<!-- Main -->
			<div id="main">

			<!-- One -->
				<section class="wrapper style1">
					<div class="inner">
						<header class="align-center">
							<h2>Respostas:</h2>
							<p>Cras sagittis turpis sit amet est tempus, sit amet consectetur purus tincidunt.</p>
						</header>
						
						<?php

						// Incluindo as bibliotecas do KMeans
						require_once "kmeans/src/KMeans/Space.php";
						require_once "kmeans/src/KMeans/Point.php";
						require_once "kmeans/src/KMeans/Cluster.php";
						ini_set('memory_limit', '20000M');

						// Acessando os dados do formulário preenchido
						$name_form = $_POST["name"];
						$email_form = $_POST["email"];
						$turma_form = $_POST["turma"];
						$resp1_form = floatval ($_POST["questao01"]);
						$resp2_form = $_POST["questao02"];
						$resp3_form = $_POST["questao03"];
						$resp4_form = $_POST["questao04"];
						$resp5_form = $_POST["questao05"];
						$resp6_form = $_POST["questao06"];
						$resp7_form = $_POST["questao07"];
						$resp8_form = $_POST["questao08"];
						$resp9_form = $_POST["questao09"];
						$resp10_form = $_POST["questao10"];
						$resp11_form = $_POST["questao11"];
						$resp12_form = $_POST["questao12"];
						$resp13_form = $_POST["questao13"];
						/*foreach( $_POST as $stuff ) {
						    if( is_array( $stuff ) ) {
							foreach( $stuff as $thing ) {
							    echo $thing;
							}
						    } else {
							echo $stuff;
						    }
						}*/
						
						// pegar os outros dados do formulário para inserir no arquivo texto dataset3.txt
						$new_data = $resp1_form. " " .$resp2_form. " " .$resp3_form. " " .$resp4_form. " " .$resp5_form. " " .$resp6_form. " " .$resp7_form. " " .$resp8_form. " " .$resp9_form. " " .$resp10_form. " " .$resp11_form. " " .$resp12_form. " " .$resp13_form. " '" .$name_form . "' " . $email_form . " ". $turma_form . "\n";
						
						// Inserindo novos dados na base de dados
						file_put_contents("kmeans/dataset3.txt",$new_data,FILE_APPEND);
						// Abrindo o arquivo com a base de dados
						$myfile = fopen("kmeans/dataset3.txt", "r") or die("Unable to open file dataset3.txt!" );
						// Lendo o arquivo da base de dados até o final e criando o modelo do KMeans
						$line = fgets($myfile) . "<br>";
						$comp = preg_split('/ +/', $line); 
						$nfiles = $comp[0];
						$nattr = $comp[1];
						$k = $comp[2];
						$iter_max = $comp[3];
						$has_name = $comp[4];
						$points = [];
						$data = [];

						while(!feof($myfile)) {
						  $line = fgets($myfile);
						
						if($line == ""){
							 break;
						}
						  $comp = preg_split('/\'/', $line); 
							
						  $nome = $comp[1];
						
						  $email_turma = preg_split('/ +/', $comp[2]);
						 
						  $email = $email_turma[1];
						  $turma = $email_turma[2];
						 
						  //echo $comp[0] . " ";
						  //echo $comp[1] . "<br>";
						  $comp = preg_split('/ +/', $comp[0]);
						  $points[] = [(float)$comp[0], (float)$comp[1], (float)$comp[2], (float)$comp[3], (float)$comp[4], (float)$comp[5], (float)$comp[6], (float)$comp[7], (float)$comp[8], (float)$comp[9], (float)$comp[10], (float)$comp[11], (float)$comp[12]];
						  $data[] = [$nome, $email, $turma];	
						}
						fclose($myfile);
						
						
						//echo "Initialize points...<br>";

						//for ($i=0; $i < $nfiles; $i++) {
						//	for ($j=0; $j < $nattr ; $j++){
						//		echo $points[$i][$j] . " ";	
						//	}
						//	echo "<br>";
						//}

						//echo "\nDone.";
						//echo "\nCreating Space...\n";


						// Criando o espaço N-dimensional do KMeans
						$space = new KMeans\Space($nattr);

						// Adicionando os pontos da base de dados para o KMeans
						foreach ($points as $i => $coordinates) {
							$space->addPoint($coordinates, null, $data[$i][0], $data[$i][1], $data[$i][2]);
							//printf("\r%.2f%%", ($i / $n) * 100);
						}
						foreach($space as $point){
							var_dump($space);	
							exit(1);
						}
						echo "Determining clusters";

						// Chamando o algoritmo KMeans para resolver a clusterização
						$clusters = $space->solve($k, KMeans\Space::SEED_DEFAULT, function () {
							echo ".";
						});

						echo "\n\n";

						// Mostrar os centroides dos clusters e os pontos  
						foreach ($clusters as $i => $cluster){
							foreach($cluster as $point){
								echo $point->getName();								
							}
							
							printf("<br>Cluster %s [%d,%d]: %d points\n", $i, $cluster[0], $cluster[1], count($cluster));
						}
						?>

				</section>

			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="flex flex-3">
						<div class="col">
							<h3>Vestibullum</h3>
							<ul class="alt">
								<li><a href="#">Nascetur nunc varius commodo.</a></li>
								<li><a href="#">Vis id faucibus montes tempor</a></li>
								<li><a href="#">Massa amet lobortis vel.</a></li>
								<li><a href="#">Nascetur nunc varius commodo.</a></li>
							</ul>
						</div>
						<div class="col">
							<h3>Lobortis</h3>
							<ul class="alt">
								<li><a href="#">Nascetur nunc varius commodo.</a></li>
								<li><a href="#">Vis id faucibus montes tempor</a></li>
								<li><a href="#">Massa amet lobortis vel.</a></li>
								<li><a href="#">Nascetur nunc varius commodo.</a></li>
							</ul>
						</div>
						<div class="col">
							<h3>Accumsan</h3>
							<ul class="alt">
								<li><a href="#">Nascetur nunc varius commodo.</a></li>
								<li><a href="#">Vis id faucibus montes tempor</a></li>
								<li><a href="#">Massa amet lobortis vel.</a></li>
								<li><a href="#">Nascetur nunc varius commodo.</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="copyright">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-snapchat"><span class="label">Snapchat</span></a></li>
					</ul>
					&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Coverr</a>. Video: <a href="https://coverr.co">Coverr</a>.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
