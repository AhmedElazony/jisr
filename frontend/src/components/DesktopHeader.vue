<template>
	<header
		class="hidden md:flex fixed top-0 right-60 left-0 bg-white border-b border-[#E5E7EB] px-8 py-4 items-center justify-between z-20">
		<div class="flex items-center gap-3">
			<div class="w-10 h-10 rounded-full bg-[#E8F7F3] flex items-center justify-center text-[#0CAB9A]">
				<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
					<path
						d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
				</svg>
			</div>
			<div>
				<div class="font-semibold text-sm text-[#111827]">أحمد حسن</div>
				<div class="text-xs text-[#6B7280]">أهلًا بعودتك</div>
			</div>
			<button class="text-[#6B7280] hover:text-[#0CAB9A] transition">
				<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
					<path d="M13.73 21a2 2 0 0 1-3.46 0" />
				</svg>
			</button>
		</div>
		<div class="font-semibold text-[#111827]">لوحة التحكم</div>
		<div
			class="w-10 h-10 rounded-lg border border-[#E5E7EB] flex items-center justify-center text-[#0CAB9A] font-bold text-sm">
			جسر
		</div>
	</header>
</template>