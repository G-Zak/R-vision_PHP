<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Révision PHP 1</title>
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
    <h2>1. Représenter un étudiant avec un tableau associatif</h2>
    <?php
    $etudiant = [
        "nom" => "zakaria",
        "prenom" => "guennani",
        "matricule" => "202501"
    ];
    echo "Nom : {$etudiant['nom']}<br>";
    echo "Prénom : {$etudiant['prenom']}<br>";
    echo "Matricule : {$etudiant['matricule']}<br>";
    ?>
</div>

<div class="section">
    <h2>2. Ajouter une note et modifier sa valeur</h2>
    <?php
    $etudiant["note"] = 15;
    echo "Note initiale : {$etudiant['note']}<br>";
    $etudiant["note"] = 18;
    echo "Note modifiée : {$etudiant['note']}<br>";
    ?>
</div>

<div class="section">
    <h2>3. Parcourir et afficher un tableau associatif de produits</h2>
    <?php
    $produits = [
        "Produit A" => 100,
        "Produit B" => 150,
        "Produit C" => 200
    ];
    foreach ($produits as $nom => $prix) {
        echo "Nom : $nom - Prix : $prix DH<br>";
    }
    ?>
</div>

<div class="section">
    <h2>4. Calculer et afficher la moyenne des scores des étudiants</h2>
    <?php
    $scores = [
        "zakaria" => 14,
        "amine" => 16,
        "imane" => 12,
        "hamza" => 18,
        "monsif" => 15
    ];
    $moyenne = array_sum($scores) / count($scores);
    echo "Moyenne des scores : $moyenne<br>";
    ?>
</div>

<div class="section">
    <h2>5. Trier un tableau par population en ordre décroissant</h2>
    <?php
    $pays = [
        "Maroc" => 37000000,
        "Allemagne" => 83000000,
        "Italie" => 60000000,
        "Espagne" => 47000000,
        "Portugal" => 10000000
    ];
    arsort($pays);
    foreach ($pays as $nom => $population) {
        echo "$nom : $population habitants<br>";
    }
    ?>
</div>

<div class="section">
    <h2>6. Formulaire avec nom et âge</h2>
    <form method="POST">
        Nom : <input type="text" name="nom" required><br>
        Âge : <input type="number" name="age" required><br>
        <button type="submit">Envoyer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nom"], $_POST["age"])) {
        $nom = $_POST["nom"];
        $age = $_POST["age"];
        echo "Bienvenue, $nom, vous avez $age ans !";
    }
    ?>
</div>

<div class="section">
    <h2>7. Validation de l’âge</h2>
    <form method="POST">
        Nom : <input type="text" name="nom" required><br>
        Âge : <input type="number" name="age" required><br>
        <button type="submit">Envoyer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["age"])) {
        $nom = $_POST["nom"];
        $age = $_POST["age"];
        if (filter_var($age, FILTER_VALIDATE_INT) && $age > 0) {
            echo "Bienvenue, $nom, vous avez $age ans !";
        } else {
            echo "Erreur : L'âge doit être un entier supérieur à 0.";
        }
    }
    ?>
</div>

<div class="section">
    <h2>8. Formulaire avec liste déroulante pour choisir une couleur</h2>
    <form method="POST">
        Couleur préférée :
        <select name="couleur">
            <option value="Rouge">Rouge</option>
            <option value="Vert">Vert</option>
            <option value="Bleu">Bleu</option>
        </select>
        <button type="submit">Envoyer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["couleur"])) {
        $couleur = $_POST["couleur"];
        echo "Votre couleur préférée est : $couleur";
    }
    ?>
</div>

<div class="section">
    <h2>9. Saisir deux nombres et afficher leur somme</h2>
    <form method="GET">
        Nombre 1 : <input type="number" name="nombre1" required><br>
        Nombre 2 : <input type="number" name="nombre2" required><br>
        <button type="submit">Calculer</button>
    </form>
    <?php
    if (isset($_GET["nombre1"]) && isset($_GET["nombre2"])) {
        $nombre1 = $_GET["nombre1"];
        $nombre2 = $_GET["nombre2"];
        $somme = $nombre1 + $nombre2;
        echo "La somme est : $somme";
    }
    ?>
</div>

<div class="section">
    <h2>10. Sélection du type de compte</h2>
    <form method="POST">
        Type de compte :
        <select name="type_compte">
            <option value="Administrateur">Administrateur</option>
            <option value="Utilisateur">Utilisateur</option>
        </select>
        <button type="submit">Envoyer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["type_compte"])) {
        $type_compte = $_POST["type_compte"];
        if ($type_compte === "Administrateur") {
            echo "Bienvenue, administrateur !";
        } else {
            echo "Bienvenue!";
        }
    }
    ?>
</div>

</body>
</html>