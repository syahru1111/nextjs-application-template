// Main JavaScript for Dayah Ulumul Qur'an Website

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initHeader();
    initMobileMenu();
    initSlider();
    initScrollAnimations();
    initSmoothScroll();
    initLazyLoading();
    initFormValidation();
});

// Header scroll effect
function initHeader() {
    const header = document.querySelector('.header');
    if (!header) return;

    let lastScrollTop = 0;
    const scrollThreshold = 100;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Add/remove scrolled class
        if (scrollTop > scrollThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Hide/show header on scroll
        if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    });
}

// Mobile menu functionality
function initMobileMenu() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const nav = document.querySelector('.nav');
    
    if (!mobileToggle || !nav) return;

    mobileToggle.addEventListener('click', function() {
        mobileToggle.classList.toggle('active');
        nav.classList.toggle('active');
        
        // Prevent body scroll when menu is open
        if (nav.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });

    // Close menu when clicking on nav links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileToggle.classList.remove('active');
            nav.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!nav.contains(e.target) && !mobileToggle.contains(e.target)) {
            mobileToggle.classList.remove('active');
            nav.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

// Hero slider functionality
function initSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length === 0) return;

    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    // Auto-advance slides
    setInterval(nextSlide, slideInterval);

    // Initialize first slide
    showSlide(0);

    // Add slide indicators if needed
    createSlideIndicators();
}

function createSlideIndicators() {
    const slides = document.querySelectorAll('.hero-slide');
    const hero = document.querySelector('.hero');
    
    if (slides.length <= 1 || !hero) return;

    const indicatorsContainer = document.createElement('div');
    indicatorsContainer.className = 'slide-indicators';
    
    slides.forEach((_, index) => {
        const indicator = document.createElement('button');
        indicator.className = 'slide-indicator';
        indicator.setAttribute('data-slide', index);
        
        if (index === 0) indicator.classList.add('active');
        
        indicator.addEventListener('click', () => {
            showSlideByIndex(index);
        });
        
        indicatorsContainer.appendChild(indicator);
    });
    
    hero.appendChild(indicatorsContainer);
}

function showSlideByIndex(index) {
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });
    
    indicators.forEach((indicator, i) => {
        indicator.classList.toggle('active', i === index);
    });
}

// Scroll animations
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.card, .stat-card, .section-header');
    animateElements.forEach(el => observer.observe(el));
}

// Smooth scrolling for anchor links
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (!target) return;
            
            e.preventDefault();
            
            const headerHeight = document.querySelector('.header')?.offsetHeight || 0;
            const targetPosition = target.offsetTop - headerHeight - 20;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    });
}

// Lazy loading for images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        images.forEach(img => {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
        });
    }
}

// Form validation
function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
        
        // Real-time validation
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('input', () => clearFieldError(input));
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function validateField(field) {
    const value = field.value.trim();
    const type = field.type;
    let isValid = true;
    let message = '';
    
    // Required field validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        message = 'Field ini wajib diisi';
    }
    
    // Email validation
    else if (type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            message = 'Format email tidak valid';
        }
    }
    
    // Phone validation
    else if (field.name === 'phone' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        if (!phoneRegex.test(value) || value.length < 10) {
            isValid = false;
            message = 'Format nomor telepon tidak valid';
        }
    }
    
    // Password validation
    else if (type === 'password' && value) {
        if (value.length < 6) {
            isValid = false;
            message = 'Password minimal 6 karakter';
        }
    }
    
    // Show/hide error message
    showFieldError(field, isValid ? '' : message);
    
    return isValid;
}

function showFieldError(field, message) {
    clearFieldError(field);
    
    if (message) {
        field.classList.add('error');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;
        
        field.parentNode.appendChild(errorDiv);
    } else {
        field.classList.remove('error');
    }
}

function clearFieldError(field) {
    field.classList.remove('error');
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Loading state management
function showLoading(element) {
    if (element) {
        element.classList.add('loading');
        element.disabled = true;
    }
}

function hideLoading(element) {
    if (element) {
        element.classList.remove('loading');
        element.disabled = false;
    }
}

// Toast notifications
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 100);
    
    // Remove toast
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Modal functionality
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Initialize modal close buttons
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-close') || e.target.classList.contains('modal-overlay')) {
        const modal = e.target.closest('.modal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // Close modal with Escape key
    if (e.key === 'Escape') {
        const activeModal = document.querySelector('.modal.active');
        if (activeModal) {
            activeModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    // Close mobile menu with Escape key
    if (e.key === 'Escape') {
        const nav = document.querySelector('.nav.active');
        const toggle = document.querySelector('.mobile-menu-toggle.active');
        if (nav && toggle) {
            nav.classList.remove('active');
            toggle.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
});

// Performance optimization
window.addEventListener('load', function() {
    // Remove loading class from body
    document.body.classList.remove('loading');
    
    // Initialize performance-heavy features after load
    initAdvancedFeatures();
});

function initAdvancedFeatures() {
    // Add any performance-heavy initializations here
    console.log('Advanced features initialized');
}

// Export functions for use in other scripts
window.DayahWebsite = {
    showToast,
    openModal,
    closeModal,
    showLoading,
    hideLoading,
    validateForm,
    debounce,
    throttle
};
