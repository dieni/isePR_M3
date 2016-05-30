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
                <h1><i class="fa fa-cutlery"></i> Administration</h1>
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
		
			/*Join:
				caterer with catererskitchen over catererId
				and then with kitchen over kitchenId
			*/		
			//Count how often each kitchen is offered by caterers  
			$query = "SELECT kitchenDescription, catererId FROM kitchen INNER JOIN catererskitchen ON kitchen.kitchenId = catererskitchen.kitchenId";
			$result = mysqli_query($connection, $query);
			
			
			
			if(!$result){
				echo "Es sind keine Caterer registriert";
			} else {	
				
				$i = 0;
				$tableTemp = array();

				while ($row = mysqli_fetch_assoc($result)){
					$tableTemp[$i]['kitchenDescription'] = $row['kitchenDescription'];
					$tableTemp[$i]['catererId'] = $row['catererId'];
					$i++;
				}
				
				$table = array();
				foreach($tableTemp as &$tempRow){
					/* foreach($table as &$row){
						if(row['kitchenDescription'] == tempRow['kitchenDescription']){
							
						}						
					} */
					array_push($table, 'kitchenDescription' => tempRow['kitchenDescription'], 'quantityVendor' => 1);
					echo $tempRow['kitchenDescription']. " " .$tempRow['catererId']. "<br>";					
				}
				
				
			}
			
			
				
			
		?>
		
		
		
		
		
		
	</div>
	
	
<!--
Der Admin soll folgende Möglichkeiten besitzen:

STATISTIK:
- Abrufen wie viele User und Caterer die Platform nutzen.
- Welche Speisen wie oft angeboten werden (türkisch, italienisch, etc.).
- Was die durchschnittliche Bewertung der Caterer ergiebt (nur jene die auch wirklich bewertet wurden).
- Welche Zusatzpakete wie oft gekauft wurden.
- Was ist die durchschnittliche Bewertung der Caterer

FUNKTION:
- Caterer entfernen
- User entfernen



Files geändert:
	-navigation.php

-->

