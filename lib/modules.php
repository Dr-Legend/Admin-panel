<?php 

	/*

	# @package BSC CMS

	

	# Copy right code 

	# The base configurations of the BSC CMS.

	# This file has the following configurations: MySQL settings, Table Prefix,

	# by visiting {config.inc.php} Codex page. You can get the MySQL settings from your web host.

	

	# MySQL settings - You can get this info from your web host

	# The name of the database for BSC CMS

	

	# Developer by kigal kishore kiroriwal

	# Company Name : Blue sapphire Creations

	# Website : www.bluesapphirecreations.com

	*/

	

	

echo $RW->sform((($mode or $_GET[stags])?'data-parsley-validate novalidate':''));	

 

switch ($comp)

{

	

	case $comp:

				if($comp)

				{

					if(is_dir(FS_ADMIN._MODS."/".$comp) === true)

					{

						     include(FS_ADMIN._MODS."/".$comp."/".(($mode)?$mode:'manage').".php");

					} else{

						     include(FS_ADMIN._MODS."/404.php");	

					}

				

				} else {

					

					include(FS_ADMIN._MODS."/dashboad.php");		

				}

				break;					

	default:

	         include(FS_ADMIN._MODS."/dashboad.php");

			 break;

} 

?>

<input type="hidden" name="action" id="action"/>

<?=$RW->eform();?>

