<!DOCTYPE html>
<html lang="it">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="../css/print.css" type="text/css" rel="stylesheet" media="print" />
    <script src="../js/Script.js"></script>
    <title lang="en">Home Festival</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<a id="top"></a>
	<header><?php require('../layout/header.html')?></header>
    <nav><?php require('../layout/nav.php')?></nav>

    <div class="content col-m-11 col-d-11 col-l-11"> 
        <div>
        <h2><?php 
		$search=trim($_GET['search']);
		if(!$search) header('Location: home.php');
		else{
			
			echo "Artisti e articoli trovati per la seguente ricerca: " . $search;
			?> </h2></div>
            <?php
            $query = "SELECT * FROM artisti WHERE nome LIKE '%" . $search . "%'";
			$result = $conn->query($query);
			$path= "../images/GroupsPic/";
			$artistaNonTrovato= false;
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<div class='articoli col-m-10 col-d-10 col-l-10'>";
					echo "<h1 class='col-m-11 col-d-11 col-l-11'><a lang='en' tabindex='1'  href='artista.php?codArtista=" . $row['codArtista']."'><img class='artisti' alt='Immagine " . $row['nome'] ."' src='" . $path.$row['immagine'] . "'/></a></h1>";
					echo "<h1><a  href='artista.php?codArtista=" . $row['codArtista']."'>" . $row['nome'] . "</a></h1>";
					echo "<p><a href='article.php?codArt=" . $row['descrizione'] . "'>" . substr($row['descrizione'],0,300) . "...</a></p>";
					echo "</div>";
				}
			}
			else $artistaNonTrovato= true;
			$query = "SELECT codArt, titolo,testo FROM articoli WHERE (titolo LIKE '%" . $search . "%') OR (testo LIKE '%" . $search . "%') ORDER BY DataOra LIMIT 10";
			$result = $conn->query($query);
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<div class='articoli col-m-10 col-d-10 col-l-10' >";
					echo "<h1 class='col-m-11 col-d-11 col-l-11'><a  href='article.php?codArt=" . $row['codArt']."'>" . $row['titolo'] . "</a></h1>";
					echo "<p class='col-m-11 col-d-11 col-l-11'><a href='article.php?codArt=" . $row['codArt'] . "'>" . substr($row['testo'],0,300) . "...</a></p>";
					echo "</div>";
				}
			}
			else{
				if($artistaNonTrovato) echo "Nessun Risultato per: " . $search;
			}
		}
        ?>
        
	
	</div>
		
	<div class="top">
        <noscript>
		  <a  href="#top"><img  src="../images/buttonup.png" alt="Torna Su"/></a>
        </noscript>
        <img src="../images/buttonup.png" onClick=topFunction() id="goTop"/>  
	</div>
	<footer class="footer"><?php require('../layout/footer.php')?></footer>
      
</body>


</html> 
