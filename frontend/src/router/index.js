import { createRouter, createWebHistory } from 'vue-router';

const LoginView = () => import('../views/LoginView.vue');
const LandingView = () => import('../views/LandingView.vue');
const HomeView = () => import('../views/HomeView.vue');
const SendView = () => import('../views/SendView.vue');
const ReviewView = () => import('../views/ReviewView.vue');
const ProcessingView = () => import('../views/ProcessingView.vue');
const SuccessView = () => import('../views/SuccessView.vue');

export default createRouter({
	history: createWebHistory(),
	routes: [
		{ path: '/', name: 'landing', component: LandingView },
		{ path: '/login', name: 'login', component: LoginView},
		{ path: '/home', name: 'home', component: HomeView },
		{ path: '/send', name: 'send', component: SendView },
		{ path: '/review', name: 'review', component: ReviewView },
		{ path: '/processing', name: 'processing', component: ProcessingView },
		{ path: '/success', name: 'success', component: SuccessView }
	]
});
