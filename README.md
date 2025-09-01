# 📚 Gestion de Bibliothèque - Projet de Groupe

## 🎯 Description

Application web moderne développée en **PHP** par un groupe d'étudiants pour la gestion complète d'une bibliothèque avec interface responsive et design sophistiqué.

## ✨ Fonctionnalités

### 🔍 Gestion des Ouvrages
- **Ajout** : Formulaire complet avec upload d'images et validation en temps réel
- **Recherche** : Multi-critères (ISBN, auteur, éditeur, année) avec résultats stylisés
- **Affichage** : Tableaux interactifs avec couvertures et actions rapides
- **Suppression** : Interface sécurisée avec aperçu d'ouvrage et confirmation

### 🎨 Interface Moderne
- **Design System** avec variables CSS et animations fluides
- **Navigation hamburger** responsive pour mobile
- **Footer élégant** avec crédits développeur
- **Thème gradient** moderne (bleu-violet)
- **Animations** : fadeIn, slideIn, hover effects

## 🛠️ Technologies

### Backend
- **PHP 7+** : Logique métier et gestion des données
- **MySQL** : Base de données relationnelle
- **Architecture modulaire** avec includes PHP

### Frontend
- **HTML5** : Structure sémantique et accessibilité
- **CSS3** : Variables CSS, flexbox/grid, animations
- **JavaScript ES6+** : Interactions et validation en temps réel
- **FontAwesome** : Icônes de l'interface

### Design
- **Responsive** : Mobile-first avec breakpoints optimisés
- **CSS Variables** : Système de design cohérent
- **Animations** : Transitions fluides et micro-interactions

## 🚀 Installation

### Prérequis
- Serveur web (Apache/Nginx)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Extensions PHP : mysqli, gd

### Étapes d'installation

1. **Cloner le projet**
   ```bash
   git clone [URL_DU_REPO]
   cd GROUPE10
   ```

2. **Configurer la base de données**
   ```bash
   # Importer la structure et les données
   mysql -u root -p < ouvrages_db.sql
   ```

3. **Configurer la connexion**
   ```bash
   # Modifier config/database.php si nécessaire
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'ict108');
   ```

4. **Configurer les permissions**
   ```bash
   # Rendre le dossier uploads accessible en écriture
   chmod 755 uploads/
   ```

5. **Accéder à l'application**
   ```
   http://localhost/GROUPE10/
   ```

## 📁 Structure du Projet

```
GROUPE10/
├── config/
│   └── database.php          # Configuration BDD
├── css/
│   └── style.css             # Styles principaux
├── includes/
│   ├── header.php            # En-tête commun
│   └── footer.php            # Pied de page commun
├── images/
│   └── whatsapp_bg.jpeg      # Image de fond
├── uploads/                   # Stockage des couvertures
├── index.php                  # Page d'accueil
├── ajouter.php               # Formulaire d'ajout
├── enregistrement.php        # Traitement d'ajout
├── afficher.php              # Interface de recherche
├── recherche.php             # Traitement de recherche
├── retirer.php               # Formulaire de suppression
├── suppression.php           # Traitement de suppression
├── ouvrages_db.sql           # Structure BDD + données
└── README.md                 # Ce fichier
```

## 🗄️ Base de Données

### Table `ouvrage`
```sql
CREATE TABLE ouvrage (
    isbn VARCHAR(20) PRIMARY KEY,
    titre VARCHAR(255),
    auteur VARCHAR(255),
    editeur VARCHAR(255),
    annee INT,
    description TEXT,
    couverture VARCHAR(255)
);
```

### Données initiales
- **25 ouvrages** de littérature africaine pré-chargés
- **Auteurs célèbres** : Camara Laye, Mariama Bâ, Ahmadou Kourouma
- **Genres variés** : Romans, essais, poésie

## 🔒 Sécurité

### Protection contre les injections SQL
- **Requêtes préparées** dans tous les formulaires
- **Validation des entrées** côté client et serveur
- **Échappement HTML** avec `htmlspecialchars()`

### Upload sécurisé
- **Validation des types MIME** des images
- **Limitation des formats** : JPG, PNG, GIF
- **Noms de fichiers uniques** pour éviter les conflits

## 📱 Responsive Design

### Breakpoints
- **Desktop** : 1024px et plus
- **Tablette** : 768px - 1023px
- **Mobile** : 480px - 767px
- **Petit mobile** : Moins de 480px

### Navigation mobile
- **Menu hamburger** avec animation
- **Overlay** pour fermer le menu
- **Navigation tactile** optimisée

## 🎨 Design System

### Couleurs
- **Primaire** : #6366f1 (indigo)
- **Secondaire** : #10b981 (vert)
- **Accent** : #f59e0b (orange)
- **Neutres** : Palette de gris de 50 à 900

### Espacements
- **Variables CSS** : --space-xs à --space-2xl
- **Système cohérent** sur toutes les pages
- **Responsive** selon la taille d'écran

### Animations
- **Transitions** : 0.15s, 0.3s, 0.5s
- **Keyframes** : fadeIn, slideIn, bounce
- **Hover effects** : transform, shadow, color

## 🧪 Fonctionnalités Avancées

### Validation en temps réel
- **Feedback immédiat** sur les formulaires
- **Messages d'erreur** contextuels
- **États visuels** : valid, invalid, focused

### Aperçu d'images
- **Prévisualisation** avant upload
- **Suppression** facile des images
- **Validation** des types de fichiers

### Toast notifications
- **Messages de succès/erreur** temporaires
- **Types variés** : success, error, warning, info
- **Auto-dismiss** après 3 secondes

## 🚧 Développement

### Auteurs du Projet
- **KAMGA MUKAM CHARLES CYRILLE** - Chef de projet
- **KEUBENG TSASSE ESTEL GABREL** - Développement backend
- **KOULAI FANTIO NATHANAEL** - Interface utilisateur
- **KENGNE TSHIENEGHOM THERESE VIANNEY** - Base de données
- **Et autres membres du groupe**

### Historique des versions
- **v1.0.0** (04-07-2025) : Version initiale
- **v1.1.0** (05-07-2025) : Ajout des commentaires
- **v1.2.0** (05-07-2025) : Design moderne et responsive

## 🔮 Évolutions Futures

### Fonctionnalités prévues
- **Système d'authentification** utilisateur
- **Gestion des emprunts** et retours
- **API REST** pour l'intégration
- **Recherche avancée** avec filtres
- **Statistiques** et rapports

### Améliorations techniques
- **Composer** pour la gestion des dépendances
- **Tests automatisés** avec PHPUnit
- **CI/CD** avec GitHub Actions
- **Docker** pour le déploiement

## 📞 Support

### Contact
- **Développeur principal** : Charles Kamga
- **Portfolio** : [https://charleskamga.onrender.com](https://charleskamga.onrender.com)
- **Email** : charles.kamga@facsciences-uy1.cm

### Contribution
Les contributions sont les bienvenues ! N'hésitez pas à :
- Signaler des bugs
- Proposer des améliorations
- Soumettre des pull requests

## 📄 Licence

Ce projet est développé dans le cadre d'un cours universitaire. Tous droits réservés.

---

**Développé avec ❤️ par le Groupe 10 - Université de Yaoundé I**
