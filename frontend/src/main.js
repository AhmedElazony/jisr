import { createApp } from 'vue';
import { createPinia, setActivePinia } from 'pinia'; // 👈 1. Import setActivePinia
import router from './router';
import './style.css';
import App from './App.vue';
import { useAuthStore } from './stores/auth';

const app = createApp(App);
const pinia = createPinia();

app.use(pinia);
app.use(router);

setActivePinia(pinia);

const authStore = useAuthStore(); 

authStore.bootstrap().finally(() => {
  app.mount('#app');
});
