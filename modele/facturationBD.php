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

//récupère les factures du mois de chaques entreprise
function facturesDuMois($moisActuel, $i)
{

    require ('./modele/connect.php');
    require ('./controle/facturation.php');

    //on récupère le nombre d'entreprise dans la bdd
    $count = $pdo->prepare('SELECT COUNT(*) AS nb FROM facturation');
    $count->execute();
    $donnesF = $count->fetch();
    $countNb = $donnesF['nb'];
    $count->closeCursor();

    $req = $pdo->prepare('SELECT valeur_facturation, dateD_facturation 
    FROM facturation 
    WHERE id_entreprise = :idE');
    $req->execute(array('idE' => $i));
    $res = $req->fetchAll();

    // for ($j = 1; $j <= $i; $j++) {

    //     $k = 1; 
    //     $verif = $res[$k][$j];
    //     list($annee, $moisVerif, $jour) = explode('-', $verif);

    //     if ($moisActuel == $moisVerif) {
    //         $k = 0;
    //         $prix = $res[$j][$k];
    //         calculFactures();
    //     }
    // }

    $total = $res[0][0] + $res[1][0] +$res[2][0];

    for ($j = 0; $j <= $countNb; $j++){
        $k = 0;
        if (!empty($res[$j][$k])){
            
            $totalk = $totalk + $res[$j][$k];
            print_r($totalk);
        }
    }

    //print_r($res[5][0]);
}




?>