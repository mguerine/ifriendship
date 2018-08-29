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
							<h2>Sugestões de amizade:</h2>
						</header>
						<?php
						ini_set('memory_limit', '20000M');

						// accessing data from form
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
