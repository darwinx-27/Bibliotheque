    </main>
    <footer class="footer">
        <div class="footer-content">
        <p>&copy; <?= date('Y') ?> Gestion de Bibliothèque - Tous droits réservés</p>
            <div class="footer-author">
                <p>Développé par <a href="https://charleskamga.onrender.com" target="_blank" rel="noopener noreferrer" class="author-link">Charles Kamga</a></p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts modernes pour l'expérience utilisateur -->
    <script>
        // Gestion de la navigation active et scroll
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = location.pathname.split('/').pop() || 'index.php';
            const navLinks = document.querySelectorAll('.nav-link');
            const navMain = document.querySelector('.nav-main');
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const navMenu = document.getElementById('navMenu');
            const navOverlay = document.getElementById('navOverlay');
            
            // Navigation active
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
            
            // Gestion du menu hamburger
            function toggleMenu() {
                const isOpen = navMenu.classList.contains('active');
                
                if (isOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            }
            
            function openMenu() {
                navMenu.classList.add('active');
                navOverlay.classList.add('active');
                hamburgerBtn.classList.add('active');
                document.body.style.overflow = 'hidden'; // Empêcher le scroll
            }
            
            function closeMenu() {
                navMenu.classList.remove('active');
                navOverlay.classList.remove('active');
                hamburgerBtn.classList.remove('active');
                document.body.style.overflow = ''; // Restaurer le scroll
            }
            
            // Événements pour le menu hamburger
            hamburgerBtn.addEventListener('click', toggleMenu);
            
            // Fermer le menu en cliquant sur l'overlay
            navOverlay.addEventListener('click', closeMenu);
            
            // Fermer le menu en cliquant sur un lien
            navLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });
            
            // Fermer le menu avec la touche Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeMenu();
                }
            });
            
            // Effet de scroll sur la navigation
            window.addEventListener('scroll', () => {
                if (window.scrollY > 100) {
                    navMain.classList.add('scrolled');
                } else {
                    navMain.classList.remove('scrolled');
                }
            });
            
            // Animation des cartes au scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Observer toutes les cartes
            document.querySelectorAll('.card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(card);
            });
            
            // Animation des boutons
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
                
                btn.addEventListener('click', function() {
                    // Effet de ripple
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = event.clientX - rect.left - size / 2;
                    const y = event.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Animation des statistiques
            const stats = document.querySelectorAll('.stat-item');
            if (stats.length > 0) {
                const statsObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.animation = 'bounce 0.6s ease-out';
                        }
                    });
                }, { threshold: 0.5 });
                
                stats.forEach(stat => statsObserver.observe(stat));
            }
            
            // Amélioration des formulaires
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
            
            // Animation des tableaux
            document.querySelectorAll('table tbody tr').forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                row.style.transition = `opacity 0.3s ease-out ${index * 0.1}s, transform 0.3s ease-out ${index * 0.1}s`;
                
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 100 + index * 50);
            });
            
            // Smooth scroll pour les ancres
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Toast notifications
            window.showToast = function(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.innerHTML = `
                    <div class="toast-content">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `;
                
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);
                
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            };
            
            // Auto-hide pour les messages d'alerte
            document.querySelectorAll('.alert').forEach(alert => {
                if (!alert.classList.contains('alert-persistent')) {
                    setTimeout(() => {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateX(100%)';
                        setTimeout(() => alert.remove(), 300);
                    }, 5000);
                }
            });
        });
        
        // Gestion des erreurs globales
        window.addEventListener('error', function(e) {
            console.error('Erreur JavaScript:', e.error);
        });
        
        // Service Worker pour le cache (optionnel)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered'))
                    .catch(error => console.log('SW registration failed'));
            });
        }
    </script>
    
    <!-- Styles pour les animations JavaScript -->
    <style>
        /* Ripple effect pour les boutons */
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* Toast notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            padding: var(--space-md) var(--space-lg);
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease-out;
            z-index: 10000;
            max-width: 350px;
            border-left: 4px solid var(--primary-color);
        }
        
        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        .toast-content {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }
        
        .toast-success { border-left-color: var(--success-color); }
        .toast-error { border-left-color: var(--error-color); }
        .toast-warning { border-left-color: var(--warning-color); }
        .toast-info { border-left-color: var(--info-color); }
        
        .toast i {
            font-size: 1.2rem;
        }
        
        .toast-success i { color: var(--success-color); }
        .toast-error i { color: var(--error-color); }
        .toast-warning i { color: var(--warning-color); }
        .toast-info i { color: var(--info-color); }
        
        /* Focus states améliorés */
        .form-group.focused label {
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        /* Animations d'entrée pour les éléments */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .slide-in-left {
            animation: slideInLeft 0.6s ease-out;
        }
        
        .slide-in-right {
            animation: slideInRight 0.6s ease-out;
        }
        
        .slide-in-up {
            animation: slideInUp 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Hover effects améliorés */
        .card:hover .card::before {
            transform: scaleX(1);
        }
        
        .stat-item:hover i {
            animation: bounce 0.6s ease-out;
        }
        
        /* Loading states */
        .btn.loading {
            pointer-events: none;
        }
        
        .btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 16px;
            margin: -8px 0 0 -8px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        /* Responsive toast */
        @media (max-width: 768px) {
            .toast {
                top: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    </style>
</body>
</html>
