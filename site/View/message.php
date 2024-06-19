<<<<<<< HEAD
<?php include 'include/element.php'; // élément php présent sur toutes les pages (vérification si session ouvert, connexion bdd, etc...)
date_default_timezone_set('Europe/Paris');

// Récupération des conversations pour l'utilisateur connecté
$req = $pdo->prepare('SELECT * FROM conversation WHERE idu = :uid OR idv = :idv ORDER BY time DESC');
=======
<?php include 'include/element.php'; // élément php présent sur tout les pages (vérification si sessiion ouvert, connexion bdd etc...)
date_default_timezone_set('Europe/Paris');
$req = $pdo->prepare('SELECT * FROM conversation WHERE idu = :uid or idv =:idv order by time desc');
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
$req->bindValue(':uid', $uid, PDO::PARAM_INT);
$req->bindValue(':idv', $uid, PDO::PARAM_INT);
$req->execute();
$listConv = $req->fetchAll(PDO::FETCH_ASSOC);
<<<<<<< HEAD

if (isset($_GET["idc"])) {
    $idc = $_GET["idc"];
    
    $req2 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc ORDER BY time ASC');
=======
// recuperation des tous les messages de la table conversation pour l'utilisateur actuellement connecté 

if(isset($_GET["idc"])){
    $idc = $_GET["idc"];
    
    $req2 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc order by time asc');
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
    $req2->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req2->execute();
    $listMessage = $req2->fetchAll(PDO::FETCH_ASSOC);
    
<<<<<<< HEAD
    $req3 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc ORDER BY time DESC LIMIT 1');
    $req3->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req3->execute();
    $result3 = $req3->fetch(PDO::FETCH_ASSOC);
    $lastMessage = $result3["contenu"];
    
    $req4 = $pdo->prepare('SELECT * FROM conversation WHERE idc = :idc');
    $req4->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req4->execute();
    $infoConv = $req4->fetch(PDO::FETCH_ASSOC);

    $req5 = $pdo->prepare('SELECT * FROM annonce WHERE ida = :ida');
    $req5->bindValue(':ida', $infoConv["idan"], PDO::PARAM_INT);
    $req5->execute();
    $infoAnnonce = $req5->fetch(PDO::FETCH_ASSOC);

    if ($result3["idu_r"] == $uid) {
        $idCorrespondant = $result3["idu_q"];
    } else {
        $idCorrespondant = $result3["idu_r"];
    }

    $req6 = $pdo->prepare('SELECT * FROM user WHERE idu = :idu');
    $req6->bindValue(':idu', $idCorrespondant, PDO::PARAM_INT);
    $req6->execute();
    $infoCorrespondant = $req6->fetch(PDO::FETCH_ASSOC);
}

// Insertion d'un nouveau message
if (isset($_POST["bout_mess"])) {
    if (isset($_GET["idc"])) {
        $idc = $_GET["idc"];
        $message = $_POST["message"];
        $time = date('U');
        $req = $pdo->prepare("INSERT INTO message VALUES (null, :idu_q, :idu_r, :idc, :message, :time)");
=======
    $req3 = $pdo->prepare('SELECT * FROM message where idc = :idc order by time desc limit 1');
    $req3->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req3->execute();
    $result3 = $req3->fetch();
    $lastMessage = $result3["contenu"];
    
    $req4 = $pdo->prepare('SELECT * FROM conversation where idc = :idc');
    $req4->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req4->execute();
    $infoConv = $req4->fetch();

    $req5 = $pdo->prepare('SELECT * FROM annonce where ida = :ida');
    $req5->bindValue(':ida', $infoConv["idan"], PDO::PARAM_INT);
    $req5->execute();
    $infoAnnonce = $req5->fetch();

    if($result3["idu_r"] == $uid){
        $idCorrespondant = $result3["idu_q"];
    }else{
        $idCorrespondant = $result3["idu_r"];
    }
    $req6 = $pdo->prepare('SELECT * FROM user WHERE idu = :idu');
    $req6->bindValue(':idu', $idCorrespondant, PDO::PARAM_INT);
    $req6->execute();
    $infoCorrespondant = $req6->fetch();
}
// recuperation de toutes les informations concernant la categorie, l'annonce, l'utilisateur et le correspondant avec PDO





if(isset($_POST["bout_mess"]))
{
    if(isset($_GET["idc"])) {
        $idc = $_GET["idc"];
        var_dump($message = $_POST["message"]);
        $time = date('U');
        $req = $pdo->prepare("INSERT INTO message VALUES(null,:idu_q,:idu_r,:idc,:message,:time)"); // envoie les onnes valeurs mais ne s'insere pas dans bdd ?
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
        $req->execute([
            ':idu_q' => $uid,
            ':idu_r' => $infoCorrespondant["idu"],
            ':idc' => $idc,
            ':message' => $message,
            ':time' => $time,
        ]);
        header("Location: message.php?idc=$idc");
    }
<<<<<<< HEAD
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Message - V&S</title>
    <?php include 'include/header.php'; ?> <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
=======

}
// si un message est envoyé, on insert dans la table message toutes les informations demandés puis on donne les valeurs correspondant à nos parametres
// redirection vers la page message 

?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Message - Great Deal</title>
    <?php include 'include/header.php'; ?>  <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">

<<<<<<< HEAD
    <?php include 'include/navigation.php'; ?> <!-- bar de navigation présente sur toutes les pages -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
=======
    <?php include 'include/navigation.php'; ?> <!-- bar de navigation présent sur toute les pages-->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">


>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary py-3 mb-4 text-center d-md-none aside-toggler"><i class="mdi mdi-menu mr-0 icon-md"></i></button>
                        <div class="card chat-app-wrapper">
                            <div class="row mx-0">
                                <div class="col-lg-3 col-md-4 chat-list-wrapper px-0">
                                    <div class="chat-list-item-wrapper">
                                        <?php
<<<<<<< HEAD
                                        foreach ($listConv as $conv) {
                                            $req3 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc ORDER BY time DESC LIMIT 1');
=======
                                        foreach($listConv as $conv){
                                            $req3 = $pdo->prepare('SELECT * FROM message where idc = :idc order by time desc limit 1');
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
                                            $req3->bindValue(':idc', $conv["idc"], PDO::PARAM_INT);
                                            $req3->execute();
                                            $result3 = $req3->fetch(PDO::FETCH_ASSOC);
                                            $lastMessage = $result3["contenu"];
<<<<<<< HEAD
                                            if ($result3["idu_r"] == $uid) {
                                                $idCorrespondant = $result3["idu_q"];
                                            } else {
                                                $idCorrespondant = $result3["idu_r"];
                                            }

                                            $req6 = $pdo->prepare('SELECT * FROM user WHERE idu = :idu');
                                            $req6->bindValue(':idu', $idCorrespondant, PDO::PARAM_INT);
                                            $req6->execute();
                                            $infoCorresConv = $req6->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <a style="outline: none; text-decoration: none;" href="message.php?idc=<?= $conv["idc"] ?>">
                                            <div class="list-item">
                                                <div class="profile-image">
                                                    <img class="img-sm rounded-circle" src="../<?= htmlspecialchars($infoCorresConv["avatar"] ?: "image/avatarbasique.png") ?>" alt="">
                                                </div>
                                                <p class="user-name"><?= htmlspecialchars($infoCorresConv["prenom"]) ?> <?= htmlspecialchars($infoCorresConv["nom"]) ?></p>
                                                <p class="chat-time">
                                                    <?php
                                                    $timeConv = time() - $result3["time"];
                                                    if ($timeConv < 3600) {
                                                        echo "il y a " . intval($timeConv / 60) . " minutes";
                                                    } elseif ($timeConv < 86400) {
                                                        echo "il y a " . intval($timeConv / 3600) . " heures";
                                                    } else {
                                                        echo "il y a " . intval($timeConv / 86400) . " jours";
                                                    }
                                                    ?>
                                                </p>
                                                <p class="chat-text"><?= htmlspecialchars($lastMessage) ?></p>
                                            </div>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-8 px-0 d-flex flex-column">
                                    <div class="chat-container-wrapper" style="height: 350px">
                                        <?php
                                        if (isset($_GET["idc"])) {
                                            foreach ($listMessage as $mess) {
                                                if ($mess["idu_q"] == $idCorrespondant) { ?>
                                                    <div class="chat-bubble incoming-chat">
                                                        <div class="chat-message">
                                                            <p class="font-weight-bold"><?= htmlspecialchars($infoCorrespondant["prenom"]) ?> <?= htmlspecialchars($infoCorrespondant["nom"]) ?></p>
                                                            <p><?= htmlspecialchars($mess["contenu"]) ?></p>
                                                        </div>
                                                        <div class="sender-details">
                                                            <img class="sender-avatar img-xs rounded-circle" src="../<?= htmlspecialchars($infoCorrespondant["avatar"] ?: "image/avatarbasique.png") ?>" alt="profile image">
                                                            <p class="seen-text">Message envoyé :
                                                                <?php
                                                                $timeMess = time() - $mess["time"];
                                                                if ($timeMess < 3600) {
                                                                    echo "il y a " . intval($timeMess / 60) . " minutes";
                                                                } elseif ($timeMess < 86400) {
                                                                    echo "il y a " . intval($timeMess / 3600) . " heures";
                                                                } else {
                                                                    echo "il y a " . intval($timeMess / 86400) . " jours";
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else { ?>
                                                    <div class="chat-bubble outgoing-chat">
                                                        <div class="chat-message" style="background-color: #DCDD54">
                                                            <p><?= htmlspecialchars($mess["contenu"]) ?></p>
                                                        </div>
                                                        <div class="sender-details">
                                                            <img class="sender-avatar img-xs rounded-circle" src="../<?= htmlspecialchars($infoUser["avatar"] ?: "image/avatarbasique.png") ?>" alt="profile image">
                                                            <p class="seen-text">Message envoyé :
                                                                <?php
                                                                $timeMess = time() - $mess["time"];
                                                                if ($timeMess < 3600) {
                                                                    echo "il y a " . intval($timeMess / 60) . " minutes";
                                                                } elseif ($timeMess < 86400) {
                                                                    echo "il y a " . intval($timeMess / 3600) . " heures";
                                                                } else {
                                                                    echo "il y a " . intval($timeMess / 86400) . " jours";
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
=======
                                            //  pour chaque message dans la liste de message on demande le dernier message envoyé avec order by desc limit 1 
                                         
                                            if($result3["idu_r"] == $uid){
                                                $idCorrespondant = $result3["idu_q"];
                                            }else{
                                                $idCorrespondant = $result3["idu_r"];
                                            }
                                            // si le message est envoyé par la personne connecter alors il prend l'idcorrespondant et se stocke comme idu_q 
                                            //sinon la personne connecter recoit le message et deviens idu_r
                                            $req6 = $pdo->prepare('SELECT * FROM user WHERE idu = :idu');
                                            $req6->bindValue(':idu', $idCorrespondant, PDO::PARAM_INT);
                                            $req6->execute();
                                            $infoCorresConv = $req6->fetch();
                                            // on recupere les informations de l'user 

                                            ?>
                                            <a  style="outline: none; text-decoration: none;"  href="message.php?idc=<?=$conv["idc"]?>"> <!--  cliquer sur la conevrsation? -->
                                            <div class="list-item">
                                                <div class="profile-image">
                                                    <img class="img-sm rounded-circle" src="../<?php if($infoCorresConv["avatar"]){  echo $infoCorresConv["avatar"]; }else{ echo "image/avatarbasique.png";} ?>" alt="">
                                                </div>
                                                <p class="user-name"><?=$infoCorresConv["prenom"]; $infoCorresConv["nom"]?></p>
                                                <p class="chat-time">
                                                    <?php
                                                    $timeConv = date('U') - $result3["time"];
                                                    if($timeConv < 3600){
                                                        echo "il y a ".date("i", $timeConv)." minutes";
                                                    }elseif($timeConv < 86400){
                                                        echo "il y a ".date("H", $timeConv)." heures";
                                                    }else{
                                                        echo "il y a ".date("d", $timeConv)." jours";
                                                    }

                                                    ?>
                                                </p>
                                                <p class="chat-text"><?=$lastMessage?></p>
                                            </div>
                                            </a>
                                            <!-- on affiche les resultats des requetes, affichage de la date  -->
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-8 px-0 d-flex flex-column">
                                        <div class="chat-container-wrapper" style="height: 350px">
                                        <?php
                                        if(isset($_GET["idc"]))
                                        foreach($listMessage as $mess){
                                                if($mess["idu_q"] == $idCorrespondant){ ?>
                                                    <div class="chat-bubble incoming-chat">
                                                        <div class="chat-message">
                                                            <p class="font-weight-bold"><?=$infoCorrespondant["prenom"]?> <?=$infoCorrespondant["nom"]?></p>
                                                            <p><?=$mess["contenu"]?></p>
                                                        </div>
                                                        <div class="sender-details">
                                                            <img class="sender-avatar img-xs rounded-circle" src="../<?php if($infoCorrespondant["avatar"]){  echo $infoCorrespondant["avatar"]; }else{ echo "image/avatarbasique.png";} ?>" alt="profile image">
                                                            <p class="seen-text">Message envoyé : <?php
                                                                $timeMess = date('U') - $mess["time"];
                                                                if($timeMess < 3600){
                                                                    echo "il y a ".date("i", $timeMess)." minutes";
                                                                }elseif($timeMess < 86400){
                                                                    echo "il y a ".date("H", $timeMess)." heures";
                                                                }else{
                                                                    echo "il y a ".date("d", $timeMess)." jours";
                                                                }
                                                                ?></p>
                                                        </div>
                                                    </div>
                                                    <!-- si l'id correspondant est n'est pas le sien alors affichage :  info du correspondant,  contenu du message et  date
                                                 -->
                                        <?php   }else{ ?>
                                                    <div class="chat-bubble outgoing-chat" >
                                                        <div class="chat-message" style="background-color: #DCDD54">
                                                            <p><?=$mess["contenu"]?>
                                                            </p>
                                                        </div>
                                                        <div class="sender-details">
                                                            <img class="sender-avatar img-xs rounded-circle" src="../<?php if($infoUser["avatar"]){  echo $infoUser["avatar"]; }else{ echo "image/avatarbasique.png";} ?>" alt="profile image">
                                                            <p class="seen-text">Message envoyé : <?php
                                                                $timeMess = date('U')-$mess["time"];
                                                                if($timeMess < 3600){
                                                                    echo "il y a ".date("i", $timeMess)." minutes";
                                                                }elseif($timeMess < 86400){
                                                                    echo "il y a ".date("H", $timeMess)." heures";
                                                                }else{
                                                                    echo "il y a ".date("d", $timeMess)." jours";
                                                                }?></p>
                                                        </div>
                                                    </div>
                                        <?php }
                                        // si la personne connecté est celui qui a envoyé le message alors affichage du contenu et de la date du message
                                        }?>

>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
                                    </div>
                                    <div class="chat-text-field mt-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="message" placeholder="Entrer votre message">
                                                <div class="input-group-append">
                                                    <input class="btn btn-gradient-warning" type="submit" name="bout_mess" value="Envoyer">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
<<<<<<< HEAD
                                <?php if (isset($_GET["idc"])): ?>
                                    <div class="col-lg-3 d-none d-lg-block px-0 chat-sidebar">
                                        <img class="img-fluid w-100" src="../<?= htmlspecialchars($infoAnnonce["chemin"]) ?>" alt="profile image">
                                        <div class="px-4">
                                            <div class="d-flex pt-4">
                                                <div class="wrapper">
                                                    <h5 class="font-weight-medium mb-0 ellipsis"><?= htmlspecialchars($infoAnnonce["titre"]) ?></h5>
                                                </div>
                                                <div class="badge badge-gradient-success mb-auto ms-auto"><?= htmlspecialchars($infoAnnonce["prix"]) ?> €</div>
                                            </div>
                                            <div class="pt-3">
                                                <div class="d-flex align-items-center py-1">
                                                    <p class="mb-0 font-weight-medium"><?= htmlspecialchars($infoAnnonce["detail"]) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!-- affichage de l'annonce pour laquelle il y a conversation -->
=======
                                <?php if(isset($_GET["idc"])): ?>
                                <div class="col-lg-3 d-none d-lg-block px-0 chat-sidebar">
                                    <img class="img-fluid w-100" src="../<?= $infoAnnonce["photo"] ?>" alt="profile image">
                                    <div class="px-4">
                                        <div class="d-flex pt-4">
                                            <div class="wrapper">
                                                <h5 class="font-weight-medium mb-0 ellipsis"><?= $infoAnnonce["titre"] ?></h5>
                                            </div>
                                            <div class="badge badge-gradient-success mb-auto ms-auto"><?= $infoAnnonce["prix"] ?> €</div>
                                        </div>
                                        <div class="pt-3">
                                            <div class="d-flex align-items-center py-1">
                                                <p class="mb-0 font-weight-medium"><?= $infoAnnonce["detail"] ?></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <!-- affichage de l'annonce pour lequel il y a conversation -->
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
            <?php include 'include/footer.php'; ?> <!-- footer présent sur toutes les pages -->
        </div>
    </div>
</div>
<?php include 'include/script.php'; ?> <!-- script présent sur toutes les pages (connexion avec bootstrap) -->
</body>
</html>
=======


            </div>

            <?php include 'include/footer.php'; ?> <!-- footer présent sur toute les pages -->

        </div>
    </div>
</div>

<?php include 'include/script.php'; ?> <!-- script présent sur toute les pages (connexion avec bootstrap) -->

</body>
</html>
>>>>>>> e4f12a7ec719cba099a4f74a54e5963beb2b368f
