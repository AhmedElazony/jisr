import { onBeforeUnmount, watch } from 'vue';
import '../services/echo';
import { useAuthStore } from '../stores/auth';
import { useNotificationsStore } from '../stores/notifications';

const channelNameForUser = (userId) => `transaction.user.${userId}`;

export const useTransactionBroadcasts = () => {
	const auth = useAuthStore();
	const notifications = useNotificationsStore();
	let subscribedUserId = null;

	const unsubscribe = (userId) => {
		if (!window.Echo || userId === null || userId === undefined) {
			return;
		}

		window.Echo.leave(channelNameForUser(userId));
	};

	const subscribe = (userId) => {
		if (!window.Echo || !userId) {
			return;
		}

		window.Echo.private(channelNameForUser(userId)).listen('.transaction.sent', (payload) => {
			notifications.addNotification(payload);
			auth.refreshUser();
		});
	};

	watch(
		() => auth.user?.id,
		(userId, previousUserId) => {
			if (previousUserId && previousUserId !== userId) {
				unsubscribe(previousUserId);
			}

			if (userId && userId !== subscribedUserId) {
				subscribedUserId = userId;
				subscribe(userId);
			}
		},
		{ immediate: true }
	);

	onBeforeUnmount(() => {
		if (subscribedUserId) {
			unsubscribe(subscribedUserId);
		}
	});
};