<script setup>
defineProps({
	text: { type: String, required: true },
	icon: { type: String, default: null },
	disabled: { type: Boolean, default: false }
});
defineEmits(['click']);
</script>

<template>
	<button :disabled="disabled" @click="$emit('click')" class="btn-gradient disabled:opacity-50">
		<span>{{ text }}</span>
		<span v-if="icon">{{ icon }}</span>
	</button>
</template>
