<?php

if(isset($_SESSION['currentUserId'])) {
    
    
    
    if(isset($_POST['submit'])) {
        
        
        $catererArr = $_SESSION['catererArr'];
        $filteredCaterer = $_SESSION['catererArr'];
        $name = $_POST['name'];
        $maxPerson = $_POST['maxPerson'];
        $preOrderTime = $_POST['preOrderTime'];
        $servicePersonal = $_POST['servicePersonal'];
        $kitchen = $_POST['kitchen'];
      
        if($name != null || $maxPerson != null || $preOrderTime != null || $servicePersonal != null || $kitchen != null){
            foreach ($catererArr as $caterer) {
                $help=true;
                
                if($name != null && $help == true){
                    if($caterer->name != $name){
                        $key = array_search($caterer,$filteredCaterer);
                            if($key!==false){
                                unset($filteredCaterer[$key]);
                                $help=false;
                            }
                    }
                }
                
                if($maxPerson != null && $help == true){
                    if($caterer->maxPerson < $maxPerson){
                       $key = array_search($caterer,$filteredCaterer);
                            if($key!==false){
                                unset($filteredCaterer[$key]);
                                $help=false;
                            }
                    }
                }
                
                if($preOrderTime != null && $help == true){
                    if($caterer->preOrderTime > $preOrderTime){
                       $key = array_search($caterer,$filteredCaterer);
                            if($key!==false){
                                unset($filteredCaterer[$key]);
                                $help=false;
                            }
                    }
                }
                
                if($servicePersonal != null && $help == true){
                    if($caterer->servicePersonal != 1){
                       $key = array_search($caterer,$filteredCaterer);
                            if($key!==false){
                                unset($filteredCaterer[$key]);
                                $help=false;
                            }
                    }
                }
                
                
                
                if($kitchen != null && $help == true){
                    $kitchenhelp =false; 
                    
                    foreach($kitchen as $food){
                        foreach($caterer->kitchen as $catererFood){
                           if($food == $catererFood){
                               $kitchenhelp=true;
                           }
                        }
                    }
                    
                    if(!$kitchenhelp){
                       $key = array_search($caterer,$filteredCaterer);
                            if($key!==false){
                                unset($filteredCaterer[$key]);
                                $help=false;
                            }
                    }
                }
                
             }
            
              
            
          if(count($filteredCaterer)){
             printCaterer($filteredCaterer); 
          }else{
             $_SESSION['message'] = "Keine Caterer zu Ihren Filteroptionen gefunden!";
             printCaterer($catererArr);
          }
            
           
            
        }else{
           $_SESSION['message'] = "Bitte mindesten eine Filteroption wählen";
            printCaterer($catererArr);
            
        }
    } else {
        
        $catererArr = array();
        $caterersId = array();

        $query = "SELECT * FROM caterer INNER JOIN catererskitchen ON caterer.catererId = catererskitchen.catererId INNER JOIN kitchen ON catererskitchen.kitchenId = kitchen.kitchenId";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            $_SESSION['message'] = "QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection);
            header('Location: ../index.php');
        } else {
            
        while($row = mysqli_fetch_assoc($result)) {
            if(in_array($row['catererId'], $caterersId)) {
                foreach($catererArr as $caterer) {
                    if($caterer->catererId == $row['catererId']) {
                        array_push($caterer->kitchen, $row['kitchenDescription']);
                    }
                }
            } else {
                array_push($caterersId, $row['catererId']);
                $tempCaterer = new Caterer();
                $tempCaterer->catererId = $row['catererId'];
                $tempCaterer->name = $row['name'];
                $tempCaterer->description = $row['description'];
                $tempCaterer->street = $row['street'];
                $tempCaterer->zip = $row['zip'];
                $tempCaterer->city = $row['city'];
                $tempCaterer->phone = $row['phone'];
                $tempCaterer->homepage = $row['homepage'];
                $tempCaterer->maxPerson = $row['maxPerson'];
                $tempCaterer->preOrderTime = $row['preOrderTime'];
                $tempCaterer->deliveryRadius = $row['deliveryRadius'];
                $tempCaterer->servicePersonal = $row['servicePersonal'];
                array_push($tempCaterer->kitchen, $row['kitchenDescription']);
                array_push($catererArr, $tempCaterer);
                $_SESSION['catererArr'] = $catererArr;
            }

        }


        printCaterer($catererArr);
        
        }
        
    }
    
}

function printCaterer($catererArr) {
    
   
    
    foreach($catererArr as $caterer) {
                echo 
                    "<div class='row'>
                        <div class='col-md-12'>
                            <div id='card" . $caterer->catererId . "' class='well well-lg'>
                                <div class='information' data-toggle='collapse' data-target='#collapse" . $caterer->catererId . "'>
                                    <h3>" . $caterer->name . "</h3>
                                    <p>" . $caterer->kitchenToString() . "</p>
                                </div>
                                <i class='fa fa-chevron-down'></i>
                                <div id='collapse" . $caterer->catererId . "' class='collapse' aria-expanded='false'>
                                    <h4>Beschreibung</h4>
                                    <p>" . $caterer->description ."</p>
                                    <h4>Adresse</h4>
                                    <p>" . $caterer->street . "<br>"
                                    . $caterer->zip . " " . $caterer->city . "<br>
                                    </p>
                                    <p>" . $caterer->phone . "</p>
                                    <p><a href='" . $caterer->homepage . "' target='_blank'>" . $caterer->homepage . "</a></p>
                                    <p>Maximal Personenanzahl: " . $caterer->maxPerson . "</p>
                                    <p>Lieferradius: " . $caterer->deliveryRadius . "</p>
                                    <p>Vorlaufzeit: " . $caterer->preOrderTime . "</p>
                                    <p>Servicepersonal: " . ($caterer->servicePersonal == 1 ? 'Ja' : 'Nein') . "</p>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
}

?>
