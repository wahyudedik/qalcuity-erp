import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// Log environment variables to debug
console.log('REVERB VARIABLES:', {
    key: import.meta.env.VITE_REVERB_APP_KEY,
    host: import.meta.env.VITE_REVERB_HOST,
    port: import.meta.env.VITE_REVERB_PORT,
    scheme: import.meta.env.VITE_REVERB_SCHEME
});

// Initialize Echo and expose a ready promise
const echoReadyPromise = new Promise((resolve) => {
    if (
        import.meta.env.VITE_REVERB_APP_KEY &&  
        import.meta.env.VITE_REVERB_HOST && 
        import.meta.env.VITE_REVERB_PORT
    ) {
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: import.meta.env.VITE_REVERB_APP_KEY,
            wsHost: import.meta.env.VITE_REVERB_HOST,
            wsPort: import.meta.env.VITE_REVERB_PORT,
            forceTLS: import.meta.env.VITE_REVERB_SCHEME === 'https',
            disableStats: true,
            enabledTransports: ['ws', 'wss'],
            cluster: 'mt1'
        });
        
        console.log('Echo initialized successfully');
        resolve(window.Echo);
    } else {
        console.error('Echo initialization failed: Missing environment variables', {
            key: import.meta.env.VITE_REVERB_APP_KEY,
            host: import.meta.env.VITE_REVERB_HOST,
            port: import.meta.env.VITE_REVERB_PORT,
            scheme: import.meta.env.VITE_REVERB_SCHEME
        });
        resolve(null);
    }
});

// Export the promise so scripts can wait for Echo to be ready
export default echoReadyPromise;