<?php

/*
    RegisterCaterer of the EAT! project site.
*/
include("application/db.php");
include("application/caterer.php");
include("includes/header.php");     // Include template headerfile
include("includes/navigation.php"); // Include navigation bar


if(!isset($_SESSION['currentUserId'])) {
    $_SESSION['message'] = "Die Suche ist nur angemeldeten Benutzern gestattet!";
    header('Location: index.php');
} else {
    $query = "SELECT * FROM kitchen";
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("QUERY FAILED ". mysqli_error($connection) . ' ' . mysqli_errno($connection));
    }
}

if(isset($_POST['filter'])) {
        $_SESSION['filtered'] = null; 
    }

if(isset($_POST['submit'])) {
       if($_POST['name'] != null || $_POST['maxPerson'] != null || $_POST['preOrderTime'] != null || $_POST['servicePersonal'] != null || $_POST['kitchen'] != null){
        $_SESSION['filtered'] = "JA"; 
       }else{
         $_SESSION['filtered'] = null;   
       }
    
    }



?>
    <!-- Heading content section -->
    <header class="food-header">
        <div class="container-fluid">
            <div class="container">
                <h1><i class="fa fa-search"></i> Suche</h1>
            </div>
        </div>
    </header>
    <!-- End header -->

    <!-- Main content  -->
    <div id="main-content">
        <section id="search">
            <div class="container-fluid">
                <div class="container">
                    <div class="filterbar">
                        <form method="POST" action="search.php">
                            <ul class="filter-list">
                                <li>
                                    <i class="fa fa-search"></i>
                                </li>
                                <li>
                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                </li>
                                <li>
                                    <i class="fa fa-users"></i>
                                </li>
                                <li>
                                    <input type="number" min="1" max="1000" name="maxPerson" placeholder="Personenanzahl" class="form-control">
                                </li>
                                <li>
                                    <i class="fa fa-history"></i>
                                </li>
                                <li>
                                    <input type="number" min="1" max="365" name="preOrderTime" placeholder="Tage bis zum Event" class="form-control">
                                </li>
                                <li>
                                    <input type="checkbox" name="servicePersonal" data-toggle="toggle" data-on="mit Personal" data-off="ohne Personal">

                                </li>
                                <li>
                                    <a class="btn btn-default" data-toggle='collapse' data-target='#filter-collapse' aria-expanded='false'>Küche <i class="fa fa-chevron-down"></i></a>
                                </li>
                                <?php
                                  if(isset($_SESSION['filtered'])){
                                      echo "<li><input type='submit' name='submit' value='Update Filter' class='btn btn-primary'></li>";
                                      echo "<li><input type='submit' name='filter' value='Alle anzeigen' class='btn btn-danger'></li>";
                                  }else{
                                      echo "<li><input type='submit' name='submit' value='Filter anwenden' class='btn btn-primary'></li>";
                                  }
                             ?>

                            </ul>

                            <div id='filter-collapse' class='collapse' aria-expanded='true'>
                                <div class="row">
                                    <?php
                                $counter = 0;
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($counter == 0 || $counter == 8) {
                                        echo "<div class='col-md-6'>";
                                    }
                                    echo "<div class='checkbox'><label><input type='checkbox' name='kitchen[]' value='" . $row['kitchenDescription'] . "'> " . $row['kitchenDescription'] . "</label></div>";
                                    if($counter == 7 || $counter == 16) {
                                        echo "</div>";
                                    }
                                    $counter++;
                                }
                            ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php
                    include("application/displayCaterer.php");
                ?>
            </div>

        </section>
    </div>
    <!-- End main content -->

    <?php
        include("includes/footer.php");         // Include template footerfile            
    ?>
