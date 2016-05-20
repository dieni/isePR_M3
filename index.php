<?php

    /*
        Landingpage/Index of the EAT! project site.
    */

    include("includes/header.php");     // Include template headerfile
    include("includes/navigation.php"); // Include navigation bar

?>
    <!-- Heading content section -->
    <header class="food-header">
        <div class="container-fluid">
            <div class="container">
                <h1><i class="fa fa-cutlery"></i> Eat! - Eat All Time!</h1>
            </div>
        </div>
    </header>
    <!-- End header -->

    <!-- Main content  -->
    <div id="main-content">


        <?php
            if(isset($_SESSION['currentUserId'])) {
                
        ?>
            <section>
                <div class="container">
                    <h2></h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="tile">
                                <h3><i class="fa fa-search"></i> Suche starten</h3>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                                <a href="search.php">
                                    <button class="btn btn-block btn-primary"> <i class="fa fa-search"></i> Zur Suche...</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tile">
                                <h3><i class="fa fa-truck"></i></h3>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            } else {
                include("includes/login-form.php");
            }
        ?>


                <section id="customer">
                    <div class="container-fluid">
                        <div class="container">
                            <h2>Unsere Kunden</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tile animated">
                                        <h3><i class="fa fa-cutlery"></i></h3>
                                        <h3 class="tile-title">Besteller</h3>
                                        <p>Sie sind auf der Suche nach einem geeigneten Caterer? Kein Problem mit dem EAT! Caterer-Finder werden Sie in nu fündig.</p>
                                        <p><a href="registerCustomer.php" class="btn btn-primary btn-block">Registrieren</a></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tile animated tile-hot">
                                        <img src="img/icons/svg/ribbon.svg" alt="ribbon" class="tile-hot-ribbon">
                                        <h3><i class="fa fa-truck"></i></h3>
                                        <h3 class="tile-title">Caterer</h3>
                                        <p>Sie sind Caterer und wollen sich in unserem System registrieren? Genießen Sie jetzt die Vorteile.</p>
                                        <p><a href="registerCaterer.php" class="btn btn-primary btn-block">Registrieren</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Kreative Ideen.</h2>
                                <p>Casaesaert viasead setertya aseteciega nveritide nerafae kertyeritaesa ertyatya aplicaboserde miuas oditaut. onequuntures magni dolores eonemo eniptai volupta equi nesciunt ades. Nernatur aut qui ratione quisquam estneque porro.</p>
                                <p>
                                    <a href="#" class="btn btn-inverse btn-block"><i class="fa fa-lightbulb-o"></i> Mehr erfahren...</a>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h2>Professionelle Lösungen.</h2>
                                <p>Beciegast nveriti vitaesaert viasead setertya aset aplicaboserde miuas nerafae kertyeritaesa ertyatya nemo eniptaiades. Birnatur aut oditaut. Onequuntures magni dolores eo qui ratione volupta equi nesciunt neque porro quisquam est.</p>
                                <p>
                                    <a href="#" class="btn btn-inverse btn-block"><i class="fa fa-star"></i> Mehr erfahren...</a>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h2>Beste Ergebnisse.</h2>
                                <p>Maseas asitaesaert viasead setertya baesrta vaser aplicaboserde miuas nerafae kertyeritaesa certyadera nemo eniptaiernatur aut oditaut. onequuntures magne dolores eo qui ratione volupta equi nciunt vaesrta berty derasas jertyasera.</p>
                                <p>
                                    <a href="#" class="btn btn-inverse btn-block"><i class="fa fa-line-chart"></i> Mehr erfahren...</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
        include("includes/contact-form.php");   // Include contact form container
        include("includes/map.php");            // Include google maps container    
    ?>

    </div>
    <!-- End main content -->

    <?php
    include("includes/footer.php");         // Include template footerfile            
?>
