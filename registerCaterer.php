<?php

    /*
        RegisterCaterer of the EAT! project site.
    */
    include("application/db.php");
    include("includes/header.php");     // Include template headerfile
    include("includes/navigation.php"); // Include navigation bar

    $query = "SELECT * FROM kitchen";
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("QUERY FAILED ". mysqli_error($connection) . ' ' . mysqli_errno($connection));
    }

?>
    <!-- Heading content section -->
    <header class="food-header2">
        <div class="container-fluid">
            <div class="container">
                <h1><i class="fa fa-cutlery"></i> Registrierung Caterer</h1>
            </div>
        </div>
    </header>
    <!-- End header -->

    <!-- Main content  -->
    <div id="main-content">

        <section>
            <div class="container">

                <form method="POST" action="application/registerCatererForm.php">
                    <h3>Logindaten</h3>
                    <div class="row well well-lg">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" name="email" placeholder="E-Mail" class="form-control" required>
                                <label for="password">Passwort*</label>
                                <input type="password" id="password" name="password" placeholder="Passwort" class="form-control" required>
                                <label for="password2">Passwort wiederholen*</label>
                                <input type="password" id="password2" name="password2" placeholder="Passwort" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row  well well-lg">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Firmenname*</label>
                                <input type="text" name="name" placeholder="Firmenname" class="form-control" required>
                                <label for="description">Beschreibung</label>
                                <textarea class="form-control" name="description" placeholder="Beschreibung" style="min-height: 143px"></textarea>
                                <label for="street">Straße*</label>
                                <input type="text" name="street" placeholder="Straße" class="form-control" required>
                                <label for="zip">Postleitzahl*</label>
                                <input type="text" name="zip" placeholder="Postleitzahl" class="form-control" required>
                                <label for="city">Stadt*</label>
                                <input type="text" name="city" placeholder="Stadt" class="form-control" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Telefonnummer*</label>
                                <input type="text" name="phone" placeholder="Telefonnummer" class="form-control" required>
                                <label for="homepage">Homepage*</label>
                                <input type="text" name="homepage" placeholder="Homepage" class="form-control" required>
                                <label for="password">Maximale Anzahl an Personen*</label>
                                <input type="number" name="maxPerson" placeholder="Maximale Anzahl an Personen" class="form-control" required>
                                <label for="password">Vorlaufzeit*</label>
                                <input type="number" name="preOrderTime" placeholder="Vorlaufzeit in Tagen" class="form-control" min="1" max="365" required>
                                <label for="deliveryRadius">Lieferradius in km*</label>
                                <input type="number" name="deliveryRadius" placeholder="Lieferradius in km" class="form-control" min="1" max="250" required>
                                <label for="servicePersonal">ServicePersonal*</label>
                                <select type="text" name="servicePersonal" class="form-control" required>
                                    <option value="1">Ja</option>
                                    <option value="0">Nein</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h3>Küche</h3>
                    <div class="row well well-lg">
                        <?php
                            $counter = 0;
                            while($row = mysqli_fetch_assoc($result)) {
                                if($counter == 0 || $counter == 8) {
                                    echo "<div class='col-md-6'>";
                                }
                                echo "<div class='checkbox'><label><input type='checkbox' name='kitchen[]' value='" . $row['kitchenId'] . "'> " . $row['kitchenDescription'] . "</label></div>";
                                if($counter == 7 || $counter == 16) {
                                    echo "</div>";
                                }
                                $counter++;
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Absenden" class="btn btn-lg btn-block btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
    <!-- End main content -->

    <script>
        var password = document.getElementById("password");
        var password2 = document.getElementById("password2");

        function validatePassword() {
            if (password.value != password2.value) {
                password2.setCustomValidity("Passwörter stimmen nicht überein!");
            } else {
                password2.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        password2.onkeyup = validatePassword;

    </script>

    <?php
    include("includes/footer.php");         // Include template footerfile            
?>
