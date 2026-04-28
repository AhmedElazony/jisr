<template>
	<AppCard bordered>
		<div class="space-y-4">
			<div class="flex justify-between items-center pb-3 border-b border-[#E5E7EB]">
				<span class="text-sm-muted">سعر الصرف</span>
				<span class="font-semibold">1 {{ destCurrency }} = {{ rate }} {{ sourceCurrency }}</span>
			</div>

			<div class="flex justify-between items-center pb-3 border-b border-[#E5E7EB]">
				<span class="text-sm-muted">الرسوم</span>
				<span class="font-semibold">{{ fee }} {{ sourceCurrency }}</span>
			</div>

			<div class="flex justify-between items-center pt-2">
				<span class="text-sm-muted">المستلم يستلم</span>
				<span class="amount-display text-[#0CAB9A]">{{ receiverAmount }} {{ destCurrency }}</span>
			</div>
		</div>
	</AppCard>
</template>

<script setup>
defineProps({
	rate: {
		type: Number,
		default: 1
	},
	fee: {
		type: Number,
		default: 0
	},
	sourceCurrency: {
		type: String,
		default: 'EGP'
	},
	destCurrency: {
		type: String,
		default: 'SAR'
	},
	receiverAmount: {
		type: [String, Number],
		default: '0'
	}
});
</script>
