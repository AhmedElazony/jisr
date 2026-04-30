import { defineStore } from 'pinia';

const STORAGE_KEY = 'jisr_notifications';

const readStoredNotifications = () => {
	try {
		return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
	} catch {
		return [];
	}
};

const persistNotifications = (notifications) => {
	localStorage.setItem(STORAGE_KEY, JSON.stringify(notifications));
};

const buildSummary = (payload) => {
	const amount = Number(payload.amount ?? 0);
	const formattedAmount = amount.toLocaleString('en-US', {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2
	});

	return {
		id: String(payload.id),
		transaction_id: payload.reference_code,
		amount: payload.amount,
		sender_id: payload.sender_id,
		sender_name: payload.sender_name || 'مستخدم',
		sender_email: payload.sender_email || '',
		receiver_id: payload.receiver_id,
		created_at: payload.created_at,
		isRead: false,
		title: 'معاملة واردة جديدة',
		message: `استلمت تحويلًا بقيمة ${formattedAmount}`
	};
};

export const useNotificationsStore = defineStore('notifications', {
	state: () => ({
		notifications: readStoredNotifications()
	}),
	getters: {
		unreadCount: (state) => state.notifications.filter((notification) => !notification.isRead).length,
		latestNotification: (state) => state.notifications[0] || null,
		getById: (state) => {
			return (id) => state.notifications.find((notification) => String(notification.id) === String(id)) || null;
		}
	},
	actions: {
		hydrate() {
			this.notifications = readStoredNotifications();
		},
		persist() {
			persistNotifications(this.notifications);
		},
		addNotification(payload) {
			if (!payload?.id) {
				return;
			}

			const nextNotification = buildSummary(payload);
			const existingIndex = this.notifications.findIndex((notification) => String(notification.id) === String(nextNotification.id));

			if (existingIndex >= 0) {
				this.notifications.splice(existingIndex, 1, {
					...this.notifications[existingIndex],
					...nextNotification
				});
			} else {
				this.notifications.unshift(nextNotification);
			}

			this.persist();
		},
		markAsRead(id) {
			const notification = this.notifications.find((item) => String(item.id) === String(id));
			if (!notification) {
				return;
			}

			notification.isRead = true;
			this.persist();
		},
		markAllAsRead() {
			this.notifications = this.notifications.map((notification) => ({
				...notification,
				isRead: true
			}));
			this.persist();
		},
		clear() {
			this.notifications = [];
			this.persist();
		}
	}
});