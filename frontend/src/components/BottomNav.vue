<script setup>
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const bottomNavItems = [
	{ label: 'الرئيسية', active: true, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>' },
	{ label: 'التحويلات', active: false, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>' },
	{ label: 'المحافظ', active: false, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>' },
	{ label: 'الملف الشخصي', active: false, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>' }
];

const handleNav = (item) => {
	if (item.name === 'home') {
		router.push({ name: 'home' });
	}
};
</script>

<template>
	<nav
		class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-[#E5E7EB] flex justify-around items-center h-20 z-40">
		<button v-for="item in bottomNavItems" :key="item.label" :class="['flex flex-col items-center gap-1 px-4 py-2 text-xs font-medium transition',
			item.active ? 'text-[#0CAB9A]' : 'text-[#9CA3AF]']">
			<span v-html="item.icon" class="w-5 h-5"></span>
			<span>{{ item.label }}</span>
		</button>
	</nav>
</template>