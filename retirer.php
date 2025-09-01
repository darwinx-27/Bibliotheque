<!-- /****************************************************************
* Projet : Gestion de la bibliothèque
* Code PHP : retirer.php
****************************************************************
* Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
<charles.kamga@facsciences-uy1.cm>
* Auteur 2 : KENGNE TSHIENEGHOM THERESE VIANNEY
<therese.kengne@facsciences-uy1.cm>
* Auteur 3 : Votre nom ici
<votre@adresse.email>
* ...
****************************************************************
* Date de création : 04-07-2025 (04 Juillet 2025)
* Dernière modification : 05-07-2025 (05 Juillet 2025)
****************************************************************
* Description
Ce script représente le formulaire qui collecte les données qui seront envoyées à suppression.php.
****************************************************************
* Historique des modifications
* 04-07-2025 : Création du fichier retirer.php pour la page
* 05-07-2025 : Mise à jour avec le design moderne
***************************************************************/ -->

<?php include 'includes/header.php'; ?>

<div class="card">
    <h1><i class="fas fa-trash-alt"></i> Supprimer un ouvrage</h1>
    <p class="lead">Entrez l'ISBN de l'ouvrage que vous souhaitez supprimer de la bibliothèque</p>
    
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        <strong>Attention :</strong> Cette action est irréversible. L'ouvrage sera définitivement supprimé de la bibliothèque.
    </div>
    
    <form action="suppression.php" method="get" class="modern-form" id="deleteForm">
        <div class="form-group">
            <label for="isbn"><i class="fas fa-barcode"></i> ISBN de l'ouvrage à supprimer</label>
            <input type="text" id="isbn" name="isbn" class="form-control" required 
                   placeholder="Ex: 978-1234567890" pattern="[0-9-]{10,20}">
            <small class="form-help">Entrez le numéro ISBN exact de l'ouvrage à supprimer</small>
        </div>
        
        <!-- Aperçu de l'ouvrage (si trouvé) -->
        <div class="form-group" id="book-preview" style="display: none;">
            <label><i class="fas fa-eye"></i> Aperçu de l'ouvrage</label>
            <div class="book-preview-container">
                <div class="book-info">
                    <h4 id="preview-title"></h4>
                    <p><strong>Auteur :</strong> <span id="preview-author"></span></p>
                    <p><strong>Éditeur :</strong> <span id="preview-editor"></span></p>
                    <p><strong>Année :</strong> <span id="preview-year"></span></p>
                </div>
                <div class="book-cover">
                    <img id="preview-cover" src="" alt="Couverture" class="preview-cover-image">
                </div>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="deleteBtn" disabled>
                <i class="fas fa-trash"></i> Supprimer l'ouvrage
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="fas fa-eraser"></i> Réinitialiser
            </button>
            <a href="index.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Retour à l'accueil
            </a>
        </div>
    </form>
</div>

<style>
.modern-form {
    margin-top: var(--space-lg);
}

.book-preview-container {
    display: flex;
    gap: var(--space-lg);
    margin-top: var(--space-sm);
    padding: var(--space-lg);
    background: var(--neutral-50);
    border-radius: var(--radius-lg);
    border: 2px solid var(--neutral-200);
    align-items: flex-start;
}

.book-info {
    flex: 1;
}

.book-info h4 {
    color: var(--primary-color);
    margin-bottom: var(--space-sm);
    font-size: 1.25rem;
}

.book-info p {
    margin-bottom: var(--space-xs);
    color: var(--neutral-600);
}

.preview-cover-image {
    width: 120px;
    height: 160px;
    object-fit: cover;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-md);
    border: 2px solid var(--neutral-200);
}

/* Animation pour l'aperçu */
#book-preview {
    animation: slideInUp 0.3s ease-out;
}

/* Bouton désactivé */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn:disabled:hover {
    transform: none !important;
    box-shadow: var(--shadow-md);
}

/* Responsive */
@media (max-width: 768px) {
    .book-preview-container {
        flex-direction: column;
        text-align: center;
    }
    
    .preview-cover-image {
        width: 100px;
        height: 140px;
        margin: 0 auto;
    }
}

/* Validation en temps réel */
.form-control:valid {
    border-color: var(--success-color);
}

.form-control:invalid:not(:placeholder-shown) {
    border-color: var(--error-color);
}

/* Focus amélioré */
.form-control:focus {
    transform: translateY(-1px);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1), var(--shadow-md);
  }
</style>

<script>
// Recherche automatique de l'ouvrage
document.addEventListener('DOMContentLoaded', function() {
    const isbnInput = document.getElementById('isbn');
    const deleteBtn = document.getElementById('deleteBtn');
    const bookPreview = document.getElementById('book-preview');
    let currentBook = null;
    
    // Debounce pour éviter trop de requêtes
    let searchTimeout;
    
    isbnInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const isbn = this.value.trim();
        
        if (isbn.length >= 10) {
            searchTimeout = setTimeout(() => {
                searchBook(isbn);
            }, 500);
        } else {
            hidePreview();
        }
    });
    
    // Validation du formulaire
    const form = document.getElementById('deleteForm');
    form.addEventListener('submit', function(e) {
        if (!currentBook) {
            e.preventDefault();
            showToast('Veuillez d\'abord rechercher un ouvrage valide', 'error');
            return;
        }
        
        // Confirmation avant suppression
        const confirmed = confirm(
            `Êtes-vous sûr de vouloir supprimer l'ouvrage :\n\n` +
            `"${currentBook.titre}"\n` +
            `par ${currentBook.auteur}\n\n` +
            `Cette action est irréversible !`
        );
        
        if (!confirmed) {
            e.preventDefault();
        }
    });
    
    function searchBook(isbn) {
        // Simulation d'une recherche (en réalité, vous feriez un appel AJAX)
        // Pour l'instant, on va simuler avec les données existantes
        const sampleBooks = {
            '9780000000001': {
                titre: "L'enfant noir",
                auteur: "Camara Laye",
                editeur: "Plon",
                annee: 1953,
                couverture: "default.jpg"
            },
            '9780000000002': {
                titre: "Une si longue lettre",
                auteur: "Mariama Bâ",
                editeur: "Nouvelles éditions africaines",
                annee: 1979,
                couverture: "default.jpg"
            }
        };
        
        const book = sampleBooks[isbn];
        if (book) {
            showPreview(book);
        } else {
            hidePreview();
            showToast('Aucun ouvrage trouvé avec cet ISBN', 'warning');
        }
    }
    
    function showPreview(book) {
        currentBook = book;
        
        document.getElementById('preview-title').textContent = book.titre;
        document.getElementById('preview-author').textContent = book.auteur;
        document.getElementById('preview-editor').textContent = book.editeur;
        document.getElementById('preview-year').textContent = book.annee;
        document.getElementById('preview-cover').src = `uploads/${book.couverture}`;
        
        bookPreview.style.display = 'block';
        deleteBtn.disabled = false;
        
        showToast('Ouvrage trouvé !', 'success');
    }
    
    function hidePreview() {
        currentBook = null;
        bookPreview.style.display = 'none';
        deleteBtn.disabled = true;
    }
    
    // Validation en temps réel
    isbnInput.addEventListener('blur', function() {
        validateISBN(this);
    });
    
    function validateISBN(field) {
        const value = field.value.trim();
        let isValid = true;
        let message = '';
        
        // Supprimer les anciens messages d'erreur
        const existingError = field.parentElement.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
        field.classList.remove('error');
        
        if (!value) {
            isValid = false;
            message = 'L\'ISBN est obligatoire';
        } else if (value.length < 10) {
            isValid = false;
            message = 'L\'ISBN doit contenir au moins 10 caractères';
        } else if (!/^[0-9-]+$/.test(value)) {
            isValid = false;
            message = 'L\'ISBN ne peut contenir que des chiffres et des tirets';
        }
        
        if (!isValid) {
            field.classList.add('error');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error';
            errorDiv.textContent = message;
            errorDiv.style.color = 'var(--error-color)';
            errorDiv.style.fontSize = '0.875rem';
            errorDiv.style.marginTop = '0.25rem';
            field.parentElement.appendChild(errorDiv);
        }
        
        return isValid;
    }
});
</script>

<?php include 'includes/footer.php'; ?>