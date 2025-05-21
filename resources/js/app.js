import './bootstrap';
import 'flowbite';
import './sidebar';
import './dark-mode';

// import alpinejs
import Alpine from 'alpinejs'; 
window.Alpine = Alpine;
Alpine.start();

// import choices.js
import Choices from 'choices.js';
window.Choices = Choices;  

// Simple polling for notifications
function setupNotificationPolling() {
    // Only run this if user is logged in
    const notificationButton = document.querySelector('[data-dropdown-toggle="notification-dropdown"]');
    if (!notificationButton) {
        return;
    }
    
    // Check for new notifications every 30 seconds
    setInterval(function() {
        fetch('/notifications/json')
            .then(response => response.json())
            .then(data => {
                // Update notification badge
                updateNotificationBadge(data.unreadCount);
                
                // Optionally refresh notification dropdown content if open
                const dropdown = document.getElementById('notification-dropdown');
                if (dropdown && !dropdown.classList.contains('hidden')) {
                    // Could refresh dropdown content here
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }, 30000); // 30 seconds
}

function updateNotificationBadge(count) {
    const button = document.querySelector('[data-dropdown-toggle="notification-dropdown"]');
    if (!button) return;
    
    // Remove existing badge if any
    const existingBadge = button.querySelector('.bg-red-500');
    if (existingBadge) {
        existingBadge.remove();
    }
    
    // Add new badge if count > 0
    if (count > 0) {
        const badge = document.createElement('div');
        badge.className = 'absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-1 dark:border-gray-900';
        badge.textContent = count > 9 ? '9+' : count;
        button.appendChild(badge);
    }
}

// Initialize polling when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    setupNotificationPolling();
});
