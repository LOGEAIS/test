<?php
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
	<title>Page d'inscription</title>
	
</HEAD>

<BODY>
    <h1>Inscription</h1>
    <?php
		if (!isset($_POST['pseudo']) || empty($_POST['pseudo']) || strlen($_POST['pseudo'])>15)
		{
			header('Location: inscription_organisateur.php?champs=pseudo');
		}
		elseif (!isset($_POST['mdp']) || empty($_POST['mdp']) || !isset($_POST['mdp2']) || empty(strip_tags($_POST['mdp2'])) || strlen(strip_tags($_POST['mdp']))<6  || strip_tags($_POST['mdp']) != strip_tags($_POST['mdp2']))
		{
			header('Location: inscription_organisateur.php?champs=mdp');
		}
        elseif (isset($_POST['email']) &&  !empty($_POST['email']) && filter_var(strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL))
        {
        	$_POST['profil'] = '11'; //c'est un organisateur
        	$_POST['sexe'] = '';
			$req1 = $bdd->prepare('SELECT COUNT(pseudo) AS ici FROM membres WHERE pseudo= ?');
			$req1->execute(array(strip_tags($_POST['pseudo'])));
			$donnees = $req1->fetch();
			$req1->closeCursor();
			if($donnees['ici'])
			{
				header('Location: inscription_organisateur.php?champs=base');
			}
            $req = $bdd->prepare('INSERT INTO membres(pseudo, adresse, mdp, email, type, profil, sexe)
								 VALUES (:pseudo, :adresse, :mdp, :email, :type, :profil, :sexe)');
			//$hash = ;
            $req->execute(array(
			'pseudo' => strip_tags($_POST['pseudo']),
			'mdp'=> crypt(strip_tags($_POST['mdp']), 'hash'),	// Il faudrait un hash pour chaque mot de passe mais je n'ai pas eu le temps d'implémenter cela...
			//'hash' => ,
			'email'=> strip_tags($_POST['email']),
			'type'=> intval(strip_tags($_POST['type'])),
			'profil'=> intval(strip_tags($_POST['profil'])),
			'sexe'=> intval(strip_tags($_POST['sexe'])),
			'adresse' => strip_tags($_POST['adresse']),
			));
			
			header('Location: index.php?status=connecte'); //page d'accueil du site
        }
        else
        {
           header('Location: inscription_organisateur.php?champs=error');
        }
            
    ?>
    
</BODY>

</HTML>