<template>
	<div class="space-y-3">
		<div v-if="label" class="text-sm-muted">{{ label }}</div>
		<div class="flex gap-2">
			<select v-model="selectedCode" @change="updateCountryCode"
				class="px-4 py-3 rounded-lg border border-[#E5E7EB] bg-white text-sm font-medium min-w-[100px]">
				<option value="">اختر...</option>
				<option v-for="wallet in wallets" :key="wallet.dialCode" :value="wallet.dialCode">
					{{ wallet.country }} {{ wallet.dialCode }}
				</option>
			</select>
			<input v-model="phoneNumber" @input="updatePhone" type="tel" placeholder="رقم الهاتف"
				class="flex-1 px-4 py-3 rounded-lg border border-[#E5E7EB] bg-white text-sm placeholder-[#6B7280]" />
		</div>
	</div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useWalletDetector } from '../composables/useWalletDetector';

const props = defineProps({
	label: String,
	modelValue: String
});

const emit = defineEmits(['update:modelValue', 'countryChange']);

const { wallets } = useWalletDetector();
const selectedCode = ref('');
const phoneNumber = ref('');

const updateCountryCode = () => {
	emit('countryChange', selectedCode.value);
	updatePhone();
};

const updatePhone = () => {
	const fullNumber = selectedCode.value + phoneNumber.value;
	emit('update:modelValue', fullNumber);
};
</script>
