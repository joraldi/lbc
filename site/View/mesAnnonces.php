<?php include 'include/element.php'; ?> <!-- élément php présent sur toutes les pages (vérification si session ouvert, connexion bdd, etc...) -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mes annonces - V&S</title>
    <?php include 'include/header.php'; ?>  <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">

    <?php include 'include/navigation.php'; ?> <!-- bar de navigation présente sur toutes les pages-->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h1>Mes annonces</h1>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Photo</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Livraison</th>
                                        <th>Prix</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    <?php
                                    $req = $pdo->prepare('SELECT * FROM annonce WHERE vendeur = ?'); // Récupère toutes les annonces de l'utilisateur connecté 
                                    $req->execute(array($uid));
                                    $result = $req->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        $req2 = $pdo->query("SELECT * FROM categorie WHERE idc=" . $row['categorie']);
                                        $ligne2 = $req2->fetch(PDO::FETCH_ASSOC);

                                        echo "<tr>";
                                        // Vérifie si le chemin de la photo existe et n'est pas vide
                                        if (isset($row["chemin"]) && !empty($row["chemin"])) {
                                            echo "<td class='align-middle'><img src='../" . htmlspecialchars($row["chemin"]) . "' width='60'></td>";
                                        } else {
                                            echo "<td class='align-middle'><img src='../path/to/default-image.jpg' width='60' alt='Image par défaut'></td>";
                                        }
                                        echo "<td class='align-middle'>" . htmlspecialchars($row["titre"]) . "</td>";
                                        echo "<td class='align-middle'>" . htmlspecialchars($ligne2["nomCat"]) . "</td>";
                                        echo "<td class='align-middle'>" . (isset($row["livraison"]) && $row["livraison"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                                        echo "<td class='align-middle'>" . htmlspecialchars($row["prix"]) . "€</td>";
                                        echo "<td class='align-middle'>
                                                <a class='btn btn-sm btn-info' href='editAnnonce.php?ida=" . htmlspecialchars($row["ida"]) . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                                <a href='action_get.php?action=supAnnonce&ida=" . htmlspecialchars($row["ida"]) . "' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'include/footer.php'; ?> <!-- footer présent sur toutes les pages -->
        </div>
    </div>
</div>
<?php include 'include/script.php'; ?> <!-- script présent sur toutes les pages (connexion avec bootstrap) -->
</body>
</html>
