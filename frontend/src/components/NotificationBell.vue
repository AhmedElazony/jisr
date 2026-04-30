<template>
	<div class="relative">
		<button
			:type="buttonType"
			@click="togglePanel"
			class="relative text-[#6B7280] hover:text-[#0CAB9A] transition"
			:class="buttonClasses"
		>
			<svg viewBox="0 0 24 24" :width="iconSize" :height="iconSize" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
				<path d="M13.73 21a2 2 0 0 1-3.46 0" />
			</svg>
			<span
				v-if="unreadCount"
				class="absolute top-0 right-0 h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"
			></span>
		</button>

		<div
			v-if="panelOpen"
			class="fixed inset-0 z-40"
			@click.self="closePanel"
		></div>

		<div
			v-if="panelOpen"
			class="z-50 overflow-hidden rounded-2xl border border-[#E5E7EB] bg-white shadow-xl"
			:class="panelClasses"
		>
			<div class="flex items-center justify-between border-b border-[#E5E7EB] px-4 py-3">
				<div>
					<div class="text-sm font-semibold text-[#111827]">الإشعارات</div>
					<div class="text-xs text-[#6B7280]">معاملات واردة جديدة</div>
				</div>
				<button class="text-xs font-semibold text-[#0CAB9A]" @click="markAllRead">تعيين الكل كمقروء</button>
			</div>

			<div v-if="notifications.length" class="max-h-80 overflow-y-auto">
				<button
					v-for="notification in notifications"
					:key="notification.id"
					@click="openNotification(notification)"
					class="flex w-full items-start gap-3 border-b border-[#F3F4F6] px-4 py-4 text-right transition last:border-0 hover:bg-[#F9FAFB]"
				>
					<div class="mt-1 h-2.5 w-2.5 rounded-full" :class="notification.isRead ? 'bg-[#D1D5DB]' : 'bg-red-500'"></div>
					<div class="flex-1">
						<div class="flex items-start justify-between gap-3">
							<div>
								<div class="text-sm font-semibold text-[#111827]">{{ notification.sender_name }}</div>
								<div class="text-xs text-[#6B7280]">{{ notification.message }}</div>
							</div>
							<div class="text-xs font-semibold text-[#0CAB9A]">
								{{ formattedAmount(notification.amount) }}
							</div>
						</div>
						<div class="mt-2 text-[11px] text-[#9CA3AF]">
							{{ formatDate(notification.created_at) }}
						</div>
					</div>
				</button>
			</div>

			<div v-else class="px-4 py-8 text-center text-sm text-[#6B7280]">
				لا توجد إشعارات جديدة
			</div>
		</div>
	</div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useNotificationsStore } from '../stores/notifications';

const props = defineProps({
	variant: {
		type: String,
		default: 'desktop'
	}
});

const router = useRouter();
const notificationsStore = useNotificationsStore();
const panelOpen = ref(false);

const notifications = computed(() => notificationsStore.notifications);
const unreadCount = computed(() => notificationsStore.unreadCount);

const iconSize = computed(() => (props.variant === 'mobile' ? 20 : 18));
const buttonType = 'button';

const buttonClasses = computed(() => {
	return props.variant === 'mobile' ? 'w-9 h-9 flex items-center justify-center' : '';
});

const panelClasses = computed(() => {
	if (props.variant === 'mobile') {
		return 'fixed top-16 left-4 right-4';
	}

	return 'absolute top-12 left-0 w-[22rem]';
});

const togglePanel = () => {
	panelOpen.value = !panelOpen.value;
};

const closePanel = () => {
	panelOpen.value = false;
};

const formattedAmount = (value) => {
	return Number(value ?? 0).toLocaleString('en-US', {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2
	});
};

const formatDate = (dateString) => {
	if (!dateString) {
		return 'الآن';
	}

	return new Date(dateString).toLocaleString('ar-EG', {
		month: 'short',
		day: 'numeric',
		hour: '2-digit',
		minute: '2-digit'
	});
};

const markAllRead = () => {
	notificationsStore.markAllAsRead();
};

const openNotification = (notification) => {
	notificationsStore.markAsRead(notification.id);
	panelOpen.value = false;
	router.push({ name: 'transaction-details', params: { id: notification.id } });
};
</script>