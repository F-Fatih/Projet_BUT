<?php
    require_once "view_begin.php";
?>
<style>
	<?php include_once "Content/css/style_acteur.css";?>
</style>
<body>
	<div class="containertt">
		<div class="left">
			<img src=<?php
						if ($personne['poster'] == null){
							echo "Content/img/NoImageAvailable.png";
						}else{
							echo $personne['poster'];
						}
						?> alt=<?=e($personne['primaryname']) ?>>
		</div>
		<div class="right">
			<h2><?=e($personne['primaryname']) ?></h2>
			<p>Date de naissance : <?=e($personne['birthyear'])?></p>
			<p>Profession : <?=e($personne['primaryprofession'])?></p>
			<p>Pas de description</p>
		</div>
	</div>
	
	<div class="carousel-container">
		<h2>Films</h2>
		<div class="carousel">
			<?php foreach($personne['titres'] as $titre):?>
			<div class="item">
				<img 
					src=<?php
						if ($titre['poster'] == null){
							echo "Content/img/NoImageAvailable.png";
						}else{
							echo $titre['poster'];
						}
						?>
						alt=<?=e($titre['primarytitle']);?>
				>
				<h3>
					<a href=<?php echo "?controller=recherche&action=affichage&search=".$titre['tconst'];?> style="color:white; text-decoration:none">
						<?=e($titre['primarytitle']);?>
					</a>
				</h3>
			</div>
			<?php endforeach; ?>
			</div>
		</div>
		
	</div>

	<script src="script.js"></script>
</body>

<?php
    require_once "view_end.php";
?>