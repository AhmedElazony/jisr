<template>
  <div class="min-h-screen bg-[#EEF4F5] relative overflow-hidden" dir="rtl">
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-gradient-to-br from-[#0CAB9A]/25 to-[#2563EB]/15 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-[28rem] h-[28rem] rounded-full bg-gradient-to-tr from-[#2563EB]/20 to-[#0CAB9A]/20 blur-3xl"></div>

    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">
      <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8">
        <div class="flex items-center justify-center">
          <img src="/logo.png" alt="جسر" class="w-16 h-16" />
        </div>
        <div class="text-center mt-4">
          <h1 class="text-2xl font-bold text-[#111827]">تسجيل الدخول</h1>
          <p class="text-sm text-[#6B7280] mt-1">أدخل بياناتك للمتابعة</p>
        </div>

        <form class="mt-6 space-y-4" @submit.prevent="handleLogin">
          <div>
            <label class="block text-xs text-[#6B7280] mb-2">بريد جسر الإلكتروني</label>
            <input
              v-model="jisrEmail"
              type="email"
              placeholder="ahmed@jisr"
              class="w-full px-4 py-3.5 rounded-xl border border-[#E5E7EB] bg-white text-sm outline-none focus:border-[#0CAB9A] transition placeholder-[#9CA3AF]"
            />
          </div>

          <div>
            <label class="block text-xs text-[#6B7280] mb-2">كلمة المرور</label>
            <input
              v-model="password"
              type="tel"
              placeholder="password"
              class="w-full px-4 py-3.5 rounded-xl border border-[#E5E7EB] bg-white text-sm outline-none focus:border-[#0CAB9A] transition placeholder-[#9CA3AF]"
            />
          </div>

          <button class="btn-gradient" :disabled="isLoading">
            <span v-if="!isLoading">تسجيل الدخول</span>
            <span v-else>جارٍ التحقق...</span>
          </button>

          <p v-if="errorMessage" class="text-sm text-[#B91C1C] bg-[#FDECEC] rounded-xl p-3">
            {{ errorMessage }}
          </p>
        </form>

        <p class="text-xs text-[#6B7280] text-center mt-4">
          سيتم استخدام هذه البيانات لجلب معلومات المستخدم والرمز.
        </p>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../services/api';
import { useAuthStore } from '../stores/auth';

const router = useRouter();
const authStore = useAuthStore();

const jisrEmail = ref('');
const password = ref('');
const isLoading = ref(false);
const errorMessage = ref('');

const LOGIN_ENDPOINT = import.meta.env.VITE_LOGIN_ENDPOINT || '/auth/login';

const handleLogin = async () => {
  isLoading.value = true;
  errorMessage.value = '';
  try {
    const payload = {
      jisr_email: jisrEmail.value || undefined,
      password: password.value || undefined
    };
    const response = await api.post(LOGIN_ENDPOINT, payload);
    const data = response?.data?.data;

    if (data?.user && data?.token) {
      authStore.setAuth(data);
      localStorage.setItem('token', data.token);
	  localStorage.setItem('user', JSON.stringify(data.user));
      router.push({ name: 'home' });
      return;
    }

    errorMessage.value = 'تعذر تسجيل الدخول. تحقق من البيانات.';
  } catch (error) {
    errorMessage.value = 'تعذر تسجيل الدخول. حاول مرة أخرى.';
  } finally {
    isLoading.value = false;
  }
};
</script>