<?php
    session_start();
	$host = "localhost";
	$user_mysql = "root";
	$password_mysql = "";
	$database = "connexion";
	$bdd = mysqli_connect($host, $user_mysql, $password_mysql, $database);
	if(!$bdd)
    {
        echo "Echec de la connexion\n";
        exit();
    }
    mysqli_set_charset($bdd, "utf8");
?>
<!DOCTYPE HTML>
<HTML>

<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">  <!--mise à l'echelle de la page en fonction de la taille de la fenetre -->
	<title>Page de connexion</title>

</HEAD>

<BODY>
    <?php
		if (!isset($_POST['pseudo']) || empty(strip_tags($_POST['pseudo'])))
		{
			header('Location: connexion.php?champs=pseudo');
		}
		elseif (!isset($_POST['mdp']) || empty(strip_tags($_POST['mdp'])))
		{
			header('Location: connexion.php?champs=mdp');
		}
        else
        {
			$pseudo = mysqli_real_escape_string($bdd, strip_tags($_POST['pseudo']));
			$mdp = mysqli_real_escape_string($bdd, strip_tags($_POST['mdp']));
            $query = " SELECT id FROM membres WHERE pseudo= '".$pseudo."'AND mdp = '".crypt($mdp, 'hash')."'" ; //Il faudra plus tard un vrai hashage
            $req = mysqli_query($bdd, $query);
			if(mysqli_num_rows($req) == 1)
            {
                $_SESSION['log'] = $pseudo;	// Il faudra plus tard travailler avec des id's
				mysqli_free_result($req);
				mysqli_close($bdd);
                header('Location: index.php?status=connecte');
            }
            else
            {
                mysqli_free_result($req);
				mysqli_close($bdd);
				header('Location: connexion.php?champs=mdp');
            }
      
        }
	?>
    
</BODY>

</HTML>