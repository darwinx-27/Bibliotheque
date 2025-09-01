<!-- /****************************************************************
* Projet
: Gestion de la biliothèque
* Code PHP : recherche.php
****************************************************************
* Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
<charles.kamga@facsciences-uy1.cm>
* Auteur 2 : Votre nom ici
<votre@adresse.email>
* Auteur 3 : Votre nom ici
<votre@adresse.email>
* ...
****************************************************************
* Date de création
: 04-07-2025 (04 Juillet 2025)
* Dernière modification : 05-07-2025 (05 Juillet 2025)
****************************************************************
* Description : 
Ce fichier reçoit les données du formulaire de recherche (envoyées par afficher.php) et :

Récupère les critères saisis (isbn, auteur, éditeur, année)

Forme une requête SQL en fonction de ce que l’utilisateur a tapé

Exécute la requête

Affiche les résultats dans un tableau
****************************************************************
* Historique des modifications
* 04-07-2025 : Création du fichier recherche.php pour la page
*
***************************************************************/ -->
<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "ict108");

if (!$conn) {
  echo "Connexion échouée.";
  exit();
}

// recupération des critères de recherche (GET)
$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : "";/**di l'utilisateur a saisi un donneé de nom ISBN, on la recurepre, dans le cas contraire, on laisse le cahmp vide */
$auteur = isset($_GET['auteur']) ? $_GET['auteur'] : "";/**ainsi de suite pour les autres critères */
$editeur = isset($_GET['editeur']) ? $_GET['editeur'] : "";
$annee = isset($_GET['annee']) ? $_GET['annee'] : "";

// requte sql qui permet de selectionner la totalité du tableau
$sql = "SELECT * FROM ouvrage";

$conditions = []; // tableau des conditions et definition de la variable de conditions 

if ($isbn != "") {
  $conditions[] = "isbn = '$isbn'"; /**si le contenu est non vide, on l'atribu au name correspondant */
}
if ($auteur != "") {
  $conditions[] = "auteur = '$auteur'";
}
if ($editeur != "") {
  $conditions[] = "editeur = '$editeur'";
}
if ($annee != "") {
  $conditions[] = "annee = '$annee'";
}

/**ici c,est la condition qui permet de direau code de fbriquer le tableau uniquement en fonction des champs remplis, verifiés par les conditions precedentes */
if (count($conditions) > 0) {
  $sql .= " WHERE " . implode(" AND ", $conditions);/**implode permet de trransformer un tableau en texte */
}

// Exécution de la requête
$resultat = mysqli_query($conn, $sql);

if (!$resultat) {
  echo "Erreur dans la requête.";
  exit();
}

// Compter le nombre de résultats
$nombre_resultats = mysqli_num_rows($resultat);

// Inclure le header pour avoir la navigation
include 'includes/header.php';

echo "<div class='card'>";
echo "<h1><i class='fas fa-search'></i> Résultats de la recherche</h1>";

if ($nombre_resultats > 0) {
    echo "<div class='alert alert-success'>";
    echo "<i class='fas fa-check-circle'></i>";
    echo "<strong>" . $nombre_resultats . "</strong> ouvrage(s) trouvé(s)";
    echo "</div>";
    
    echo "<div class='table-responsive'>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><i class='fas fa-barcode'></i> ISBN</th>";
    echo "<th><i class='fas fa-book'></i> Titre</th>";
    echo "<th><i class='fas fa-user-edit'></i> Auteur</th>";
    echo "<th><i class='fas fa-building'></i> Éditeur</th>";
    echo "<th><i class='far fa-calendar-alt'></i> Année</th>";
    echo "<th><i class='fas fa-image'></i> Couverture</th>";
    echo "<th><i class='fas fa-cogs'></i> Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($ligne = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td><code>" . htmlspecialchars($ligne['isbn']) . "</code></td>";
        echo "<td><strong>" . htmlspecialchars($ligne['titre']) . "</strong></td>";
        echo "<td>" . htmlspecialchars($ligne['auteur']) . "</td>";
        echo "<td>" . htmlspecialchars($ligne['editeur']) . "</td>";
        echo "<td><span class='badge'>" . htmlspecialchars($ligne['annee']) . "</span></td>";
        echo "<td>";
        echo "<img src='uploads/" . htmlspecialchars($ligne['couverture']) . "' alt='Couverture' class='book-cover-thumb'>";
        echo "</td>";
        echo "<td>";
        echo "<div class='action-buttons'>";
        echo "<a href='retirer.php?isbn=" . urlencode($ligne['isbn']) . "' class='btn btn-danger btn-sm' title='Supprimer'>";
        echo "<i class='fas fa-trash'></i>";
        echo "</a>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='alert alert-warning'>";
    echo "<i class='fas fa-exclamation-triangle'></i>";
    echo "<strong>Aucun résultat trouvé</strong> pour les critères de recherche spécifiés.";
    echo "</div>";
    
    echo "<div class='no-results'>";
    echo "<div class='no-results-icon'>";
    echo "<i class='fas fa-search'></i>";
    echo "</div>";
    echo "<h3>Essayez de :</h3>";
    echo "<ul>";
    echo "<li>Vérifier l'orthographe des termes de recherche</li>";
    echo "<li>Utiliser des termes plus généraux</li>";
    echo "<li>Réduire le nombre de critères de recherche</li>";
    echo "<li><a href='ajouter.php'>Ajouter un nouvel ouvrage</a></li>";
    echo "</ul>";
    echo "</div>";
}

echo "<div class='search-actions'>";
echo "<a href='afficher.php' class='btn btn-primary'>";
echo "<i class='fas fa-search'></i> Nouvelle recherche";
echo "</a>";
echo "<a href='index.php' class='btn btn-secondary'>";
echo "<i class='fas fa-home'></i> Retour à l'accueil";
echo "</a>";
echo "</div>";

echo "</div>";

?>

<style>
/* Styles spécifiques pour la page de recherche */
.book-cover-thumb {
    width: 50px;
    height: 70px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--neutral-200);
    transition: var(--transition-normal);
}

.book-cover-thumb:hover {
    transform: scale(1.1);
    box-shadow: var(--shadow-md);
}

.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    gap: var(--space-xs);
    justify-content: center;
}

.btn-sm {
    padding: var(--space-xs) var(--space-sm);
    font-size: 0.875rem;
    min-width: auto;
}

.search-actions {
    display: flex;
    gap: var(--space-md);
    justify-content: center;
    margin-top: var(--space-xl);
    padding-top: var(--space-lg);
    border-top: 1px solid var(--neutral-200);
}

.no-results {
    text-align: center;
    padding: var(--space-2xl);
    background: var(--neutral-50);
    border-radius: var(--radius-lg);
    margin: var(--space-lg) 0;
}

.no-results-icon {
    font-size: 4rem;
    color: var(--neutral-400);
    margin-bottom: var(--space-lg);
}

.no-results h3 {
    color: var(--neutral-700);
    margin-bottom: var(--space-md);
}

.no-results ul {
    list-style: none;
    padding: 0;
    max-width: 400px;
    margin: 0 auto;
}

.no-results li {
    padding: var(--space-sm);
    margin-bottom: var(--space-xs);
    background: white;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
}

.no-results li:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.no-results a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

.no-results a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

/* Amélioration des tableaux */
table thead th {
    position: sticky;
    top: 0;
    z-index: 10;
}

table tbody tr {
    transition: var(--transition-fast);
}

table tbody tr:hover {
    background: rgba(99, 102, 241, 0.05);
    transform: scale(1.01);
}

/* Responsive pour les tableaux */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .book-cover-thumb {
        width: 40px;
        height: 55px;
    }
    
    .search-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .search-actions .btn {
        width: 100%;
        max-width: 300px;
    }
}

/* Animation pour les résultats */
@keyframes fadeInResults {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-responsive {
    animation: fadeInResults 0.6s ease-out;
}

/* Code styling */
code {
    background: var(--neutral-100);
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    color: var(--primary-color);
    border: 1px solid var(--neutral-200);
}
</style>

<?php include 'includes/footer.php'; ?>