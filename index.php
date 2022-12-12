<?php 
    require 'utils.php';
    require 'database.php';

    init_session();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Écouter votre radio</title>
        <link rel="icon" type="image/x-icon" href="favicon.png">
        <!--Init Leaflet-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="
        crossorigin="">
        <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="
        crossorigin=""></script>
        
        <link href="style.css" rel="stylesheet">
        <!-- Including Bootstrap CSS file -->
        <link href="bootstrap-5.2.3-dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        

        <!-- Div used for the transition to connexion page-->
        <div id="transition_div" class="container-fluid bg-primary"></div>

        <!--Banner Section-->
        <div id="welcome_banner_section" class="container-fluid text-center py-5 px-100 text-white bg-primary">
            <div id="welcome_banner" class="container">
                <h2 class="fw-bold">Bienvenue <?php if(is_logged()) { echo htmlspecialchars($_SESSION['username']." ".$_SESSION['firstname']);  } else { echo "sur \"Écouter votre Radio\"";} ?></h2>
                <p> Vous pouvez écouter, ajouter, et localiser toutes vos radios préférées, et tout ça au même endroit !</p>
                <?php
                    if(is_logged()) {
                        echo "<form method=\"post\" action=\"logout.php\"><button type=\"submit\" class=\"btn btn-dark\">Se déconnecter</button></form>    ";
                    } else {
                        echo "<button type=\"button\" id=\"open_login_form_btn\" class=\"btn btn-dark\">Se connecter</button>";
                    }     
                ?>
            </div>
        </div>

        <!--Core Section-->
        <div id="core_section" class="container overflow-hidden">
            <br>
            <div class="row gy-5">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="h4 fw-bold text-center">Écouter</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Choisissez votre radio favorite</p>
                            <form method="post" action="remove_radio.php">
                                <select name="radio_selection" class="form-select mb-2" id="html_select_box" aria-label="Default select example">
                                    <option disabled>Choose a radio</option> 
                                    <?php  
                                        require 'load_radio.php';
                                    ?>
                                </select>
                                <div class="container overflow-hidden">
                                    <div class="row gy-5">
                                        <div class="col-6">
                                            <audio id="radio_assets" preload="auto" autoplay="false" controls="controls" src="" unchecked></audio>
                                        </div>
                                        <div class="col-1"></div>
                                        <div class="col-5">
                                            <?php if(is_logged()) { echo "<button type=\"submit\" name=\"del_radio_btn\" class=\"btn btn-danger\" >Supprimer cette radio</button>";}?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="h4 fw-bold text-center">Ajouter</p>
                        </div>
                        <div class="card-body">
                            <form <?php if(is_logged()) { echo "method=\"post\" action=\"add_radio.php\""; }?> >
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-floating mb-3 text-secondary">
                                                <input name="radio_name" type="form-control" class="form-control" id="floatingInput" placeholder="" required>
                                                <label for="floatingInput">Nom de la radio</label>
                                            </div>
                                            <div class="form-floating mb-3 text-secondary">
                                                <input name="radio_url" type="form-control" class="form-control" id="floatingInput" placeholder="" required>
                                                <label for="floatingInput">URL du flux radio</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating mb-3 text-secondary">
                                                <input name="radio_long" type="form-control" class="form-control" id="floatingInput" placeholder="" required>
                                                <label for="floatingInput">Longitude</label>
                                            </div>
                                            <div class="form-floating mb-3 text-secondary">
                                                <input name="radio_lat" type="form-control" class="form-control" id="floatingInput" placeholder="" required>
                                                <label for="floatingInput">Latitude</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <?php
                                                    if(is_logged()) {
                                                        echo "<button type=\"submit\" name=\"add_radio_btn\" class=\"btn btn-primary\">Ajouter une radio</button>";
                                                    } else {
                                                        echo "<button type=\"button\" class=\"btn btn-primary\" disabled>Ajouter une radio</button>";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <p class="h4 fw-bold text-center">Localiser</p>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height:500px; width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <br>
        </div>

        <!-- footer -->
        <div id="footer" class="container-fluid bg-black p-1 text-center">
            <p class="text-info fw-bold text-muted">Par Maxime HAVGOUDOUKIAN - Polytech Informatique 2022</p>
        </div>

        <!-- Connexion form-->
        <div id="connexion_form" class="container-fluid bg-primary min-vh-100">
            <div class="container overflow-hidden py-5"></div>
            <div class="container overflow-hidden">
                <div class="row gy-5">
                    <div class="col-2"></div>
                    <div class="col-8 ">
                        <div class="card">
                            <div class="card-header">
                                <p class="h4 fw-bold text-center text-dark">Connexion à votre compte</p>
                            </div>
                            <div class="card-body">
                                <form method="post" action="login.php">
                                    <div class="container-fluid">
                                        <p class="text-center">Connectez-vous à votre compte et accéder à vos radios préférées</p>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="email" name="email_field" class="form-control" placeholder="" required>
                                                    <label for="floatingInput">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="password" name="pass_field" class="form-control" placeholder=" " required>
                                                    <label for="floatingInput">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button id="login_btn" name="login_btn" type="submit" class="btn btn-primary me-2">  Connexion</button>
                                                    <button id="login_abort_btn" type="button" class="btn btn-outline-dark">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-2"></div>
                    <div class="col-8 ">
                        <div class="card">
                            <div class="card-header">
                                <p class="h4 fw-bold text-center text-dark">Créer un nouveau compte</p>
                            </div>
                            <div class="card-body">
                                <form method="post" action="login.php">
                                    <div class="container-fluid">
                                        <p class="text-center">Vous n'avez pas encore de compte ? Inscrivez-vous et personnalisez votre propre liste de radios gratuitement</p>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="input" name="name_field" class="form-control" placeholder="" required>
                                                    <label for="floatingInput">Nom</label>
                                                </div>
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="input" name="surname_field" class="form-control" placeholder="" required>
                                                    <label for="floatingInput">Prénom</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="password" name="pass_field" class="form-control" placeholder=" " required>
                                                    <label for="floatingInput">Password</label>
                                                </div>
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="password" class="form-control" placeholder=" " required>
                                                    <label for="floatingInput">Confirm password</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3 text-secondary">
                                                    <input type="email" name="email_field" class="form-control" placeholder="" required>
                                                    <label for="floatingInput">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button id="create_account_btn" name="create_account_btn" type="submit" class="btn btn-primary me-2">S'inscrire</button>
                                                    <button id="create_account_abort_btn" type="button" class="btn btn-outline-dark">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>

        <!-- Including my personnal js script for radio -->
        <script src="radio.js" defer></script>
        <!-- Including Bootstrap javascript file -->
        <script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>