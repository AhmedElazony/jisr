<template>
	<div
		class="min-h-screen flex flex-col items-center justify-center p-4 bg-gradient-to-br from-[#E0F7F4] to-[#EEF4F5]">
		<!-- Animated Logo -->
		<div class="mb-8 animate-bounce">
			<div class="text-6xl font-bold text-[#0CAB9A]">جسر</div>
		</div>

		<!-- Spinner -->
		<div class="mb-8">
			<div class="w-16 h-16 border-4 border-[#E5E7EB] border-t-[#0CAB9A] rounded-full animate-spin"></div>
		</div>

		<!-- Message -->
		<div class="text-center">
			<p class="text-xl font-semibold text-[#111827] mb-2">جارٍ تنفيذ التحويل...</p>
			<p class="text-sm text-[#6B7280]">يرجى الانتظار لحظات</p>
		</div>
	</div>
</template>

<script setup>
</script>

<style scoped>
@keyframes bounce {

	0%,
	100% {
		transform: translateY(0);
	}

	50% {
		transform: translateY(-10px);
	}
}

.animate-bounce {
	animation: bounce 1s infinite;
}
</style>
