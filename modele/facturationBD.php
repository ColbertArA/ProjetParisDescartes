<?php
//fichier php gérant les requêtes de la base données pour les factures

//crée une nouvelle facture dans ma bdd 
function nvleFacture($idU, $dateD, $dateF, $total, $paiement)
{

    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO facturation (id_vehicule, id_entreprise, dateD_facturation, dateF_facturation, valeur_facturation, etat_facturation) VALUES (?,?,?,?,?,?)');
    $req->execute(array($idU, $_SESSION['id_entreprise'], $dateD, $dateF, $total, $paiement));

    louer_vehicule($idU);

}

?>