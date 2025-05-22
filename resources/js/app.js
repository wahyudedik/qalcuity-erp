import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs'; 

// Initialize Alpine.js 
window.Alpine = Alpine;

// Define default Alpine data
document.addEventListener('alpine:init', () => {
    Alpine.data('appLayout', () => ({
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        rightSidebarOpen: false,
        activeModule: localStorage.getItem('activeModule') || 'dashboard',
        
        init() {
            this.$watch('sidebarCollapsed', (value) => {
                localStorage.setItem('sidebarCollapsed', value);
            });
            
            this.$watch('activeModule', (value) => {
                localStorage.setItem('activeModule', value);
            });
        }
    }));
});

Alpine.start();

// Initialize 3rd party libraries
import Choices from 'choices.js'; 
window.Choices = Choices;

// Notification system
const notificationSystem = {
    init() {
        this.setupEventListeners();
        this.initialFetch();
    },

    initialFetch() {
        if (!document.querySelector('[data-dropdown-toggle="notification-dropdown"]')) {
            return;
        }
        
        this.fetchNotifications();
        setInterval(() => this.fetchNotifications(), 30000); // Check every 30 seconds
    },

    fetchNotifications() {
        fetch('/notifications/json')
            .then(response => response.json())
            .then(data => {
                this.updateBadge(data.unreadCount);
            })
            .catch(error => console.error('Error fetching notifications:', error));
    },

    updateBadge(count) {
        const button = document.querySelector('[data-dropdown-toggle="notification-dropdown"]');
        if (!button) return;
        
        const existingBadge = button.querySelector('.bg-red-500');
        if (existingBadge) {
            existingBadge.remove();
        }
        
        if (count > 0) {
            const badge = document.createElement('div');
            badge.className = 'absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-1 dark:border-gray-900';
            badge.textContent = count > 9 ? '9+' : count;
            button.appendChild(badge);
        }
    },

    setupEventListeners() {
        document.addEventListener('click', (e) => {
            // Mark individual notification as read
            if (e.target.closest('.mark-read-btn')) {
                const btn = e.target.closest('.mark-read-btn');
                const id = btn.dataset.notificationId;
                this.markAsRead(id);
            }

            // Mark all as read
            if (e.target.closest('#mark-all-read')) {
                this.markAllAsRead();
            }
        });
    },

    markAsRead(id) {
        fetch(`/notifications/mark-as-read/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(() => this.fetchNotifications())
        .catch(error => console.error('Error marking notification as read:', error));
    },

    markAllAsRead() {
        fetch('/notifications/mark-all-as-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(() => this.fetchNotifications())
        .catch(error => console.error('Error marking all notifications as read:', error));
    }
};

// Initialize dark mode handler
const darkModeHandler = {
    init() {
        // Set initial state based on localStorage or system preference
        if (localStorage.getItem('color-theme') === 'dark' || 
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            this.showLightIcon();
        } else {
            document.documentElement.classList.remove('dark');
            this.showDarkIcon();
        }

        // Set up event listener for toggle button
        const themeToggleBtn = document.getElementById('theme-toggle');
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => this.toggleTheme());
        }
    },

    showDarkIcon() {
        document.getElementById('theme-toggle-dark-icon').classList.remove('hidden');
        document.getElementById('theme-toggle-light-icon').classList.add('hidden');
    },

    showLightIcon() {
        document.getElementById('theme-toggle-dark-icon').classList.add('hidden');
        document.getElementById('theme-toggle-light-icon').classList.remove('hidden');
    },

    toggleTheme() {
        // Toggle icons
        document.getElementById('theme-toggle-dark-icon').classList.toggle('hidden');
        document.getElementById('theme-toggle-light-icon').classList.toggle('hidden');

        // Toggle theme
        if (localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
};

// Initialize functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    notificationSystem.init();
    darkModeHandler.init();
    
    // Module search functionality
    const moduleSearch = document.getElementById('module-search');
    if (moduleSearch) {
        moduleSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.module-card').forEach(card => {
                const moduleName = card.querySelector('.module-name')?.textContent.toLowerCase();
                if (moduleName && moduleName.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
    
    // Mobile sidebar toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const alpineData = Alpine.getRoot(document.body).$data;
            if (alpineData.sidebarCollapsed !== undefined) {
                alpineData.sidebarCollapsed = !alpineData.sidebarCollapsed;
            }
        });
    }
});
