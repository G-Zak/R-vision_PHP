<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Révision PHP 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .section {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .section h2 {
            margin-top: 0;
            color: #333;
        }
        form {
            margin-top: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        input, select {
            padding: 5px;
            margin: 5px 0;
            width: 100%;
            max-width: 300px;
        }
    </style>
</head>
<body>
<div class="section">
<h2>1.Tableau associatif de 5 employés </h2>
<?php
    $employes = [
        ["nom" => "Zakaria", "poste" => "Développeur", "salaire" => 30000],
        ["nom" => "Amine", "poste" => "Designer", "salaire" => 25000],
        ["nom" => "Imane", "poste" => "Chef de projet", "salaire" => 40000],
        ["nom" => "Hamza", "poste" => "Analyste", "salaire" => 35000],
        ["nom" => "Monsif", "poste" => "Testeur", "salaire" => 22000]
    ];
    
    function salaireMoyen($employes) {
        $totalSalaire = 0;
        foreach ($employes as $employe) {
            $totalSalaire += $employe['salaire'];
        }
        return $totalSalaire / count($employes);
    }
    
    echo "Salaire moyen : " . salaireMoyen($employes);
    
?>
</div>

<div class="section">
    <h2>2.Recherche dynamique  des employees</h2>
        <form method="POST">
            <input type="text" name="nom" placeholder="Entrez le nom de l'employé">
            <button type="submit">Rechercher</button>
        </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nomRecherche = $_POST['nom'];
            foreach ($employes as $employe) {
                if (strtolower($employe['nom']) == strtolower($nomRecherche)) {
                    echo "Nom: " . $employe['nom'] . "<br>";
                    echo "Poste: " . $employe['poste'] . "<br>";
                    echo "Salaire: " . $employe['salaire'] . "<br>";
                    break;
                }
            }
        }            
    ?>
</div>

<div class="section">
    <h2>3.Formulaire de connexion</h2>
    <?php
        $utilisateurs = [
            ["email" => "zakaria@google.com", "motdepasse" => "12345"],
            ["email" => "admin@google.com", "motdepasse" => "admin123"]
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $motdepasse = $_POST['motdepasse'];
            
            foreach ($utilisateurs as $utilisateur) {
                if ($utilisateur['email'] == $email && $utilisateur['motdepasse'] == $motdepasse) {
                    echo "Connexion réussie !";
                    break;
                }
            }
        }
    ?>
    <form method="POST">
        Email: <input type="email" name="email"><br>
        Mot de passe: <input type="password" name="motdepasse"><br>
        <button type="submit">Se connecter</button>
    </form>
</div>


<div class="section">
    <h2>4.Système de panier</h2>
    <?php
        $panier = [
            ["nom" => "Produit 1", "quantite" => 2, "prix" => 150],
            ["nom" => "Produit 2", "quantite" => 1, "prix" => 300]
        ];
        
        $total = 0;
        foreach ($panier as $produit) {
            $total += $produit['quantite'] * $produit['prix'];
        }
        
        echo "Total du panier : " . $total . "€";
    ?>
</div>

<div class="section">
<h2>5.Formulaire permettant à un utilisateur de soumettre un commentaire </h2>
    <?php
        $commentaires = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $commentaire = $_POST['commentaire'];
            $commentaires[] = ["commentaire" => $commentaire, "date" => date("Y-m-d H:i:s")];
        }
        
        foreach ($commentaires as $commentaire) {
            echo $commentaire['date'] . " : " . $commentaire['commentaire'] . "<br>";
        }    
    ?>
    <form method="POST">
        Commentaire: <textarea name="commentaire"></textarea><br>
        <button type="submit">Envoyer</button>
    </form>
</div>


<div class="section">
<h2>6.Villes et leurs températures </h2>
<?php
    $villes = [
        "Ifrane" => 15,
        "Casablanca" => 25,
        "Tanger" => 22,
        "Rabat" => 27
    ];
    
    $villeMaxTemp = array_keys($villes, max($villes))[0];
    echo "La ville avec la température la plus élevée est " 
                . $villeMaxTemp . " avec " . $villes[$villeMaxTemp] . "°C.";
?>
</div>


<div class="section">
    <h2>7.Formulaire qui accepte un fichier CSV </h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv'])) {
            $file = fopen($_FILES['csv']['tmp_name'], "r");
            $produits = [];
            
            while (($data = fgetcsv($file)) !== false) {
                $produits[] = ["nom" => $data[0], "prix" => $data[1], "quantite" => $data[2]];
            }
            fclose($file);
            
            echo "<table border='1'><tr><th>Nom</th><th>Prix</th><th>Quantité</th></tr>";
            foreach ($produits as $produit) {
                echo "<tr><td>" . $produit['nom'] . "</td><td>" . $produit['prix'] . "</td><td>" . $produit['quantite'] . "</td></tr>";
            }
            echo "</table>";
        }
    ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="csv" accept=".csv"><br>
        <button type="submit">Importer</button>
    </form>
</div>


<div class="section">
    <h2>8.Sélection des produits via des cases à coche </h2>
    <?php
        $produits = [
            ["nom" => "Produit A", "prix" => 100],
            ["nom" => "Produit B", "prix" => 200],
            ["nom" => "Produit C", "prix" => 300]
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $total = 0;
            foreach ($_POST['produits'] as $produit) {
                $total += $produits[$produit]['prix'];
            }
            echo "Total: " . $total . "DH";
        }
    ?>
    <form method="POST">
        <?php foreach ($produits as $index => $produit): ?>
            <input type="checkbox" name="produits[]" value="<?= $index ?>"> <?= $produit['nom'] ?> (<?= $produit['prix'] ?>€)<br>
        <?php endforeach; ?>
        <button type="submit">Soumettre</button>
    </form>
</div>


<div class="section">
<h2>9.Tableau associatif  pour stocker les informations sur des étudiants</h2>
<?php
    $etudiants = [
        "Zakaria" => ["maths" => 15, "francais" => 12, "Anglais" => 17],
        "Amine" => ["maths" => 18, "francais" => 14, "Anglais" => 16],
    ];
    
    foreach ($etudiants as $nom => $notes) {
        $moyenne = array_sum($notes) / count($notes);
        echo "Moyenne de " . $nom . ": " . $moyenne . "<br>";
    }
?>
</div>

<div class="section">
    <h2>10.Système de gestion des utilisateurs  </h2>
    <?php
        $utilisateurs = [
            ["id" => 1, "nom" => "Zakaria"],
            ["id" => 2, "nom" => "Amine"]
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['action'] == 'add') {
                $utilisateurs[] = ["id" => count($utilisateurs) + 1, "nom" => $_POST['nom']];
            } elseif ($_POST['action'] == 'delete') {
                unset($utilisateurs[$_POST['id']]);
            }
        }
        
        foreach ($utilisateurs as $utilisateur) {
            echo "ID: " . $utilisateur['id'] . ", Nom: " . $utilisateur['nom'] . "<br>";
        }
    ?>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom">
        <button type="submit" name="action" value="add">Ajouter</button>
    </form>

    <form method="POST">
        <input type="number" name="id" placeholder="ID">
        <button type="submit" name="action" value="delete">Supprimer</button>
    </form>
</div>
</body>
</html>