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
    
    // Initial load of notifications
    fetchNotifications();
    
    // Check for new notifications every 10 seconds
    setInterval(fetchNotifications, 10000); // 10 seconds
}

function fetchNotifications() {
    fetch('/notifications/json')
        .then(response => response.json())
        .then(data => {
            // Update notification badge
            updateNotificationBadge(data.unreadCount);
            
            // Optionally refresh notification dropdown content
            refreshNotificationDropdown(data.notifications);
        })
        .catch(error => console.error('Error fetching notifications:', error));
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

function refreshNotificationDropdown(notifications) {
    const dropdown = document.getElementById('notification-dropdown');
    if (!dropdown) return;
    
    // Only update if dropdown is visible
    if (dropdown.classList.contains('hidden')) return;
    
    // Find the container for notifications
    const container = dropdown.querySelector('.divide-y.divide-gray-100');
    if (!container) return;
    
    // Clear existing notifications
    container.innerHTML = '';
    
    if (notifications.length === 0) {
        container.innerHTML = `
            <div class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                <div class="w-full text-center py-4 text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada notifikasi
                </div>
            </div>
        `;
        return;
    }
    
    // Create HTML for each notification
    notifications.forEach(notification => {
        const isRead = notification.is_read;
        const icon = notification.icon || 'default';
        
        let iconHtml = '';
        if (icon === 'pdf') {
            iconHtml = `<div class="rounded-full w-11 h-11 flex items-center justify-center bg-red-100 dark:bg-red-900">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5zm2.25 7.5a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75zm0 3a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75z"/>
                </svg>
            </div>`;
        } else if (icon === 'excel') {
            iconHtml = `<div class="rounded-full w-11 h-11 flex items-center justify-center bg-green-100 dark:bg-green-900">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                    <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                    <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                </svg>
            </div>`;
        } else if (icon === 'error') {
            iconHtml = `<div class="rounded-full w-11 h-11 flex items-center justify-center bg-red-100 dark:bg-red-900">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
            </div>`;
        } else {
            iconHtml = `<div class="rounded-full w-11 h-11 flex items-center justify-center bg-blue-100 dark:bg-blue-900">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a.5.5 0 0 0 .753 0L12.7 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
                </svg>
            </div>`;
        }
        
        const notificationHtml = `
            <div class="notification-item ${isRead ? 'bg-white' : 'bg-blue-50'} dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <a href="/notifications/download/${notification.id}" class="flex px-4 py-3" data-notification-id="${notification.id}">
                    <div class="flex-shrink-0">
                        ${iconHtml}
                    </div>
                    <div class="w-full pl-3">
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">${notification.message}</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">
                            ${notification.time}
                        </div>
                    </div>
                </a>
                <button class="mark-read-btn absolute top-3 right-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" 
                        data-notification-id="${notification.id}" title="Tandai sebagai dibaca">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', notificationHtml);
    });
}

// Initialize polling when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    setupNotificationPolling();
});
