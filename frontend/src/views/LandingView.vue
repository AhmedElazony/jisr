<template>
	<div class="min-h-screen bg-[#EEF4F5] relative overflow-hidden" dir="rtl">
		<div
			class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-gradient-to-br from-[#0CAB9A]/30 to-[#2563EB]/20 blur-3xl">
		</div>
		<div
			class="absolute bottom-0 right-0 w-[28rem] h-[28rem] rounded-full bg-gradient-to-tr from-[#2563EB]/20 to-[#0CAB9A]/20 blur-3xl">
		</div>

		<header class="relative z-10 max-w-6xl mx-auto px-6 pt-8 flex items-center justify-between">
			<div class="flex items-center gap-3">
				<img src="/logo.png" alt="جسر" class="w-12 h-12" />
				<div class="font-bold text-xl text-[#0CAB9A]">جسر</div>
			</div>
			<div class="flex items-center gap-3">
				<RouterLink :to="{ name: 'home' }"
					class="px-4 py-3 text-sm font-semibold text-[#0CAB9A] rounded-full bg-white shadow-sm">
					لوحة التحكم
				</RouterLink>
			</div>
		</header>

		<main class="relative z-10 max-w-6xl mx-auto px-6 pb-16">
			<section class="grid lg:grid-cols-2 gap-10 items-center pt-10">
				<div class="space-y-6">
					<span
						class="inline-flex items-center gap-2 bg-white/80 text-[#0CAB9A] px-4 py-2 rounded-full text-xs font-semibold shadow-sm">
						تحويلات عربية فورية
					</span>
					<h1 class="text-4xl md:text-5xl font-bold text-[#111827] leading-tight">
						جسر يربط المحافظ الرقمية العربية في ثوانٍ
					</h1>
					<p class="text-base text-[#6B7280] leading-relaxed">
						جسر هي أول منصة عربية لربط الحياة المالية بين الدول العربية، يمكنك من خلالها إرسال واستقبال
						الأموال بشكل لحظي من خلال محفظتك الرقمية المحلية.
					</p>
					<div class="flex flex-wrap gap-3">
						<RouterLink :to="{ name: 'home' }" class="btn-gradient px-6 py-3 text-sm">
							ابدأ الآن
						</RouterLink>
						<a href="#wallets"
							class="px-6 py-3 text-sm font-semibold text-[#0CAB9A] rounded-full border border-[#0CAB9A] bg-white">
							المحافظ المدعومة
						</a>
					</div>
					<div class="flex items-center gap-6 text-xs text-[#6B7280]">
						<div class="flex items-center gap-2">
							<span class="w-2 h-2 rounded-full bg-[#0CAB9A]"></span>
							تحويلات فورية
						</div>
						<div class="flex items-center gap-2">
							<span class="w-2 h-2 rounded-full bg-[#2563EB]"></span>
							أمان عالي
						</div>
						<div class="flex items-center gap-2">
							<span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
							تجربة عربية بالكامل
						</div>
					</div>
				</div>

				<div class="relative">
					<div
						class="absolute -top-6 -right-6 w-full h-full rounded-3xl bg-gradient-to-l from-[#0CAB9A]/20 to-[#2563EB]/20">
					</div>
					<div class="relative bg-white rounded-3xl shadow-lg p-8">
						<div class="flex items-center justify-between">
							<span class="text-xs bg-[#E8F7F3] text-[#0CAB9A] px-3 py-1 rounded-full">تحويل آمن</span>
							<span class="text-xs text-[#6B7280]">منصة عربية</span>
						</div>

						<div class="mt-8 flex items-center justify-center">
							<div class="relative">
								<div
									class="absolute -inset-6 rounded-full bg-gradient-to-l from-[#0CAB9A]/20 to-[#2563EB]/30 blur-2xl">
								</div>
								<div
									class="relative w-40 h-40 md:w-48 md:h-48 rounded-3xl bg-[#F4F8F8] border border-[#E5E7EB] flex items-center justify-center">
									<img src="/logo.png" alt="جسر" class="w-28 h-28 md:w-32 md:h-32" />
								</div>
							</div>
						</div>

						<div class="mt-8 text-center">
							<div class="text-xl font-bold text-[#111827]">جسر</div>
							<p class="text-sm text-[#6B7280] mt-2">ربط المحافظ الرقمية العربية بتجربة موحدة وسلسة.</p>
						</div>

						<div class="mt-8 grid grid-cols-2 gap-4">
							<div class="bg-[#F4F8F8] rounded-2xl p-4 text-center">
								<div class="text-xs text-[#6B7280]">تحويلات فورية</div>
								<div class="text-sm font-semibold text-[#111827]">ثوانٍ معدودة</div>
							</div>
							<div class="bg-[#F4F8F8] rounded-2xl p-4 text-center">
								<div class="text-xs text-[#6B7280]">تغطية عربية</div>
								<div class="text-sm font-semibold text-[#111827]">6 محافظ</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="mt-16 grid md:grid-cols-3 gap-6">
				<div class="bg-white rounded-2xl p-6 shadow-sm">
					<div class="text-[#0CAB9A] font-bold text-lg">اكتشاف تلقائي</div>
					<p class="text-sm text-[#6B7280] mt-2">يتعرف جسر على المحافظ الرقمية وفقاً لرمز الاتصال بكل دولة.
					</p>
				</div>
				<div class="bg-white rounded-2xl p-6 shadow-sm">
					<div class="text-[#0CAB9A] font-bold text-lg">أسعار واضحة</div>
					<p class="text-sm text-[#6B7280] mt-2">سعر صرف ورسوم معلنة قبل الإرسال بلا أي مفاجآت.</p>
				</div>
				<div class="bg-white rounded-2xl p-6 shadow-sm">
					<div class="text-[#0CAB9A] font-bold text-lg">دعم عربي</div>
					<p class="text-sm text-[#6B7280] mt-2">واجهة عربية بالكامل وتجربة مصممة للمنطقة.</p>
				</div>
			</section>

			<section id="wallets" class="mt-16">
				<div class="flex items-center justify-between mb-6">
					<div>
						<h2 class="text-2xl font-bold text-[#111827]">المحافظ المدعومة</h2>
						<p class="text-sm text-[#6B7280] mt-1">قائمة المحافظ المتاحة الآن داخل جسر.</p>
					</div>
					<button @click="loadWallets" class="text-sm font-semibold text-[#0CAB9A]">
						تحديث القائمة
					</button>
				</div>

				<div v-if="isLoading" class="bg-white rounded-2xl p-6 text-sm text-[#6B7280]">
					جارٍ تحميل المحافظ المدعومة...
				</div>
				<div v-else-if="errorMessage" class="bg-[#FDECEC] text-[#B91C1C] rounded-2xl p-6 text-sm">
					{{ errorMessage }}
				</div>
				<div v-else class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
					<div v-for="wallet in wallets" :key="wallet.id" class="bg-white rounded-2xl p-5 shadow-sm">
						<div class="flex items-center justify-between">
							<span class="text-2xl">{{ wallet.flag }}</span>
							<span class="text-xs bg-[#EEF4F5] text-[#6B7280] px-3 py-1 rounded-full">{{ wallet.currency
								}}</span>
						</div>
						<div class="mt-4 font-semibold text-[#111827]">{{ wallet.name }}</div>
						<div class="text-sm text-[#6B7280] mt-1">{{ wallet.country }} · {{ wallet.dial_code }}</div>
					</div>
				</div>
			</section>

			<section class="mt-16 bg-gradient-to-l from-[#0CAB9A] to-[#2563EB] rounded-3xl p-10 text-white text-center">
				<h2 class="text-2xl font-bold">ابدأ التحويل الآن</h2>
				<p class="text-sm opacity-90 mt-2">جرّب تجربة جسر الكاملة وانقل الأموال بأمان وسرعة.</p>
				<RouterLink :to="{ name: 'home' }"
					class="inline-flex mt-6 bg-white text-[#0CAB9A] font-bold px-8 py-3 rounded-full">
					ابدأ التحويل
				</RouterLink>
			</section>
		</main>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { RouterLink } from 'vue-router';

const wallets = ref([]);
const isLoading = ref(true);
const errorMessage = ref('');

const API_URL = import.meta.env.VITE_WALLETS_API_URL || '/api/v1/wallets';

const loadWallets = async () => {
	isLoading.value = true;
	errorMessage.value = '';
	try {
		const response = await axios.get(import.meta.env.VITE_API_URL + '/wallets');
		const items = response?.data?.data;
		wallets.value = Array.isArray(items) ? items : [];
	} catch (error) {
		errorMessage.value = 'تعذر تحميل المحافظ المدعومة حالياً.';
		wallets.value = [];
	} finally {
		isLoading.value = false;
	}
};

onMounted(loadWallets);
</script>
