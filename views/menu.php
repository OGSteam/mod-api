<?php
if (!defined('IN_SPYOGAME'))
    die("Hacking attempt"); // Pas d'accès direct
?>

	<nav>
		<ul>
			<li class="<?php echo $menu_active_index;?>"> <a href="index.php?action=api&subaction=index">Accueil</a></li>
			<li class="<?php echo $menu_active_token;?>"> <a href="index.php?action=api&subaction=token">Token</a></li>
			<li class="<?php echo $menu_active_reglage;?>"><a href="index.php?action=api&subaction=reglage">Réglages</a></li>
			<li class="<?php echo $menu_active_definition;?>"> <a href="index.php?action=api&subaction=definition">Definitions</a></li>
		</ul>
	</nav>