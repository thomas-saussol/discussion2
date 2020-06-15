<html >
<head>
 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="discussion.css" media="screen" type="text/css" />
</head>
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
    <body id="fondconnexion">

    <div id="zone connexion" >
        <!-- zone de connexion -->

        <form id="ar-form" action="connexion.php" method="POST">
            <h1 id="ar-h1-co">Connexion:...</h1>
<br/>
            <label class="ar-lab"><b>Login</b></label><br>
            <input class="ar-input-co" type="text" placeholder="Entrer le nom d'utilisateur" name="login" required><br>

            <label class="ar-lab"><b>...Password</b></label><br>
            <input class="ar-input-co" type="password" placeholder="Entrer le mot de passe" name="password" required><br><br>

            <br>
<br><input type="submit" id='submitconnexion' value="" >
            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1 || $err==2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
            ?>
        </form>
    </div>

<div id="validationconnection">

  <p>Rejoins nous!</p>

</div>
<div id="zeldaanimé">
  	<img class="photoindex0" src="zeldaconnexion.png" alt="">
  	<img class="photoindex0" src="zeldaconnexion2.png" alt="">
  	<img class="photoindex0" src="zeldaconnexion3.png" alt="">
    <img  id="photoindex5" src="logozeldatitre" alt="">

</div>

    <div id="content">



        <!-- tester si l'utilisateur est connecté -->
        <?php



  ?>

</div>
</body>
</html>

<?php
if (!isset($_SESSION['login']))
{
    $_SESSION['login'] = '';
}

if(isset($_POST['login']) && isset($_POST['password']))
{
    // connexion à la base de données
    $connexion = mysqli_connect ("localhost", "root", "", "discussion");


    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $login = $_POST['login'];
    $password = $_POST['password'];

    if($login !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateurs where
        login = '".$login."' ";
        $exec_requete = mysqli_query($connexion,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];

        $requete4 = "SELECT * FROM utilisateurs WHERE login='".$login."'";
        $exec_requete4 = mysqli_query($connexion,$requete4);
        $reponse4 = mysqli_fetch_array($exec_requete4);

        if( $count!=0 && $_SESSION['login'] == "" && password_verify($password, $reponse4[2]) )
        {

            $_SESSION['login'] = $login;
            $user = $_SESSION['login'];
            header('Location: connexion.php');
        }
        else
        {
           header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }

   }
}

        if(isset($_GET['deconnexion']))
 {

         echo "On vous deconnecte";
            session_unset();
        header('location:index.php');

 }

        if (isset($_SESSION['login']) && $_SESSION['login'] !== '')
{
         $user = $_SESSION['login'];
         echo "<p id=\"ar-bonjour\">Bonjour $user, vous êtes connecté</p>";
        header('location:index.php');

}



?>
