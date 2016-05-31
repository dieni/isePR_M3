<?php

    /*
        Admin page
    */
	include("application/db.php");
    include("includes/header.php");     // Include template headerfile
    include("includes/navigation.php"); // Include navigation bar

?>

    <!-- Heading content section -->
    <header class="food-header">
        <div class="container-fluid">
            <div class="container">
                <h1><i class="fa fa-bar-chart"></i> Statistik</h1>
            </div>
        </div>
    </header>
	
	<div id="main-content">
        <h3>Anzahl der Registrierten Benutzer</h3>
		<?php	
			
			//registered caterers
			$query = "SELECT COUNT(*) AS count FROM user WHERE type = 'caterer'";
			$result = mysqli_query($connection, $query);
			
			if(!$result) {
				echo "Anzahl der Caterer: 0<br>";
			} else {
				$quantityCaterer = mysqli_fetch_assoc($result);
				echo "Anzahl der Caterer: " .$quantityCaterer['count']. "<br>";
			}
	
			//registered users
			$query = "SELECT COUNT(*) AS count FROM user WHERE type = 'user'";
			$result = mysqli_query($connection, $query);
			
			if(!$result) {
				echo "Anzahl der User: 0<br>";
			} else {
				$quantityCaterer = mysqli_fetch_assoc($result);
				echo "Anzahl der User: " .$quantityCaterer['count']. "<br>";
			}
		?>
		
		<h3>Durchschnittliche Personencapazität der Caterer</h3>
		<?php
			$query = "SELECT maxPerson FROM caterer";
			$result = mysqli_query($connection, $query);
			
			if(!$result){
				echo "Es sind keine Caterer registriert";
			} else {
				$averagePC = 0;
				$countQC = 0; //count how much caterer are registered
				while($row = mysqli_fetch_assoc($result)){
					$averagePC += $row['maxPerson'];
					$countQC++;
				}
				
				echo round($averagePC/$countQC,2);
			}
		?>
		
		<h3>Welche Speißen werden wie oft angeboten</h3>
		<?php
		
			$query = "SELECT kitchenDescription, catererId FROM kitchen INNER JOIN catererskitchen ON kitchen.kitchenId = catererskitchen.kitchenId";
			$result = mysqli_query($connection, $query);
			
			
			//Count how often each kitchen is offered by caterers 
			if(!$result){
				echo "Es sind keine Caterer registriert";
			} else {	
				
				//Fetch query in multidimensonal array
				$i = 0;
				$tableTemp = array();
				while ($row = mysqli_fetch_assoc($result)){
					$tableTemp[$i]['kitchenDescription'] = $row['kitchenDescription'];
					$tableTemp[$i]['catererId'] = $row['catererId'];
					$i++;
				}
				
				//do the count thing
				$i = 0;	
				$table = array();
				foreach($tableTemp as $tempRow){
					$inserted = false;

					//kitchenDescription already in table? if yes, count plus 1
					foreach($table as &$row){
						if($row['kitchenDescription'] == $tempRow['kitchenDescription']){
							$row['quantityCaterer'] += 1;
							$inserted = true;
						}
					}
					
					//If kitchenDescription was already in table, don't create a new entry
					if(!$inserted){
						$table[$i]['kitchenDescription'] = $tempRow['kitchenDescription'];
						$table[$i]['quantityCaterer'] = 1;
						$i++;
					}
				}
				
				//sort array
				usort($table, function($a, $b) {
					return $b['quantityCaterer'] - $a['quantityCaterer'];
				});
				
				//Display result
				$i = 0;
				$arrayLength = sizeof($table);
				while($i<$arrayLength){
					echo $table[$i]['kitchenDescription']. ": " .$table[$i]['quantityCaterer']. "<br>";
					$i++;
				}
				
			}
			
			
		?>
		
		<h3>Welche durchschnittliche Bewertung haben die Caterer</h3>
		
		<?php
		/* $query = "SELECT sterne FROM caterer INNER JOIN bewertungen";
			$result = mysqli_query($connection, $query);
			
			if(!$result){
				echo "Es sind keine Caterer registriert";
			} else {
				$averageRating = 0;
				$countRatings = 0; //count how much caterer are registered
				while($row = mysqli_fetch_assoc($result)){
					$averageRating += $row['sterne'];
					$countRatings++;
				}
				
				echo round($averageRating/$countRatings,2);
			} */
		?>
		
		
		<h3>Welche Zusatzpakete werden wie oft angeboten</h3>
		
		
	</div>
	
	
<!--
Der Admin soll folgende Möglichkeiten besitzen:

STATISTIK:
- Abrufen wie viele User und Caterer die Platform nutzen.
- Welche Speisen wie oft angeboten werden (türkisch, italienisch, etc.).
- Was die durchschnittliche Bewertung der Caterer ergiebt (nur jene die auch wirklich bewertet wurden).
- Welche Zusatzpakete wie oft gekauft wurden.

FUNKTION:
- Caterer entfernen
- User entfernen



Files geändert:
	-navigation.php

-->

