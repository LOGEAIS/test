<?php
//test
	session_start();
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=connexion;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}
?>
<!DOCTYPE HTML>
<HTML>

<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">  <!--mise à l'echelle de la page en fonction de la taille de la fenetre -->
	<title>Connexion à votre compte</title>

	
</HEAD>

<BODY>
	<div class="container">
		<h1>Connexion</h1>
		<?php
		if (isset($_GET['champs']) && strip_tags($_GET['champs']) =='pseudo')
        {
			echo '<h2>Saisissez un pseudo...<br /></h2>'; 
        }
		elseif (isset($_GET['champs']) && strip_tags($_GET['champs']) =='mdp')
        {
            echo '<h2>Pseudo ou mot de passe incorrect!<br /></h2>'; 
        }
		?>
		<form action="connexion_post.php" method="post">
				<p>
                <label for="pseudo"></label>  <input type="text" name="pseudo" placeholder="Pseudo" id="pwd"  autocomplete="off"/><br />
                <label for="mdp"></label> <input type="password" name="mdp"  placeholder="Mot de passe" id="pwd" autocomplete="off"/><br />
				<input type="submit" name="Valider" class="skrt" />
				</p>
		</form>
	</div>

    
</BODY>

</HTML>