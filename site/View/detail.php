<?php include 'include/element.php';

// Récupération des informations de l'annonce dans la BDD
$ida = $_GET["ida"];
$req = $pdo->prepare("SELECT * FROM annonce WHERE ida = :ida");
$req->execute(array("ida" => $ida));
$req = $req->fetch(PDO::FETCH_ASSOC);

$titre = $req["titre"];
$detail = $req["detail"];
$prix = $req["prix"];
$photo = $req["chemin"];
$vendeur = $req["vendeur"];
$categorie = $req["categorie"];
$favoris = $req["favoris"];
$etat = $req["etat"];
$livraison = $req["livraison"];



// Récupération des informations du vendeur
$req3 = $pdo->query("SELECT * FROM user WHERE idu = ".$vendeur);
$req3 = $req3->fetch(PDO::FETCH_ASSOC);
$nom = $req3["nom"];
$prenom = $req3["prenom"];
$nomVille = $req3["nomVille"];

if (isset($_POST["send"])) {
    $message = $_POST["message"];
    $req = $pdo->prepare("INSERT INTO conversation (idc, idan, idu, idv, time) VALUES (null, :idan, :idu, :idv, :time)");
    $req->execute(array("idan" => $ida, "idu" => $uid, "idv" => $vendeur, "time" => time()));
    $lastId = $pdo->lastInsertId();
    $req = $pdo->prepare("INSERT INTO message (idm, idu_q, idu_r, idc, contenu, time) VALUES (null, :idu_q, :idu_r, :idc, :contenu, :time)");
    $req->execute(array("idu_q" => $uid, "idu_r" => $vendeur, "idc" => $lastId, "contenu" => $message, "time" => time()));
    header("Location: message.php?idc=$lastId");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Detail annonce - Great Deal</title>
    <?php include 'include/header.php'; ?> <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">
    <?php include 'include/navigation.php'; ?> <!-- bar de navigation présente sur toutes les pages -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="card rounded hover-shadow">
                                    <div class="card">
                                        <img src='../<?= htmlspecialchars($photo) ?>' width='350'>
                                        <br>
                                        <span class="favorite-button">
                                            <a class="btn btn-danger" href="<?php if (isset($uid)): ?> action_get.php?action=ajoutFavori&ida=<?= $ida ?>&idu=<?= $uid ?>&route=location:detail.php?ida=<?= $ida ?><?php else: ?>connexion.php<?php endif; ?>">
                                            <?php
                                            if (isset($uid)) {
                                                $verif = $pdo->prepare("SELECT * FROM favoris WHERE ida = ? AND idu = ?");
                                                $verif->execute(array($ida, $uid));
                                                if ($verif->rowCount() == 0) {
                                                    echo '<i style="color: #ff0000" class="fa-regular fa-heart"></i>';
                                                } else {
                                                    echo '<i style="color: #ff0000" class="fa-solid fa-heart"></i>';
                                                }
                                            } else {
                                                echo '<i style="color: #ff0000" class="fa-regular fa-heart"></i>';
                                            }
                                            ?><?= $favoris ?></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="card rounded hover-shadow">
                                    <div class="card">
                                        <h2><?= htmlspecialchars($titre) ?><p class="float-end h3"><?= number_format($prix, 0, ',', ' ') ?> €</p></h2>
                                        <ul class="product-variation">
                                            <?php if ($categorie == 1): ?>
                                                <a class="badge badge-pill badge-primary" href="categorie.php?idcategorie=<?= $categorie ?>">Romance<i class="fa-solid fa-heart mx-2"></i></a>
                                            <?php elseif ($categorie == 2): ?>
                                                <a class="badge badge-pill badge-warning">Thriller/Policier<i class="fa-solid fa-user-secret mx-2"></i></a>
                                            <?php elseif ($categorie == 3): ?>
                                                <a class="badge badge-pill badge-info">Science Fiction<i class="fa-solid fa-rocket mx-2"></i></a>
                                            <?php elseif ($categorie == 4): ?>
                                                <a class="badge badge-pill badge-danger">Développement personnel<i class="fa-solid fa-feather-pointed mx-2"></i></a>
                                            <?php else: ?>
                                                <a class="badge badge-pill badge-success">Romans étrangers<i class="fa-solid fa-earth-europe mx-2"></i></a>
                                            <?php endif; ?>
                                            <span class="badge badge-pill badge-info"><?= htmlspecialchars($etat) ?> &nbsp<i class="fa-solid fa-thumbs-up"></i></span>
                                            <?php if ($livraison == 1): ?>
                                                <span class="badge badge-pill badge-success">Livraison &nbsp<i class="fa-solid fa-truck"></i></span>
                                            <?php else: ?>
                                                <span class="badge badge-pill badge-sucess">Main propre &nbsp<i class="fa-solid fa-handshake"></i></span>
                                            <?php endif; ?>
                                        </ul>
                                        <p><?= htmlspecialchars($detail) ?></p>
                                        <p class="card-text"><small class="text-muted float-start"><?= htmlspecialchars($nom) ?> <?= htmlspecialchars($prenom) ?></small><small class="text-muted"><br><?= htmlspecialchars($nomVille) ?></small></p>
                                        <p>
                                            <?php if (isset($uid)): ?>
                                                <?php
                                                $verif = $pdo->prepare("SELECT * FROM conversation WHERE idan = ? AND idu = ?");
                                                $verif->execute(array($ida, $uid));
                                                if ($verif->rowCount() == 0): ?>
                                                    <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@fat">Contacter le vendeur</button>
                                                <?php else:
                                                    $idc = $verif->fetch(); ?>
                                                    <a href="message.php?idc=<?= htmlspecialchars($idc["idc"]) ?>" class="btn btn-inverse-warning">Contacter le vendeur</a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="connexion.php" class="btn btn-inverse-warning">Contacter le vendeur</a>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5 class="modal-title" id="ModalLabel">Nouveau message</h5>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" name="message" id="message-text"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" name="send" value="Envoyer message">
                                    </form>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- formulaire renvoyant à la méthode post afin de faire la requête dans le if(isset) -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?> <!-- footer présent sur toutes les pages -->
<?php include 'include/script.php'; ?> <!-- script présent sur toutes les pages (connexion avec bootstrap) -->
</body>
</html>
