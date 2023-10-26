<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

    <!-- Lien css -->
    <link rel="stylesheet" href="./css/liste_etudiants.css">



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

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Navbar verticale -->
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




            <!-- Titre -->
            <h2>Liste des etudiants</h2>


            <!-- Barre de recherche et bouton Ajouter -->
            <div class="row my-5">
                <div class="col-4"></div>
                <div class="col-5 d-flex justify-content-center">
                    <input type="search" id="site-search" 
                    name="q" onkeyup="search_site()" placeholder="Tape un prenom">
                    <button onclick='reset()'>Refresh</button>
                </div>

                <div class="col">
                    <button type="button" class="btn btn-primary" 
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ajouter
                    </button>
                </div>
            </div>



            <!-- Modal d'ajout-->
            <div class="modal fade" id="exampleModal" tabindex="-1" 
                aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <img src="./image/back.png" alt="">
                            </div>
                            <div class="px-3">
                                <h3>Ajouter un(e) élève</h3>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php
                            echo $_SERVER['PHP_SELF'];
                            ?>
                                            ">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="uploadfile"
                                        value="">
                                </div>
                                <div class="row mb-3">
                                    <label for="Nom" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Nom" name='Nom' required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Prénom" class="col-sm-2 col-form-label">Prénom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Prenom" name='Prenom' required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Téléphone" class="col-sm-2 col-form-label">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Tel" name='Tel' required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Adresse" class="col-sm-2 col-form-label">Adresse</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Adresse" name='Adresse' required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="Email" name='Email' required>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="col-sm-2 col-form-label">Classe</label>
                                    <select class="form-select my-2" aria-label="Default select example" name='classe'
                                        required>
                                        <option selected disabled>Choisir la classe</option>
                                        <option name='CM1' value="CM1">CM1</option>
                                        <option name='CM2' value="CM2">CM2</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <?php
        require('config.php');

        error_reporting(0);

        $msg = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Nom = $_POST['Nom'];
            $Prenom = $_POST['Prenom'];
            $Tel = $_POST['Tel'];
            $Adresse = $_POST['Adresse'];
            $Email = $_POST['Email'];
            $classe = $_POST['classe'];
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "./image/" . $filename;

            // Verification de la présence dans la DB avec l'email
            $sql_verif = "SELECT COUNT(*) from personne WHERE email = '$Email'";
            $verif = $pdo->prepare($sql_verif);
            $verif->execute();

            // Insertion dans DB
            if ($verif->fetchColumn() == 0) {
                if ($classe != 'Choisir la classe') {
                    $sql = " INSERT INTO personne (Nom, Prenom, Tel, Adresse, Email, classe)
                             VALUES ('$Nom', '$Prenom','$Tel', '$Adresse', '$Email', '$classe')";
                    $pdo->exec($sql);

                    // Ajout de ligne dans la table eleves
                    $personne_id = $pdo->lastInsertId();
                    $sql_eleve = "INSERT INTO eleves (personne_ID) VALUES ('$personne_id')";
                    $sql2 = $pdo->prepare($sql_eleve);
                    $sql2->execute();
                    // Ajout de ligne dans la table image_upload
                    $sqlimgID = "INSERT INTO image_upload (personne_ID) VALUES ('$personne_id')";
                    $sql3 = $pdo->prepare($sqlimgID);
                    $sql3->execute();
                    // Préparez la requête SQL avec une requête préparée
                    $sqlupload = "UPDATE image_upload SET filename=('$filename')
                                  WHERE personne_ID = '$personne_id' ";
                    $upload = $pdo->prepare($sqlupload);
                    $upload->execute();

                    if (move_uploaded_file($tempname, $folder)) {
                        echo '<script> alert("Ces données ont été inséré dans la base de données.") </script>';
                    } else {
                    }
                } else {
                }
            } else {
                echo '<script> alert("Ces données existent déjà dans la base de données ou erreur dans le remplissage du formulaire.") </script>';
            }
        }


        // liste eleves
        
        $query = $pdo->prepare(" SELECT * FROM personne  
        JOIN eleves ON personne.ID = eleves.personne_ID 
        JOIN image_upload ON personne.ID = image_upload.personne_ID");
        $query->execute(); ?>

        <div class="row">
            <div class="col-4"></div>
            <div class="col">
                <section class="me-2 ">
                    <table>
                        <?php
                        // LOOP TILL END OF DATA
                        while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr class="search_prenom">
                                <!-- FETCHING DATA FROM EACH
                                ROW OF EVERY COLUMN -->
                                <td><img src="<?php echo './image/' . $rows['filename']; ?>" alt="Image" class="img_list"></td>
                                <td><?php echo $rows['Nom']; ?></td>
                                <td><?php echo $rows['Prenom']; ?></td>
                                <td><?php echo $rows['classe']; ?></td>
                                <td><button type="button" data-bs-toggle="modal" data-bs-target="#ModalUpdate">edit</button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </section>
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
                        <button type="button" class="btn btn-success"
                            onclick="location.href='./loginprojet.html'">OUI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour la barre de recherche -->
    <script>
        // fonction de recherche
        function search_site() {
            let input = document.getElementById('site-search').value
            input = input.toLowerCase();
            let x = document.getElementsByClassName('search_prenom');

            for (i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                }
                else {
                    x[i].style.display = "table-row";
                }
            }
        }

        // fonction de reset
        function reset() {
            document.getElementById('site-search').value = '';
            search_site(); // Réexécutez la fonction de recherche pour afficher tous les résultats.
        }
    </script>
</body>

</html>