<!DOCTYPE HTML>
<HTML>

<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INSCRIPTION</title>
</HEAD>

<BODY>
	<div class="container">
	<br>
    <h1>Inscription Organisateur</h1><br>
	<p>
    	</p>
            <form  class="box" action="inscription_organisateur_post.php" method="post">
				<p>
				<?php
					if (isset($_GET['champs']))
					{
						$champs = strip_tags($_GET['champs']);
						switch($champs)
						{
							case 'base':
								echo 'Ce pseudo est déjà pris!<br />';
								break;
							case 'pseudo':
								echo 'Le pseudo n\'est pas conforme!<br />'; 
								break;
							case 'mdp':
								echo 'Le mot de passe n\'est pas conforme!<br />';
								break;
							default;
								echo 'Vous avez mal rempli un champs!<br />';
								break;
						}
					}
				?>
                <input type="text" name="pseudo"  placeholder="Nom du lieu"/>
                <br>
                <input type="password" name="mdp" placeholder="Mot de passe" />
                <br>
               	<input type="password" name="mdp2" placeholder=" Ressaisir votre mot de passe" />
               	<br/>
				<input type="email" name="email" placeholder="Adresse e-mail"  />
				<br>
				<input type="text" name="adresse"  placeholder="Adresse du lieu"/>
                <br>
				<select    name="type" class="choix">
					<div class="menu">
					<option value="" disabled selected>Type de lieu ?</option>
					<option value="100">Boite de nuit</option>
					<option value="101">Bar</option>
					<option value="102">Cabaret</option>
					<div/>
				</select><br /><br>
				<input type="submit" name="" class="valid" />
				</p>
			</form>
	</div>
    
</BODY>

</HTML>