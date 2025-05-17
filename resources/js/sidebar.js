document.addEventListener('DOMContentLoaded', function() {
    // Initialize dropdown toggles
    const dropdownToggles = document.querySelectorAll('[data-collapse-toggle]');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-collapse-toggle');
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.classList.toggle('hidden');
                
                // Toggle the aria-expanded attribute
                const isExpanded = targetElement.classList.contains('hidden') ? 'false' : 'true';
                this.setAttribute('aria-expanded', isExpanded);
                
                // Rotate the arrow icon
                const arrowIcon = this.querySelector('svg');
                if (arrowIcon) {
                    arrowIcon.classList.toggle('rotate-180');
                }
            }
        });
    });
    
    // Initialize mobile sidebar toggle
    const sidebarToggle = document.querySelector('[data-drawer-toggle="sidebar"]');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 768) { // Only on mobile
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        }
    });
});