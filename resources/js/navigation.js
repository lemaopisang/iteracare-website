// Simple navigation debounce to prevent double-clicking issues
document.addEventListener('DOMContentLoaded', function() {
    let isNavigating = false;
    
    // Add click handlers to all navigation links
    const navLinks = document.querySelectorAll('nav a, .nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (isNavigating) {
                e.preventDefault();
                return false;
            }
            
            isNavigating = true;
            
            // Reset after 1 second
            setTimeout(() => {
                isNavigating = false;
            }, 1000);
        });
    });
    
    // Add visual feedback for better UX
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            this.style.opacity = '0.7';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 200);
        });
    });
});

