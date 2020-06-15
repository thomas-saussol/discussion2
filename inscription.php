<?php
session_start();
$connexion = mysqli_connect("localhost","root","","discussion");
if (isset($_POST['connexion']))
{
	$mdp3= password_hash($_POST["mdp"], PASSWORD_DEFAULT, array('cost' => 12));
	if ($_POST['mdp']==$_POST['mdp2'])
	{
		$requet="SELECT * FROM utilisateurs";
		$query2=mysqli_query($connexion,$requet);
		$resultat=mysqli_fetch_all($query2);
		$trouve=false;
		foreach ($resultat as $key => $value) {
			if ($resultat[$key][1]==$_POST['login'])
			{
				echo "Login deja existant!!";
				$trouve=true;
			}
		}
		if ($trouve==false)
		{
			$sql = "INSERT INTO utilisateurs (login,password)
			VALUES ('".$_POST['login']."','".$mdp3."')";
			$query=mysqli_query($connexion,$sql);
			header('Location:connexion.php');
		}
	}
	else{
		echo "Les mots de passe doivent etre identique!";
	}
}
$connexion->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="discussion.css">
	<link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">

	<title>Page d'inscription</title>
</head>

<body id="fondinscription">
<header>

	<?php
	include 'barnav.php';
	?>
</header>

	<h1 id="ar_h1">Inscrivez-vous</h1>

</div>

	<div class="form" align="center">
		<form id="tableauinscrip" method="POST" action="inscription.php">
			<table align="center">
				<tr>
					<td align="right"><label>Login;</label>
						<input type="text" name="login" placeholder="Entrez votre Login"></td><br/>
					</tr>

						<tr>
							<td align="right"><label>Mot de passe:</label>
								<input type="password" name="mdp" placeholder="Entrez votre mot de passe"></td><br/>
							</tr>
							<tr>
								<td align="right"><label>Confirmez Mot de passe:</label>
									<input type="password" name="mdp2" placeholder="Confirmez votre mot de passe"></td><br/>
								</tr>
								<tr>
									<td align="center"><br>
									<div class='align'>	<input type="submit" value="Je m'inscris" name="connexion"></td><br/></div>
									</tr>
								</table>
							</form>
						</div>



					</body>
					</html>
