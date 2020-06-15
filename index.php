<html>
<head>
	<link rel="stylesheet" type="text/css" href="discussion.css">
	<title>Acceuil</title>
</head>
<body id="bodyindex">
	<header>
	<?php
	session_start();
    if (isset($_SESSION['login']) && ($_SESSION['login'] == true))
    {
    include 'barnavco.php';
}
    else
    {
        include 'barnav.php';
    }

    ?>
	</header>

	<h1 id="titreindex">Bienvenue sur la Plateforme Gaming de l'école</h1>





	<div id=animationindex>
		<img class="photoindex0" src="persogaucheindex.png" alt="">
		<img  id="photoindex1" src="logoapparitionindex.png" alt="">
		<img class="photoindex2" src="persodroiteindex.png" alt="">

</div>







</body>
</html>
