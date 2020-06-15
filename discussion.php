<?php
session_start();
date_default_timezone_set('Europe/Paris');
$connexion = mysqli_connect("localhost","root","","discussion");
if (isset($_SESSION ['login'])){
  if (isset ($_POST ['commenter'])){
   $requete3="SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
   $query3 = mysqli_query( $connexion,$requete3);
    $resultat3= mysqli_fetch_all($query3);
    $requete2="INSERT INTO messages (message, id_utilisateur, date) VALUES ('".$_POST['message']."','".$resultat3[0][0]."','".date("Y-m-d H:i:s")."')";

         $query2 = mysqli_query( $connexion,$requete2);
         header('location: discussion.php');
  }

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="discussion.css">
  <link rel="stylesheet" href="index.css" media="screen" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
  <title>Page connexion</title>
</head>
<body id="discussion">
  <header>
  <?php
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
<h1>Discutez de vos jeux</h1>

<?php
if (isset($_SESSION['login'])==true){
?>
<div id="formdiscussion">
  <form action="discussion.php" method="post" align= "center">
    <div>
        <input id="validcomment" type="text" name="login">Votre login:</label></br>
        <br><label  id="validcomment" for="msg"> Poster votre message max 140 caractere :</label></br>
        <textarea id="validcomment"  maxlength="140" id="msg" name="message"></textarea>
        <input id="validcomment" type="submit" name="commenter">
    </div>
</form>
</div>

<?php
}
?>
<?php
}
else
  echo "Vous n' êtes pas connecté";
 ?>

      <table id="tableau">
                    <tr>
                      <th id="tablecomment">Nom:</th>
                      <th id="tablecomment">Commentaire:</th>
                      <th id="tablecomment">Date:</th>
                   </tr>
            <?php
                $connexion = mysqli_connect("localhost","root","","discussion");
                $requete4="SELECT login, message, date FROM utilisateurs LEFT JOIN messages ON utilisateurs.id = messages.id_utilisateur ORDER BY messages.id DESC";
                $query4=mysqli_query($connexion, $requete4);
                $data4 = mysqli_fetch_all($query4,MYSQLI_ASSOC);
                $taille = sizeof($data4);

                  $i = 0;
                    while($i < $taille)
                  {
                    $dateold= $data4[$i]['date'];
                    $datenew = date('d/m/Y à H:i:s', strtotime($dateold));
             ?>
                    <tr>
                     <td class= "comment"><b>Par:&nbsp;<?php echo $data4[$i]['login']?></b></td>
                      <td class="comment"><b><?php echo $data4[$i]['message']?></b></td>
                      <td class="comment"><b>Posté le:&nbsp;<?php echo $datenew?></b></td>
                    </tr>
            <?php
              $i++;
                  }
            ?>
      </table>


</body>
</html>
