<?php

/*
    RegisterCaterer of the EAT! project site.
*/
include("includes/header.php");     // Include template headerfile
include("includes/navigation.php"); // Include navigation bar

?>
    <!-- Heading content section -->
    <header class="food-header2">
        <div class="container-fluid">
            <div class="container">
                <h1><i class="fa fa-cutlery"></i> Registrierung Kunde</h1>
            </div>
        </div>
    </header>
    <!-- End header -->

    <!-- Main content  -->
    <div id="main-content">
        <section>
            <div class="container">
                <form method="POST" action="application/registerCustomerForm.php">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Logindaten</h3>
                            <div class="well well-lg">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" name="email" placeholder="E-Mail" class="form-control" required>
                                    <label for="password">Passwort*</label>
                                    <input type="password" id="password" name="password" placeholder="Passwort" class="form-control" required>
                                    <label for="password2">Passwort wiederholen*</label>
                                    <input type="password" id="password2" name="password2" placeholder="Passwort" class="form-control" required>
                                    <label for="password2">Empfehlung von</label>
                                    <input type="email" name="recommendedBy" placeholder="E-Mail" class="form-control">
                                    <input type="submit" name="submit" value="Absenden" class="btn btn-lg btn-block btn-primary">
                                </div>
                            </div>
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
