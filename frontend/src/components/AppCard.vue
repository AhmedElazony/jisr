<template>
	<div :class="[bordered ? 'card-bordered' : 'card']">
		<slot></slot>
	</div>
</template>

<script setup>
defineProps({
	bordered: {
		type: Boolean,
		default: false
	}
});
</script>
