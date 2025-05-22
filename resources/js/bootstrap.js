import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import Echo jika diperlukan
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Setup Echo dengan Pusher jika konfigurasi tersedia
const pusherKey = import.meta.env.VITE_PUSHER_APP_KEY || '';
const pusherCluster = import.meta.env.VITE_PUSHER_APP_CLUSTER || '';

if (pusherKey && pusherCluster) {
    window.Pusher = Pusher; 
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: pusherKey,
        cluster: pusherCluster,
        forceTLS: true
    });
} else {
    // Echo mock jika konfigurasi tidak tersedia
    window.Echo = {
        private: () => ({ listen: () => {} }),
        channel: () => ({ listen: () => {} }),
        join: () => ({
            listen: () => {},
            here: () => {},
            joining: () => {},
            leaving: () => {},
            error: () => {}
        })
    };
}
