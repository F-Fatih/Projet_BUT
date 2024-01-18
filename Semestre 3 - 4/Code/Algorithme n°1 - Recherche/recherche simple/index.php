<html>
	<head>
		<title>Test Barre de recherche PDO</title>
		<meta charset="utf-8"/>
	</head>
	<body>
	</body>
<?php
require_once "FilmModel.php";
try {
	$db = new PDO("pgsql:host=ip.fidanhome.ovh;dbname=SAE", "DraCorporation", "PJFWf3EMjlNZ314C2sRg");
}
catch(PDOException $e){
	echo $e->getMessage();
}
$recherche = new FilmModel($db);
$result = $recherche->search("Avengers");
echo var_dump($result);

?>
</html>
