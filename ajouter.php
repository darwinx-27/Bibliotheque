<!-- /****************************************************************
* Projet : Gestion de la bibliothèque
* Code PHP : ajouter.php
****************************************************************
* Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
<charles.kamga@facsciences-uy1.cm>
* Auteur 2 : KEUBENG TSASSE ESTEL GABREL
<estel.keubeng@facsciences-uy1.cm>
* Auteur 3 : KOUOGANG LENY ROUSSEL
<leny.kouogang@facsciences-uy1.cm>
* ...
****************************************************************
* Date de création : 04-07-2025 (04 Juillet 2025)
* Dernière modification : 05-07-2025 (05 Juillet 2025)
****************************************************************
* Description : 
Formulaire de réception des données d'ajout dans le formulaire via POST
****************************************************************
* Historique des modifications
* 04-07-2025 : Création du fichier ajouter.php pour la page
* 05-07-2025 : Ajout des commentaires
* 05-07-2025 : Mise à jour avec le design moderne
***************************************************************/ -->

<?php include 'includes/header.php'; ?>

<div class="card">
    <h1><i class="fas fa-plus-circle"></i> Ajouter un livre</h1>
    <p class="lead">Remplissez le formulaire ci-dessous pour ajouter un nouvel ouvrage à la bibliothèque</p>
    
    <form action="enregistrement.php" method="post" enctype="multipart/form-data" class="modern-form">
        <div class="form-row">
            <div class="form-group">
                <label for="isbn"><i class="fas fa-barcode"></i> Numéro ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-control" required 
                       placeholder="Ex: 978-1234567890" pattern="[0-9-]{10,20}">
                <small class="form-help">Format: 978-1234567890 ou 1234567890</small>
            </div>
            
            <div class="form-group">
                <label for="titre"><i class="fas fa-book"></i> Titre de l'ouvrage</label>
                <input type="text" id="titre" name="titre" class="form-control" required 
                       placeholder="Entrez le titre de l'ouvrage" maxlength="255">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="auteur"><i class="fas fa-user-edit"></i> Auteur</label>
                <input type="text" id="auteur" name="auteur" class="form-control" required 
                       placeholder="Nom de l'auteur" maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="editeur"><i class="fas fa-building"></i> Éditeur</label>
                <input type="text" id="editeur" name="editeur" class="form-control" required 
                       placeholder="Nom de l'éditeur" maxlength="255">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="annee"><i class="far fa-calendar-alt"></i> Année de parution</label>
                <input type="number" id="annee" name="annee" class="form-control" required 
                       placeholder="Ex: 2023" min="1000" max="2100">
            </div>
            
            <div class="form-group">
                <label for="couverture"><i class="fas fa-image"></i> Photo de couverture</label>
                <input type="file" id="couverture" name="couverture" class="form-control" 
                       accept="image/jpeg,image/png,image/gif" onchange="previewImage(this)">
                <small class="form-help">Formats acceptés: JPG, PNG, GIF (max 5MB)</small>
            </div>
        </div>
        
        <div class="form-group">
            <label for="description"><i class="fas fa-align-left"></i> Description</label>
            <textarea name="description" id="description" class="form-control" 
                      placeholder="Entrez une description de l'ouvrage" rows="4" maxlength="1000"></textarea>
            <small class="form-help">Description optionnelle de l'ouvrage (max 1000 caractères)</small>
        </div>
        
        <!-- Aperçu de l'image -->
        <div class="form-group" id="image-preview" style="display: none;">
            <label><i class="fas fa-eye"></i> Aperçu de l'image</label>
            <div class="image-preview-container">
                <img id="preview-img" src="" alt="Aperçu" class="preview-image">
                <button type="button" class="btn btn-secondary btn-sm" onclick="removePreview()">
                    <i class="fas fa-times"></i> Supprimer
                </button>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter l'ouvrage
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

.form-help {
    display: block;
    margin-top: var(--space-xs);
    font-size: 0.875rem;
    color: var(--neutral-500);
    font-style: italic;
}

.image-preview-container {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    margin-top: var(--space-sm);
    padding: var(--space-md);
    background: var(--neutral-50);
    border-radius: var(--radius-lg);
    border: 2px dashed var(--neutral-300);
}

.preview-image {
    width: 120px;
    height: 160px;
    object-fit: cover;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    border: 2px solid var(--neutral-200);
}

.btn-sm {
    padding: var(--space-sm) var(--space-md);
    font-size: 0.875rem;
    min-width: auto;
}

/* Animation pour l'aperçu d'image */
#image-preview {
    animation: slideInUp 0.3s ease-out;
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

/* Responsive pour les formulaires */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .image-preview-container {
        flex-direction: column;
    text-align: center;
    }
    
    .preview-image {
        width: 100px;
        height: 140px;
    }
  }
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function removePreview() {
    const preview = document.getElementById('image-preview');
    const fileInput = document.getElementById('couverture');
    
    preview.style.display = 'none';
    fileInput.value = '';
}

// Validation en temps réel
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.modern-form');
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        inputs.forEach(input => {
            if (!validateField(input)) {
                isValid = false;
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showToast('Veuillez corriger les erreurs dans le formulaire', 'error');
        }
    });
});

function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let message = '';
    
    // Supprimer les anciens messages d'erreur
    const existingError = field.parentElement.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    field.classList.remove('error');
    
    // Validation selon le type de champ
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        message = 'Ce champ est obligatoire';
    } else if (field.type === 'email' && value && !isValidEmail(value)) {
        isValid = false;
        message = 'Format d\'email invalide';
    } else if (field.type === 'number' && value) {
        const num = parseInt(value);
        const min = parseInt(field.getAttribute('min'));
        const max = parseInt(field.getAttribute('max'));
        
        if (min && num < min) {
            isValid = false;
            message = `La valeur doit être supérieure à ${min}`;
        } else if (max && num > max) {
            isValid = false;
            message = `La valeur doit être inférieure à ${max}`;
        }
    } else if (field.pattern && value && !new RegExp(field.pattern).test(value)) {
        isValid = false;
        message = 'Format invalide';
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

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
</script>

<?php include 'includes/footer.php'; ?>