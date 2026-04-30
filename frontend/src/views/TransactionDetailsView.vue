<template>
	<div class="min-h-screen md:min-h-[calc(100vh-73px)] bg-[#EEF4F5]" dir="rtl">
		<div class="px-4 pt-6 pb-28 md:mr-60 md:px-8 md:pt-10 md:pb-8">
			<div class="mx-auto w-full max-w-2xl">
				<div class="mb-5 flex items-center justify-between md:mb-6">
					<div>
						<h1 class="text-2xl font-bold text-[#111827]">تفاصيل المعاملة</h1>
						<p class="text-sm text-[#6B7280] mt-1">إشعار التحويل المستلم</p>
					</div>
					<button @click="router.back()" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#374151]">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
							<polyline points="15 18 9 12 15 6" />
						</svg>
					</button>
				</div>

				<AppCard>
					<div class="space-y-4">
						<div class="flex items-center justify-between border-b border-[#E5E7EB] pb-4">
							<div>
								<div class="text-sm text-[#6B7280]">رقم المرجع</div>
								<div class="font-semibold text-[#111827]">{{ notification?.transaction_id || route.params.id }}</div>
							</div>
							<div class="rounded-full bg-[#E8F7F3] px-3 py-1 text-xs font-semibold text-[#0CAB9A]">مستلمة</div>
						</div>

						<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
							<div class="rounded-2xl bg-[#F9FAFB] p-4">
								<div class="text-xs text-[#6B7280]">اسم المرسل</div>
								<div class="mt-1 text-base font-semibold text-[#111827]">{{ notification?.sender_name || '—' }}</div>
							</div>
							<div class="rounded-2xl bg-[#F9FAFB] p-4">
								<div class="text-xs text-[#6B7280]">بريد المرسل</div>
								<div class="mt-1 text-base font-semibold text-[#111827] break-all">{{ notification?.sender_email || '—' }}</div>
							</div>
							<div class="rounded-2xl bg-[#F9FAFB] p-4">
								<div class="text-xs text-[#6B7280]">المبلغ</div>
								<div class="mt-1 text-base font-semibold text-[#111827]">{{ formattedAmount }}</div>
							</div>
							<div class="rounded-2xl bg-[#F9FAFB] p-4">
								<div class="text-xs text-[#6B7280]">تاريخ الإرسال</div>
								<div class="mt-1 text-base font-semibold text-[#111827]">{{ formattedDate }}</div>
							</div>
						</div>

						<div class="rounded-2xl border border-[#E0F7F4] bg-[#F0FFFE] p-4 text-sm text-[#0A8F7F]">
							تم استلام إشعار تحويل جديد من {{ notification?.sender_name || 'مستخدم' }}.
						</div>
					</div>
				</AppCard>
			</div>
		</div>
	</div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import AppCard from '../components/AppCard.vue';
import { useNotificationsStore } from '../stores/notifications';

const route = useRoute();
const router = useRouter();
const notificationsStore = useNotificationsStore();

const notification = computed(() => notificationsStore.getById(route.params.id));

const formattedAmount = computed(() => {
	return Number(notification.value?.amount ?? 0).toLocaleString('en-US', {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2
	});
});

const formattedDate = computed(() => {
	const dateString = notification.value?.created_at;
	if (!dateString) {
		return '—';
	}

	return new Date(dateString).toLocaleString('ar-EG', {
		year: 'numeric',
		month: 'long',
		day: '2-digit',
		hour: '2-digit',
		minute: '2-digit'
	});
});
</script>