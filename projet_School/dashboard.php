<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="./css/dashboard.css">


    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Lien vers Bootstrap JavaScript et Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

        <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
    <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-2 d-flex flex-column justify-content-evenly">

                <img src="./image/FFXIV.jfif" alt="">
                <div>
                    <?php
                    echo 'Bonjour <br>' . $_SESSION['email'];
                    ?>
                </div>
                <hr>
                <a href="./dashboard.php">Accueil</a>
                <hr>
                <a href="./indexEleves.php">Liste des etudiants</a>
                <hr>
                <a href="./index.php">Liste des professeurs</a>
                <hr>
                <!-- Button trigger modal -->
                <a href="#" onclick="document.getElementById('deconnexion').style.display='block'"
                    data-bs-toggle="modal" data-bs-target="#deconnexion">
                    Deconnexion</a>
            </nav>


            <?php
            require('config.php');
            // Nombre d'eleves en cm1
            $sqlcount1 = "SELECT COUNT(*) FROM eleves LEFT JOIN personne 
                          on eleves.personne_ID = personne.ID WHERE personne.classe = 'CM1'";
            $count1 = $pdo->query($sqlcount1);
            $cm1 = $count1->fetchColumn();

            // 
            $sqlcount2 = "SELECT COUNT(*) FROM eleves LEFT JOIN personne 
                          on eleves.personne_ID = personne.ID WHERE personne.classe = 'CM2'";
            $count2 = $pdo->query($sqlcount2);
            $cm2 = $count2->fetchColumn();
            ?>
        </div>




        <div class="row">
            <div class="col-3"></div>
            <div class="col-9 d-flex my-5">
                <div class="count_CM d-flex mx-5">
                    <h6>Nombre d'eleves au CM1</h6>
                    <div class="count_eleves2">
                        <h3>
                            <?php
                            echo $cm1;
                            ?>
                        </h3>
                    </div>
                </div>
                <div class="count_CM d-flex mx-5">
                    <h6>Nombre d'eleves au CM2</h6>
                    <div class="count_eleves2">
                        <h3>
                            <?php
                            echo $cm2;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col py-3 px-5 mx-5 my-5">
                <h5>Calendrier d'evenements</h5>
            </div>
        </div>
        
        


        <div class="row">
            <div class="col-3"></div>
            <div class="col">
                <iframe src="https://calendar.google.com/calendar/embed?src=kevindune%40hotmail.fr&ctz=UTC"
                    style="border: 0" width="100%" height="500px" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>

    </div>




    <!-- Modal déconnexion-->
    <div class="modal fade" id="deconnexion" tabindex="-1" aria-labelledby="deconnexionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <h3>Etes-vous sûr de vouloir vous déconnecter ? </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NON</button>
                    <button type="button" class="btn btn-success" onclick="location.href='./logout.php'">OUI</button>
                </div>
            </div>
        </div>
    </div>


</body>






</html>