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
				<h1><a href="index.html">IFriendship <span>by Luis, Fran and Lucas</span></a></h1>
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
							<h2>Sugestões de amizade:</h2>
						</header>
						<?php
						ini_set('memory_limit', '20000M');

						// accessing data from form
						$name_form = $_POST["name"];
						$email_form = $_POST["email"];
						$turma_form = $_POST["turma"];
						$resp1_form = floatval ($_POST["questao01"]);
						$resp2_form = floatval ($_POST["questao02"]);
						$resp3_form = floatval ($_POST["questao03"]);
						$resp4_form = floatval ($_POST["questao04"]);
						$resp5_form = floatval ($_POST["questao05"]);
						$resp6_form = floatval ($_POST["questao06"]);
						$resp7_form = floatval ($_POST["questao07"]);
						$resp8_form = floatval ($_POST["questao08"]);
						$resp9_form = floatval ($_POST["questao09"]);
						$resp10_form = floatval ($_POST["questao10"]);
						$resp11_form = floatval ($_POST["questao11"]);
						$resp12_form = floatval ($_POST["questao12"]);
						$resp13_form = floatval ($_POST["questao13"]);
						/*foreach( $_POST as $stuff ) {
						    if( is_array( $stuff ) ) {
							foreach( $stuff as $thing ) {
							    echo $thing;
							}
						    } else {
							echo $stuff;
						    }
						}*/
						$resp1_form = ($resp1_form - 1)/(11);
						$resp2_form = ($resp2_form - 1)/(6);
						$resp3_form = ($resp3_form - 1)/(7);
						$resp4_form = ($resp4_form - 1)/(6);
						$resp5_form = ($resp5_form - 1)/(4);
						$resp6_form = ($resp6_form - 1)/(5);
						$resp7_form = ($resp7_form - 1)/(5);
						$resp8_form = ($resp8_form - 1)/(6);
						$resp9_form = ($resp9_form - 1)/(4);
						$resp10_form = ($resp10_form - 1)/(10);
						$resp11_form = ($resp11_form - 1)/(5);
						$resp12_form = ($resp12_form - 1)/(5);
						$resp13_form = ($resp13_form - 1)/(8);
						// retrieving data from POST to insert into database
						$new_data = $resp1_form. " ; " .$resp2_form. " ; " .$resp3_form. " ; " .$resp4_form. " ; " .$resp5_form. " ; " .$resp6_form. " ; " .$resp7_form. " ; " .$resp8_form. " ; " .$resp9_form. " ; " .$resp10_form. " ; " .$resp11_form. " ; " .$resp12_form. " ; " .$resp13_form. " ; " .$name_form . " ; " . $email_form . " ; ". $turma_form . "\n";
						
						// inserting new data to database
						file_put_contents("dataset.txt",$new_data,FILE_APPEND);

						// calling python script
						$command = "python kmeans.py 2>&1";
						$output = shell_exec($command);

						echo $output;
						?>

				</section>

			</div>

	
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
