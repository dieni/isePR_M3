<!--
    Navigation bar.
-->
<?php 
session_start();
?>
    <nav id="top-menu" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" id="navbar-header-responsive" class="navbar-brand"><i class="fa fa-cutlery"></i> EAT! - Eat All Time!</a>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                        if(isset($_SESSION['currentUserId'])) {
                            echo "<li><a href='search.php'><i class='fa fa-search'></i> Suche</a></li>";
                            echo "<li><a href='application/logout.php'><i class='fa fa-sign-out'></i> Logout</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php 
        if(isset($_SESSION['message'])) {
            echo "<div class='alert alert-info alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <strong>Information!</strong> " . $_SESSION['message'] . "</div>";
            $_SESSION['message'] = null;
        }
    ?>
