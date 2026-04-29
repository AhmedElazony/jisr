<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import BottomNav from './components/BottomNav.vue';
import SidebarNav from './components/SidebarNav.vue';
import DesktopHeader from './components/DesktopHeader.vue';

const route = useRoute();

const showShell = computed(() => !['landing', 'login', 'processing', 'success'].includes(route.name));
</script>

<template>
	<div class="min-h-screen bg-[#EEF4F5]">
		<SidebarNav v-if="showShell" />
		<DesktopHeader v-if="showShell" />

		<main :class="showShell ? 'md:ml-60 md:pt-[73px]' : ''">
			<RouterView />
		</main>

		<BottomNav v-if="showShell" />
	</div>
</template>