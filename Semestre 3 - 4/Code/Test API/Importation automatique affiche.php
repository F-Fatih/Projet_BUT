<style>

.boite{display:flex;background-color:gray; width:50%; margin-left:25%; border-radius:25px; color:white; padding:1%; font-size: 24px;}
.poster{text-align:start;flex 1;}
.info{margin-left:10px}

</style>

<?php
$dbconn = pg_connect('host=**** port=**** dbname=**** user=**** password=****')
    or die('Could not connect');
     

$requete = pg_query($dbconn, "Select * from films limit 10 ");

while ($row = pg_fetch_row($requete)) {
	$lien_films = "http://www.omdbapi.com/?i=$row[0]&apikey=ddab5d33";
	$json = file_get_contents($lien_films);
	$lecture = json_decode($json, TRUE);

  	echo "<div class='boite'>";
	
	echo "<div class='poster'><img src=", $lecture["Poster"], " height=200px></div>";
	echo "<div class='info'><p>", $row[1], "</p></div>";

	echo "</div>";
  	echo "<br />\n";
}


?>



















<?php
pg_close($dbconn);
?>
