<?php
include('../../../cnf/db.php');
include('../../../dryden/db/driver.class.php');
include('../../../dryden/debug/logger.class.php');
include('../../../dryden/runtime/dataobject.class.php');
include('../../../dryden/sys/versions.class.php');
include('../../../dryden/ctrl/options.class.php');
include('../../../dryden/ctrl/auth.class.php');
include('../../../dryden/ctrl/users.class.php');
include('../../../dryden/fs/director.class.php');
include('../../../inc/dbc.inc.php');
if (isset($_GET['id'])) {
    $userid = $_GET['id'];
} else {
    $userid = NULL;
}
session_start();
if ($_SESSION['zpuid'] == $userid) {
	$currentuser = ctrl_users::GetUserDetail($userid);
	$path = ctrl_options::GetSystemOption('hosted_dir');
if(file_exists($path . $currentuser["username"] . "/elfilemanager_config.xml")) { 
		$xml=simplexml_load_file($path . $currentuser["username"] ."/elfilemanager_config.xml");
		$theme = $xml->theme;
		$lang = $xml->lang;
		}
		?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="css/elfinder.min.css">
        <?php if(file_exists($path . $currentuser["username"] . "/elfilemanager_config.xml")) { ?>
		<link rel="stylesheet" type="text/css" href="themes/<?php echo $theme; ?>/css/theme.css">
        <?php } ?>
        
		<!-- elFinder JS (REQUIRED) -->
		<script src="js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<?php if(file_exists($path . $currentuser["username"] . "/elfilemanager_config.xml")) { ?>
		<script src="js/i18n/elfinder.<?php echo $lang; ?>.js"></script>
		<?php } ?>
		

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			$(document).ready(function() {
				$('#elfinder').elfinder({
					url : 'php/connector.minimal.php',
					<?php if(file_exists($path . $currentuser["username"] . "/elfilemanager_config.xml")) { ?>
					lang : '<?php echo $lang; ?>',
					<?php } ?>
					customData : { path : "<?php echo $path.'/'.$currentuser["username"].'/'; ?>" }
				});
			});
		</script>
	</head>
	<body>
		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
<?php } else {
    ?>
    <body style="background: #F3F3F3;">
        <h2>Unauthorized Access!</h2>
    </body>
<?php } ?>
