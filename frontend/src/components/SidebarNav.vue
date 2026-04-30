<script setup>
const sideNavItems = [
	{ label: 'الرئيسية', to: '/home', active: true, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>' },
	{ label: 'التحويلات', to: '#', active: false, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>' },
	{ label: 'المحافظ', to: '#', active: false, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>' },
	{ label: 'الملف الشخصي', to: '#', active: false, icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>' }
];
</script>

<template>
	<nav
		class="hidden lg:flex fixed right-0 top-0 h-screen w-60 bg-white border-l border-[#E5E7EB] flex-col py-6 px-4 z-30">
		<div class="flex items-center justify-center mb-10">
			<span class="text-2xl font-bold text-[#0CAB9A] tracking-tight">
				<RouterLink to="/home">
					جسر
				</RouterLink>
			</span>
		</div>
		<div class="flex-1 space-y-1">
			<button v-for="item in sideNavItems" :key="item.label" :class="[
				'w-full px-4 py-3 rounded-xl font-semibold transition text-right flex items-center gap-3 text-sm',
				item.active ? 'bg-[#0CAB9A] text-white' : 'text-[#374151] hover:bg-[#EEF4F5]'
			]">
				<span v-html="item.icon" class="w-5 h-5 flex-shrink-0"></span>
				<RouterLink :to="item.to">
					<span>{{ item.label }}</span>
				</RouterLink>
			</button>
		</div>
		<button
			class="px-4 py-3 rounded-xl text-[#EF4444] font-semibold hover:bg-red-50 transition flex items-center gap-3 text-sm">
			<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
				<polyline points="16 17 21 12 16 7" />
				<line x1="21" y1="12" x2="9" y2="12" />
			</svg>
			تسجيل الخروج
		</button>
	</nav>
</template>