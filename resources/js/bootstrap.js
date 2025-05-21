import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

// import './echo';  

// Jika menggunakan Event Broadcasting
// Import Echo
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Cek apakah konfigurasi Pusher tersedia
const pusherKey = import.meta.env.VITE_PUSHER_APP_KEY || '';
const pusherCluster = import.meta.env.VITE_PUSHER_APP_CLUSTER || '';

if (pusherKey && pusherCluster) {
    // Setup Pusher dan Echo
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: pusherKey,
        cluster: pusherCluster,
        forceTLS: true
    });
} else {
    // Mock Echo jika konfigurasi Pusher tidak tersedia
    console.warn('Pusher configuration missing. Using mock Echo object.');
    window.Echo = {
        private: () => ({
            listen: () => {}
        }),
        channel: () => ({
            listen: () => {}
        }),
        join: () => ({
            listen: () => {},
            here: () => {},
            joining: () => {},
            leaving: () => {},
            error: () => {}
        })
    };
}
