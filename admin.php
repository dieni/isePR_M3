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
		
	<div class="container">	
		
	<div class="row demo-row">
        <div class="col-xs-12">
          <nav id= "statistic-nav" class="navbar navbar-inverse navbar-embossed" role="navigation">
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="#fakelink">User<span class="navbar-unread">1</span></a></li>
				<li><a href="#fakelink">Personenkapazität<span class="navbar-unread">1</span></a></li>
				<li><a href="#fakelink">Küchen<span class="navbar-unread">1</span></a></li>
				<li><a href="#fakelink">Bewertung<span class="navbar-unread">1</span></a></li>
				<li><a href="#fakelink">Zusatzpakete<span class="navbar-unread">1</span></a></li>
               </ul>
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
        </div>
      </div> <!-- /row -->
	</div>
		<section>
		
			<div class="container">
			<h3>Registrierte Benutzer</h3>
				<div class="well well-lg"
				
					<h3></h3> <!-- wtf?! -->
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
				</div>
			</div>
		</section>
		
		<section>
			<div class="container">
				<h3>Personenkapazität der Caterer</h3>
				<div class="well well-lg">
					
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
							
							echo "Durchschnittlich haben Caterer eine Kapazität von <b>" .round($averagePC/$countQC,2). " Personen</b>.";
						}
					?>
				</div>
			</div>
		</section>
		
		<section>
			<div class="container">
				<h3>Küchen</h3>
				<div class="well well-lg">
					
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
							
							echo "Folgende Liste zeigt an, welche Küchen von den Caterern wie oft angeboten werden: <br><br>";
							$i = 0;
							$arrayLength = sizeof($table);
							while($i<$arrayLength){
								echo $table[$i]['kitchenDescription']. ": " .$table[$i]['quantityCaterer']. "<br>";
								$i++;
							}
							
						}
						
						
					?>
				</div>
			</div>
		</section>
		
		<section>
			<div class="container">
				<h3>Bewertung der Caterer</h3>
				<div class="well well-lg">
					<?php
						$query = "SELECT rating FROM bewertung";
						$result = mysqli_query($connection, $query);
						
						if(!$result){
							echo "Es sind keine Caterer registriert";
						} else {
							$averageRating = 0;
							$countRatings = 0; //count how much caterer are registered
							while($row = mysqli_fetch_assoc($result)){
								$averageRating += $row['rating'];
								$countRatings++;
							}
							
							echo "Durchschnittlich wurden alle Caterer zusammen mit <b>" .round($averageRating/$countRatings,2). " Sterne</b> bewertet.";
						}
					?>
				<div>
			</div>
		</section>
		
		
		
		
		<section>
			<div class="container">
				<h3>Welche Zusatzpakete werden wie oft angeboten</h3>
				<div class="well well-lg">
					<?php
						$query = "SELECT name, catererId FROM package INNER JOIN catererpackage ON package.packageId = catererpackage.packageId";
						$result = mysqli_query($connection, $query);
						
						if(!$result){
							echo "Es sind entweder keine Caterer vorhanden oder es wurden keine Zusatzpakete gekauft.";
						} else {
							
							//Fetch query in multidimensonal array
							$i = 0;
							$tableTemp = array();
							while ($row = mysqli_fetch_assoc($result)){
								$tableTemp[$i]['name'] = $row['name'];
								$tableTemp[$i]['catererId'] = $row['catererId'];
								$i++;
							}
							
							//do the count thing
							$i = 0;	
							$table = array();
							foreach($tableTemp as $tempRow){
								$inserted = false;

								//name already in table? if yes, count plus 1
								foreach($table as &$row){
									if($row['name'] == $tempRow['name']){
										$row['quantityCaterer'] += 1;
										$inserted = true;
									}
								}
								
								//If name was already in table, don't create a new entry
								if(!$inserted){
									$table[$i]['name'] = $tempRow['name'];
									$table[$i]['quantityCaterer'] = 1;
									$i++;
								}
								
								//sort array
								usort($table, function($a, $b) {
									return $b['quantityCaterer'] - $a['quantityCaterer'];
								});
								
								echo "Folgende Liste zeigt an, welche Zusatzpakete von den Caterern wie oft angeboten werden: <br><br>";
								$i = 0;
								$arrayLength = sizeof($table);
								while($i<$arrayLength){
									echo $table[$i]['name']. ": " .$table[$i]['quantityCaterer']. "<br>";
									$i++;
								}
								
							}
						}
					?>
				<div>
			</div>
		</section>
		
		
		
		
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

