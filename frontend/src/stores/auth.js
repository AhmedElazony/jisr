import { defineStore } from 'pinia'
import api from '../services/api'

export const useAuthStore = defineStore('auth', {
	state: () => ({
		user: {
			id: null,
			name: '',
			jisr_email: '',
			phone: '',
			country: '',
			wallet_balance: '',
			currency: '',
			countryFlag: ''
		},
		token: '1|qvnVU3p500thi3VQfOTAxBibScmEwZgjF1ejMNhb7ae7b631' // Temporary token for development
	}),
	actions: {
		setAuth(payload) {
			this.user = payload.user || this.user
			this.token = payload.token || ''
		},
		setUser(user) {
			this.user = user
		},
		setToken(token) {
			this.token = token
		},
		async bootstrap() {
			const storedUser = localStorage.getItem('user');
			const storedToken = localStorage.getItem('token');

			if (storedToken) {
				this.token = storedToken;
			}

			if (storedUser) {
				try {
					this.user = JSON.parse(storedUser);
					return;
				} catch {
				}
			}

			if (!storedToken && this.token) {
				localStorage.setItem('token', this.token);
			}

			try {
				const currencies = {
					EG: 'EGP',
					SA: 'SAR',
					AE: 'AED',
					KW: 'KWD',
					JO: 'JOD',
					MA: 'MAD'
				};
				const countryFlags = {
					SA: '🇸🇦',
					EG: '🇪🇬',
					AE: '🇦🇪',
					KW: '🇰🇼',
					JO: '🇯🇴',
					MA: '🇲🇦'
				};
				const response = await api.get('/me');
				const user = response?.data?.data?.user;
				user.currency = currencies[user.country] || 'EGP';
				user.countryFlag = countryFlags[user.country] || '';

				if (user) {
					this.user = user;
					localStorage.setItem('user', JSON.stringify(user));
				}
			} catch (error) {
			}
		},
		logout() {
			this.user = {
				id: null,
				name: '',
				jisr_email: '',
				phone: '',
				country: '',
				currency: '',
				wallet_balance: '',
				countryFlag: ''
			}
			this.token = ''
		}
	}
})