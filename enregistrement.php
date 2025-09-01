
<!-- /****************************************************************
* Projet
: Gestion de la biliothèque
* Code PHP : ajouter.php
****************************************************************
* Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
<charles.kamga@facsciences-uy1.cm>
* Auteur 2 : KENFACK MOMO YVANA
<yvana.kenfack@facsciences-uy1.cm>
* Auteur 3 : Votre nom ici
<votre@adresse.email>
* ...
****************************************************************
* Date de création
: 04-07-2025 (04 Juillet 2025)
* Dernière modification : 05-07-2025 (05 Juillet 2025)
****************************************************************
* Description
recuperation des donnes du formulaire par $_POST et envois dans la base de données.
Utilisation de la superglobale $_FILE pour la verification de reception du fichier image et son allocation memoire.
****************************************************************
* Historique des modifications
* 04-07-2025 : Création du fichier enregistrement.php pour la page
*05-07-2025 : Ajout du commentaire.
***************************************************************/ -->


<?php
// Vérification de la réception des champs requis
if (isset($_POST['isbn']) && isset($_POST['titre']) && isset($_POST['auteur']) && isset($_POST['editeur']) && isset($_POST['annee']) && isset($_POST['description'])) {
    
    // Vérifier si le dossier uploads existe, sinon le créer
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // definition des variables qui vont reçevoir les donnes :
    $isbn = $_POST['isbn'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $editeur = $_POST['editeur'];
    $annee = $_POST['annee'];
    $description = $_POST['description'];



    // Gestion de l'upload de l'image
    $nom_image = "default.jpg"; // Valeur par défaut
    
    if (isset($_FILES['couverture']) && $_FILES['couverture']['error'] === UPLOAD_ERR_OK) {
        $fichier_temp = $_FILES['couverture']['tmp_name'];
        $nom_fichier = basename($_FILES['couverture']['name']);
        $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        
        // Vérifier le type MIME du fichier
        $type_mime = mime_content_type($fichier_temp);
        $types_autorises = ['image/jpeg', 'image/png', 'image/gif'];
        
        if (!in_array($type_mime, $types_autorises)) {
            die("Erreur : Seuls les fichiers JPG, PNG et GIF sont autorisés.");
        }
        
        // Créer un nom de fichier unique pour éviter les collisions
        $nouveau_nom = uniqid('couverture_', true) . '.' . $extension;
        $chemin = $upload_dir . $nouveau_nom;
        
        // Déplacer le fichier uploadé
        if (move_uploaded_file($fichier_temp, $chemin)) {
            $nom_image = $nouveau_nom;
        } else {
            die("Erreur lors du téléchargement du fichier.");
        }
    }



    // Connexion à la base de données avec gestion d'erreur
    $connect = mysqli_connect("localhost", "root", "", "ict108");
    
    if (mysqli_connect_errno()) {
        die("Échec de la connexion à la base de données : " . mysqli_connect_error());
    }

    // Préparation de la requête avec des requêtes préparées pour éviter les injections SQL
    $sql = "INSERT INTO ouvrage (isbn, titre, auteur, editeur, annee, description, couverture) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    
    if ($stmt) {
        // Lier les paramètres
        mysqli_stmt_bind_param($stmt, "ssssiss", 
            $_POST['isbn'],
            $_POST['titre'],
            $_POST['auteur'],
            $_POST['editeur'],
            $_POST['annee'],
            $_POST['description'],
            $nom_image
        );
        
        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            echo "L'ouvrage a été ajouté avec succès. <a href='index.php'>Retour à l'accueil</a>";
        } else {
            echo "Erreur lors de l'ajout de l'ouvrage : " . mysqli_error($connect);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur de préparation de la requête : " . mysqli_error($connect);
    }
    
    mysqli_close($connect);

} else {
    echo "Tous les champs obliatoires doivent etres remplis";
    exit(0);
}

?>