<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Bibliothèque</title>
    <link rel="stylesheet" href="/ict108/GROUPE10/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="nav-main">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <i class="fas fa-book-open"></i> Bibliothèque
            </a>
            
            <!-- Bouton hamburger pour mobile -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu de navigation">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            
            <div class="nav-menu" id="navMenu">
                <a href="index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Accueil
                </a>
                <a href="afficher.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'afficher.php' ? 'active' : '' ?>">
                    <i class="fas fa-search"></i> Rechercher
                </a>
                <a href="ajouter.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'ajouter.php' ? 'active' : '' ?>">
                    <i class="fas fa-plus-circle"></i> Ajouter
                </a>
                <a href="retirer.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'retirer.php' ? 'active' : '' ?>">
                    <i class="fas fa-trash-alt"></i> Supprimer
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Overlay pour fermer le menu mobile -->
    <div class="nav-overlay" id="navOverlay"></div>
    <main class="main-container">
