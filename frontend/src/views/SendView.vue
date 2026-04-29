<template>
	<div class="min-h-screen md:min-h-[calc(100vh-73px)] bg-[#F4F8F8] flex flex-col" dir="rtl">
		<!-- Mobile Header -->
		<header class="bg-white border-b border-[#E5E7EB] px-4 py-4 flex items-center justify-between md:hidden">
			<div class="w-9 h-9 rounded-full bg-[#E8F7F3] flex items-center justify-center text-[#0CAB9A]">
				<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
					<path
						d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
				</svg>
			</div>
			<div class="text-lg font-bold text-[#0CAB9A]">جسر</div>
			<button @click="router.back()"
				class="w-9 h-9 rounded-full bg-[#F3F4F6] flex items-center justify-center text-[#374151]">
				<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
					<polyline points="9 18 15 12 9 6" />
				</svg>
			</button>
		</header>

		<div class="flex flex-1 md:mr-0">
			<!-- Main Content -->
			<main class="flex-1 md:mr-60 flex flex-col">
				<!-- Page content wrapper -->
				<div class="flex-1 px-4 md:px-0 md:flex md:items-start md:justify-center md:pt-10">
					<div class="w-full md:max-w-2xl md:bg-white md:rounded-2xl md:shadow-sm md:overflow-hidden">

						<!-- Desktop page title -->
						<div class="hidden md:block px-8 pt-8 pb-4 border-b border-[#E5E7EB]">
							<h1 class="text-2xl font-bold text-[#111827]">إرسال أموال</h1>
							<p class="text-sm text-[#6B7280] mt-1">مركز التحويلات الدولي</p>
						</div>

						<!-- Mobile page title -->
						<div class="md:hidden pt-6 pb-2">
							<h1 class="text-xl font-bold text-[#111827]">إرسال أموال</h1>
							<p class="text-sm text-[#6B7280] mt-1">أدخل رقم هاتف المستلم</p>
						</div>

						<div
							class="md:px-8 md:py-6 pb-32 space-y-6 md:grid md:grid-cols-2 md:gap-6 md:space-y-0 md:pb-8">
							<!-- Recipient Details (desktop: right col) -->
							<div class="md:order-1 space-y-5 pt-6 md:pt-0">
								<div class="text-sm font-semibold text-[#374151] flex items-center gap-2">
									<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#0CAB9A"
										stroke-width="2">
										<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
										<circle cx="12" cy="7" r="4" />
									</svg>
									تفاصيل المستلم
								</div>

								<!-- Phone Input -->
								<div>
									<label class="block text-xs text-[#6B7280] mb-2">رقم الهاتف الجوال</label>
									<div class="flex gap-2 bg-white rounded-xl border border-[#E5E7EB] overflow-hidden">
										<select v-model="selectedCode" @change="onCountryChange(selectedCode)"
											class="px-3 py-3.5 text-sm font-medium bg-transparent border-none outline-none min-w-[110px] shrink-0 text-[#374151]">
											<option value="">اختر...</option>
											<option v-for="w in wallets" :key="w.dialCode" :value="w.dialCode">
												{{ w.flag }} {{ w.dialCode }}
											</option>
										</select>
										<div class="w-px bg-[#E5E7EB] my-3"></div>
										<input v-model="phone" type="tel" placeholder="100 123 4567"
											class="flex-1 min-w-0 w-full px-3 py-3.5 text-sm bg-transparent border-none outline-none placeholder-[#9CA3AF]" />
									</div>
									<!-- Detected wallet badge -->
									<div v-if="detectedWallet"
										class="mt-2 flex items-center gap-2 px-3 py-2 bg-[#E8F7F3] rounded-lg">
										<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#0CAB9A"
											stroke-width="2">
											<rect x="1" y="4" width="22" height="16" rx="2" />
											<line x1="1" y1="10" x2="23" y2="10" />
										</svg>
										<span class="text-xs text-[#0CAB9A] font-medium">تم التعرف على المحفظة: {{
											detectedWallet.name }}</span>
									</div>
								</div>

								<!-- Detected recipient card -->
								<div v-if="detectedRecipient"
									class="bg-[#F0FFFE] rounded-xl border border-[#B2EBE7] p-4">
									<div class="text-xs text-[#6B7280] mb-2">المستلم المكتشف</div>
									<div class="flex items-center justify-between">
										<div class="flex items-center gap-3">
											<div
												class="w-9 h-9 rounded-full bg-[#0CAB9A] flex items-center justify-center text-white font-bold text-sm">
												A</div>
											<div>
												<div class="font-semibold text-sm text-[#111827]">Ali</div>
												<div class="text-xs text-[#6B7280]">{{ selectedCode }} {{ phone }}</div>
											</div>
										</div>
										<div class="flex items-center gap-1 text-xs text-[#0CAB9A] font-semibold">
											<svg viewBox="0 0 24 24" width="14" height="14" fill="none"
												stroke="currentColor" stroke-width="2.5">
												<polyline points="20 6 9 17 4 12" />
											</svg>
											موثق
										</div>
									</div>
								</div>

								<!-- Full name -->
								<div class="block">
									<label class="block text-xs text-[#6B7280] mb-2">الاسم الكامل للمستلم (كما في
										الهوية)</label>
									<input v-model="receiverName" type="text" placeholder="الاسم الرباعي"
										class="w-full px-4 py-3.5 rounded-xl border border-[#E5E7EB] bg-white text-sm outline-none focus:border-[#0CAB9A] transition placeholder-[#9CA3AF]" />
								</div>

								<!-- Purpose -->
								<div class="block">
									<label class="block text-xs text-[#6B7280] mb-2">الغرض من التحويل</label>
									<div class="relative">
										<select v-model="purpose"
											class="w-full px-4 py-3.5 rounded-xl border border-[#E5E7EB] bg-white text-sm outline-none focus:border-[#0CAB9A] transition appearance-none text-[#374151]">
											<option value="">اختر الغرض...</option>
											<option value="family">دعم العائلة</option>
											<option value="bills">سداد فواتير</option>
											<option value="savings">مدخرات</option>
											<option value="other">أخرى</option>
										</select>
										<svg class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
											viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#9CA3AF"
											stroke-width="2">
											<polyline points="6 9 12 15 18 9" />
										</svg>
									</div>
								</div>
							</div>

							<!-- Amount Panel (desktop: left col) -->
							<div class="md:order-2 space-y-4">
								<div
									class="text-sm font-semibold text-[#374151] flex items-center gap-2 hidden md:flex">
									<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#0CAB9A"
										stroke-width="2">
										<rect x="1" y="4" width="22" height="16" rx="2" />
										<line x1="1" y1="10" x2="23" y2="10" />
									</svg>
									المبلغ
								</div>

								<!-- Amount card -->
								<div
									class="bg-[#F4F8F8] md:bg-white md:border md:border-[#E5E7EB] rounded-2xl p-5 space-y-4">
									<div class="text-xs text-[#6B7280]">أنت ترسل</div>
									<div class="flex items-center gap-3">
										<div
											class="flex items-center gap-2 px-3 py-2 bg-white rounded-lg border border-[#E5E7EB]">
											<span class="text-base">{{ senderFlag }}</span>
											<span class="text-sm font-bold text-[#374151]">{{ senderCurrency }}</span>
										</div>
										<input v-model="sendAmount" type="number" min="0" step="0.01" placeholder="0.00"
											class="text-3xl font-bold text-[#111827] tracking-tight w-full bg-transparent outline-none" />
									</div>

									<!-- Exchange info -->
									<div class="space-y-2.5 pt-2 border-t border-[#E5E7EB]">
										<div class="flex justify-between items-center text-sm">
											<span class="text-[#6B7280] flex items-center gap-1.5">
												<svg viewBox="0 0 24 24" width="14" height="14" fill="none"
													stroke="currentColor" stroke-width="2">
													<polyline points="17 1 21 5 17 9" />
													<path d="M3 11V9a4 4 0 0 1 4-4h14" />
													<polyline points="7 23 3 19 7 15" />
													<path d="M21 13v2a4 4 0 0 1-4 4H3" />
												</svg>
												سعر الصرف
											</span>
											<span class="font-semibold text-[#374151]">
												1 {{ senderCurrency }} = {{ rateDisplay }} {{ receiverCurrency || '—' }}
											</span>
										</div>
										<div class="flex justify-between items-center text-sm">
											<span class="text-[#6B7280]">رسوم التحويل</span>
											<span class="font-semibold text-[#0CAB9A]">{{ feeDisplay }}</span>
										</div>
										<div class="flex justify-between items-center text-sm">
											<span class="text-[#6B7280]">وقت الوصول المتوقع</span>
											<span class="font-semibold text-[#374151]">فوري</span>
										</div>
									</div>

									<!-- Recipient gets -->
									<div
										class="bg-white md:bg-[#F4F8F8] rounded-xl p-4 flex justify-between items-center border border-[#E5E7EB] md:border-[#E8F7F3]">
										<span class="text-sm text-[#6B7280]">المستلم يحصل على</span>
										<div class="flex items-center gap-2">
											<span class="font-bold text-[#111827]">
												{{ receiverCurrency || '—' }} {{ receiverAmount }}
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Confirm Button (desktop) -->
						<div class="hidden md:block px-8 pb-8">
							<button @click="goToReview" :disabled="!isValid"
								class="btn-gradient disabled:opacity-40 disabled:cursor-not-allowed">
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
									stroke-width="2.5">
									<polyline points="15 18 9 12 15 6" />
								</svg>
								استمرار
							</button>
							<p class="text-center text-xs text-[#9CA3AF] mt-3 flex items-center justify-center gap-1">
								<svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor"
									stroke-width="2">
									<rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
									<path d="M7 11V7a5 5 0 0 1 10 0v4" />
								</svg>
								معاملة أمنة ومشفرة بالكامل
							</p>
						</div>
					</div>
				</div>

				<!-- Mobile Continue Button -->
				<div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-[#E5E7EB] px-4 py-4 z-50">
					<button @click="goToReview" :disabled="!isValid"
						class="btn-gradient disabled:opacity-40 disabled:cursor-not-allowed">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
							stroke-width="2.5">
							<polyline points="15 18 9 12 15 6" />
						</svg>
						استمرار
					</button>
				</div>
			</main>
		</div>
	</div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useTransferStore } from '../stores/transfer';
import { useAuthStore } from '../stores/auth';
import api from '../services/api';

const router = useRouter();
const transferStore = useTransferStore();
const authStore = useAuthStore();

const phone = ref('');
const receiverName = ref('');
const selectedCode = ref('');
const purpose = ref('');
const sendAmount = ref('');

const wallets = ref([]);
const isLoading = ref(true);
const errorMessage = ref('');

const currencyFlags = {
	SAR: '🇸🇦',
	EGP: '🇪🇬',
	AED: '🇦🇪',
	KWD: '🇰🇼',
	JOD: '🇯🇴',
	MAD: '🇲🇦'
};

const currencyByCountry = {
	EG: 'EGP',
	SA: 'SAR',
	AE: 'AED',
	KW: 'KWD',
	JO: 'JOD',
	MA: 'MAD'
};

const senderCurrency = computed(() => currencyByCountry[authStore.user?.country] || 'SAR');
const senderFlag = computed(() => currencyFlags[senderCurrency.value] || '💸');

const detectedWallet = computed(() => {
	if (!selectedCode.value) return null;
	return wallets.value.find(w => w.dialCode === selectedCode.value) || null;
});

const receiverCurrency = computed(() => detectedWallet.value?.currency || '');

const rate = ref(0);
const fee = ref(0);
const convertedAmount = ref('0.00');

const rateDisplay = computed(() => (rate.value ? rate.value.toFixed(3) : '—'));
const feeDisplay = computed(() => (fee.value ? `${fee.value} ${senderCurrency.value}` : 'مجاناً'));
const receiverAmount = computed(() => convertedAmount.value);

const detectedRecipient = computed(() => phone.value.length > 5 && selectedCode.value);

const isValid = computed(() => {
	return selectedCode.value && phone.value.length > 5 && parseFloat(sendAmount.value) > 0;
});

const loadWallets = async () => {
	isLoading.value = true;
	errorMessage.value = '';
	try {
		const response = await api.get('/wallets');
		const items = response?.data?.data || [];
		wallets.value = items.map(item => ({
			id: item.id,
			dialCode: item.dial_code,
			flag: item.flag,
			country: item.country,
			name: item.name,
			currency: item.currency
		}));
	} catch (error) {
		errorMessage.value = 'تعذر تحميل المحافظ المدعومة حالياً.';
		wallets.value = [];
	} finally {
		isLoading.value = false;
	}
};

const convertAmount = async () => {
	if (!sendAmount.value || parseFloat(sendAmount.value) <= 0 || !receiverCurrency.value) {
		rate.value = 0;
		convertedAmount.value = '0.00';
		transferStore.setDestinationAmount('0.00');
		return;
	}

	try {
		const response = await api.post('/currency/convert', {
			amount: parseFloat(sendAmount.value),
			from: senderCurrency.value,
			to: receiverCurrency.value
		});

		const data = response?.data?.data;
		if (data) {
			rate.value = Number(data.exchange_rate || 0);
			convertedAmount.value = Number(data.converted_amount || 0).toFixed(2);
			fee.value = 0;

			transferStore.setPricing({
				rate: rate.value,
				fee: fee.value,
				receiverCurrency: receiverCurrency.value
			});
			transferStore.setDestinationAmount(convertedAmount.value);
		}
	} catch (error) {
		// Keep last values if conversion fails
	}
};

let convertTimer;
watch([sendAmount, receiverCurrency, senderCurrency], () => {
	clearTimeout(convertTimer);
	convertTimer = setTimeout(convertAmount, 400);
});

const onCountryChange = (code) => {
	selectedCode.value = code;
	const wallet = detectedWallet.value;
	if (wallet) {
		transferStore.setReceiver({
			countryCode: code,
			country: wallet.country,
			countryFlag: wallet.flag,
			wallet,
			currency: wallet.currency
		});
	}
};

const goToReview = () => {
	if (!isValid.value) return;

	const wallet = detectedWallet.value;
	if (wallet) {
		transferStore.setReceiver({
			name: receiverName.value,
			phone: selectedCode.value + phone.value,
			countryCode: selectedCode.value,
			country: wallet.country,
			wallet,
			currency: wallet.currency
		});
	}

	transferStore.setAmount(sendAmount.value);
	transferStore.setDestinationAmount(convertedAmount.value);
	transferStore.setPricing({
		rate: rate.value,
		fee: fee.value,
		receiverCurrency: receiverCurrency.value
	});
	transferStore.senderCurrency = senderCurrency.value;

	router.push({ name: 'review' });
};

onMounted(loadWallets);
</script>