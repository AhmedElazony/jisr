<template>
	<div class="min-h-screen md:min-h-[calc(100vh-73px)] bg-[#EEF4F5]" dir="rtl">
		<!-- Mobile Header -->
		<header
			class="md:hidden bg-white border-b border-[#E5E7EB] px-4 py-3 flex items-center justify-between sticky top-0 z-20">
			<div class="flex items-center gap-2">
				<div
					class="w-9 h-9 rounded-full bg-[#E8F7F3] overflow-hidden flex items-center justify-center text-[#0CAB9A]">
					<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
						<path
							d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
					</svg>
				</div>
				<div class="text-sm font-semibold text-[#111827]">{{ userName }}</div>
			</div>
			<div class="text-xl font-bold text-[#0CAB9A] tracking-tight">جسر</div>
			<NotificationBell variant="mobile" />
		</header>

		<!-- Mobile Content -->
		<section class="md:hidden px-4 pt-5 pb-28 space-y-4">
			<!-- Balance Card -->
			<div class="bg-white rounded-2xl shadow-sm p-5 flex items-start justify-between">
				<div>
					<div class="text-xs text-[#6B7280] mb-1">الرصيد المتاح</div>
					<div class="text-3xl font-bold text-[#111827] tracking-tight">{{ formattedBalance }}</div>
					<div class="text-xs text-[#6B7280] mt-0.5">{{ currency }}</div>
				</div>
				<button class="text-[#6B7280] hover:text-[#0CAB9A] transition mt-1">
					<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
						<circle cx="12" cy="12" r="3" />
					</svg>
				</button>
			</div>

			<!-- Send Button -->
			<button @click="goToSend" class="btn-gradient">
				<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
					<line x1="22" y1="2" x2="11" y2="13" />
					<polygon points="22 2 15 22 11 13 2 9 22 2" />
				</svg>
				<span>إرسال أموال</span>
			</button>

			<!-- Transactions Header -->
			<div class="flex items-center justify-between mt-2 px-1">
				<h2 class="text-sm font-bold text-[#111827]">المعاملات الأخيرة</h2>
				<a href="#" class="text-xs text-[#0CAB9A] font-semibold">عرض الكل</a>
			</div>

			<div class="space-y-3">
				<div v-for="tx in mobileTransactions" :key="tx.id"
					class="bg-white rounded-2xl shadow-sm p-4 flex items-center justify-between">
					<div class="flex items-center gap-3">
						<div
							class="w-10 h-10 rounded-full bg-[#E8F7F3] text-[#0CAB9A] flex items-center justify-center font-bold text-sm">
							{{ tx.initials }}
						</div>
						<div>
							<div class="text-sm font-semibold text-[#111827]">{{ tx.name }}</div>
							<div class="text-xs text-[#6B7280]">{{ tx.time }}</div>
						</div>
					</div>
					<div class="text-left">
						<div class="text-sm font-semibold text-[#111827]">{{ tx.amount }}</div>
						<div class="text-xs text-[#0CAB9A] font-semibold">{{ tx.status }}</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Desktop Content -->
		<div class="hidden md:block mr-60 px-8 py-6">
			<div class="flex gap-6 mt-2">
				<!-- Balance Gradient Card -->
				<div class="flex-1 bg-gradient-to-l from-[#0CAB9A] to-[#2563EB] rounded-3xl p-7 text-white shadow-lg">
					<div class="flex items-start gap-4">
						<div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
							<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="white" stroke-width="2">
								<rect x="3" y="3" width="18" height="18" rx="3" />
								<path d="M3 9h18M9 21V9" />
							</svg>
						</div>
						<div>
							<div class="text-sm opacity-80">الرصيد المتاح</div>
							<div class="text-4xl font-bold tracking-tight mt-1">{{ formattedBalance }}</div>
							<div class="text-sm opacity-80 mt-1">{{ currency }}</div>
						</div>
					</div>
					<div class="flex gap-3 mt-6">
						<button disabled title="قريبا"
							class="flex-1 bg-white text-[#0CAB9A] rounded-full py-3 font-bold text-sm hover:opacity-90 transition flex items-center justify-center gap-2">
							<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
								stroke-width="2">
								<line x1="12" y1="5" x2="12" y2="19" />
								<line x1="5" y1="12" x2="19" y2="12" />
							</svg>
							إضافة محفظة
						</button>

						<button @click="goToSend"
							class="flex-1 bg-white/20 text-white rounded-full py-3 font-bold text-sm border border-white/30 hover:bg-white/30 transition flex items-center justify-center gap-2">
							<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
								stroke-width="2">
								<line x1="22" y1="2" x2="11" y2="13" />
								<polygon points="22 2 15 22 11 13 2 9 22 2" />
							</svg>
							إرسال
						</button>
					</div>
				</div>

				<!-- Send Money Card -->
				<div
					class="w-[280px] bg-white rounded-2xl shadow-sm p-6 text-center flex flex-col items-center justify-center">
					<div
						class="w-14 h-14 rounded-2xl bg-[#E8F7F3] text-[#0CAB9A] flex items-center justify-center mb-4">
						<svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor"
							stroke-width="1.8">
							<line x1="22" y1="2" x2="11" y2="13" />
							<polygon points="22 2 15 22 11 13 2 9 22 2" />
						</svg>
					</div>
					<h3 class="text-base font-bold text-[#111827]">إرسال أموال</h3>
					<p class="text-xs text-[#6B7280] mt-1 mb-5">تحويل فوري للمحافظ المحلية</p>
					<button @click="goToSend" class="btn-gradient text-sm py-3">
						ابدأ الآن
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"
							stroke-width="2.5">
							<polyline points="15 18 9 12 15 6" />
						</svg>
					</button>
				</div>
			</div>

			<!-- Transactions Table -->
			<div class="mt-6 bg-white rounded-2xl shadow-sm overflow-hidden">
				<div class="flex items-center justify-between px-6 py-4 border-b border-[#E5E7EB]">
					<div class="font-bold text-[#111827]">العمليات الأخيرة</div>
					<a href="#" class="text-sm text-[#0CAB9A] font-semibold">عرض الكل</a>
				</div>
				<div class="grid grid-cols-4 px-6 py-3 text-xs text-[#6B7280] bg-[#F9FAFB] border-b border-[#E5E7EB]">
					<div>الطرف الآخر</div>
					<div>التاريخ</div>
					<div>الحالة</div>
					<div class="text-left">المبلغ</div>
				</div>
				<div v-for="tx in desktopTransactions" :key="tx.id"
					class="grid grid-cols-4 px-6 py-4 text-sm border-b last:border-0 items-center hover:bg-[#F9FAFB] transition">
					<div class="flex items-center gap-3">
						<div
							class="w-9 h-9 rounded-full bg-[#E8F7F3] text-[#0CAB9A] flex items-center justify-center text-xs font-bold">
							{{ tx.initials }}
						</div>
						<div>
							<div class="font-semibold text-[#111827]">{{ tx.name }}</div>
							<div class="text-xs text-[#6B7280]">{{ tx.sub }}</div>
						</div>
					</div>
					<div class="text-[#6B7280]">{{ tx.date }}</div>
					<div>
						<span :class="tx.statusClass"
							class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium">
							<span :class="tx.dotClass" class="w-1.5 h-1.5 rounded-full"></span>
							{{ tx.status }}
						</span>
					</div>
					<div class="text-left font-semibold" :class="tx.amountClass">{{ tx.amount }}</div>
				</div>
			</div>
		</div>


	</div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import NotificationBell from '../components/NotificationBell.vue';
import api from '../services/api';

const router = useRouter();

const currencyByCountry = {
  EG: 'EGP',
  SA: 'SAR',
  AE: 'AED',
  KW: 'KWD',
  JO: 'JOD',
  MA: 'MAD'
};

const user = computed(() => {
  try {
    return JSON.parse(localStorage.getItem('user') || '{}');
  } catch {
    return {};
  }
});

const userName = computed(() => user.value.name || '—');
const walletBalance = computed(() => Number(user.value.wallet_balance ?? 0));
const formattedBalance = computed(() =>
  walletBalance.value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
);
const currency = computed(() => currencyByCountry[user.value.country] || 'EGP');

const goToSend = () => router.push({ name: 'send' });

const mobileTransactions = ref([]);
const desktopTransactions = ref([]);
const loadingTransactions = ref(true);

const fetchTransactions = async () => {
    loadingTransactions.value = true;
    try {
        const response = await api.get('/transactions/history');
        const transactions = response?.data?.data || [];
        
        const formatted = transactions.map(tx => ({
            id: tx.reference_code,
            name: tx.type == 'received' ? tx.sender_name : tx.receiver_full_name,
            initials: tx.receiver_full_name.split(' ')[0].charAt(0).toUpperCase(),
            time: formatTime(tx.created_at),
            amount: tx.type == 'received' ? `+ ${tx.amount} ${tx.currency}` : `-${tx.amount} ${tx.currency}`,
            status: 'مكتمل',
            sub: tx.reason,
            date: formatDate(tx.created_at),
            statusClass: 'bg-[#E8F7F3] text-[#0CAB9A]',
            dotClass: 'bg-[#0CAB9A]',
            amountClass: 'text-[#374151]'
        }));
        
        mobileTransactions.value = formatted;
        desktopTransactions.value = formatted;
    } catch (error) {
        console.error('Failed to fetch transactions:', error);
        mobileTransactions.value = [];
        desktopTransactions.value = [];
    } finally {
        loadingTransactions.value = false;
    }
};

const formatTime = (dateString) => {
    const date = new Date(dateString);
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);
    
    if (date.toDateString() === today.toDateString()) {
        return `اليوم ${date.toLocaleTimeString('ar-EG', { hour: '2-digit', minute: '2-digit' })}`;
    } else if (date.toDateString() === yesterday.toDateString()) {
        return 'أمس';
    } else {
        return date.toLocaleDateString('ar-EG');
    }
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('ar-EG', { year: 'numeric', month: 'long', day: '2-digit' });
};

onMounted(() => {
    fetchTransactions();
});


</script>