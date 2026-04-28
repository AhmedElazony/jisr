<template>
	<div class="min-h-screen p-4 md:p-8 flex flex-col items-center justify-center">
		<!-- Success Icon -->
		<div class="mb-8">
			<div class="w-24 h-24 bg-[#10B981] rounded-full flex items-center justify-center text-5xl animate-scale-in">
				✓
			</div>
		</div>

		<!-- Success Message -->
		<h1 class="text-2xl font-bold text-[#111827] text-center mb-4">تم التحويل بنجاح</h1>

		<!-- Amount -->
		<div class="text-center mb-8">
			<p class="text-sm text-[#6B7280] mb-2">المبلغ المرسل</p>
			<p class="amount-display">{{ transfer.receiverCurrency }} {{ transfer.destinationAmount }}</p>
		</div>

		<!-- Reference Card -->
		<AppCard class="mb-6 max-w-md w-full">
			<div class="text-center">
				<p class="text-sm-muted mb-3">رقم المرجع</p>
				<p class="text-2xl font-bold text-[#0CAB9A] tracking-wider">{{ transfer.referenceNumber }}</p>
				<button @click="copyReference" class="mt-4 text-sm text-[#0CAB9A] font-semibold hover:underline">
					انسخ الرقم
				</button>
			</div>
		</AppCard>

		<!-- Info Card -->
		<AppCard class="mb-8 max-w-md w-full bg-[#E0F7F4]">
			<div class="text-center text-sm">
				<p class="text-[#0A8F7F] font-semibold">يمكن للمستقبل استلام المبلغ في غضون دقائق</p>
			</div>
		</AppCard>

		<!-- Actions -->
		<div class="space-y-3 w-full max-w-md">
			<button @click="shareReceipt" class="btn-gradient">
				<span>إرسال إيصال</span>
				<span>↗</span>
			</button>

			<button @click="goHome" class="w-full py-4 rounded-full border-2 border-[#0CAB9A] text-[#0CAB9A] font-bold">
				العودة للرئيسية
			</button>
		</div>
	</div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { useTransferStore } from '../stores/transfer';
import AppCard from '../components/AppCard.vue';

const router = useRouter();
const transfer = useTransferStore();

const copyReference = () => {
	navigator.clipboard.writeText(transfer.referenceNumber);
	alert('تم نسخ رقم المرجع');
};

const shareReceipt = () => {
	const message = `تم التحويل بنجاح\n\nرقم المرجع: ${transfer.referenceNumber}\nالمبلغ: ${transfer.receiverCurrency} ${transfer.destinationAmount}`;
	if (navigator.share) {
		navigator.share({
			title: 'إيصال التحويل',
			text: message
		});
	} else {
		alert(message);
	}
};

const goHome = () => {
	transfer.reset();
	router.push({ name: 'home' });
};
</script>

<style scoped>
@keyframes scale-in {
	0% {
		transform: scale(0);
		opacity: 0;
	}

	50% {
		transform: scale(1.1);
	}

	100% {
		transform: scale(1);
		opacity: 1;
	}
}

.animate-scale-in {
	animation: scale-in 0.6s ease-out;
}
</style>
