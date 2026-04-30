import Echo from 'laravel-echo';
import { useAuthStore } from '../stores/auth';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

// 1. Create a function to initialize Echo safely
export const initEcho = () => {
	// Check localStorage first
	let token = localStorage.getItem('token');

	// If not in storage, get it safely from the store
	if (!token) {
		const authStore = useAuthStore();
		token = authStore.token;
	}

	window.Echo = new Echo({
		broadcaster: 'reverb',
		key: import.meta.env.VITE_REVERB_APP_KEY,
		wsHost: import.meta.env.VITE_REVERB_HOST,
		wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
		wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
		forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
		enabledTransports: ['ws', 'wss'],
		authEndpoint: `${import.meta.env.VITE_API_URL}/broadcasting/auth`,
		auth: {
			headers: {
				Authorization: `Bearer ${token}`,
				Accept: 'application/json',
				'X-Requested-With': 'XMLHttpRequest'
			}
		}
	});
};
