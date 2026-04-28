<template>
	<div v-if="wallet"
		:class="['inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white shadow-sm', wallet.badge]">
		<span class="text-sm font-medium">تم اكتشاف محفظة {{ wallet.name }}</span>
	</div>
</template>

<script setup>
defineProps({
	wallet: {
		type: Object,
		default: null
	}
});
</script>
