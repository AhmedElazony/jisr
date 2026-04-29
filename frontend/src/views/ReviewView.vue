<template>
    <div class="min-h-screen md:min-h-[calc(100vh-73px)] flex flex-col pb-32 md:pb-0">
        <!-- Mobile Header -->
        <header class="bg-white border-b border-[#E5E7EB] px-4 py-4 flex items-center justify-between md:hidden">
            <div class="w-9 h-9 rounded-full bg-[#E8F7F3] flex items-center justify-center text-[#0CAB9A]">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                    <path
                        d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
            </div>
            <div class="text-lg font-bold text-[#0CAB9A]">جسر</div>
            <button @click="router.back()"
                class="w-9 h-9 rounded-full bg-[#F3F4F6] flex items-center justify-center text-[#374151]">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        </header>

        <div class="flex-1 px-4 md:px-0 md:flex md:items-start md:justify-center md:pt-10 md:mr-60">
            <div class="w-full md:max-w-2xl md:bg-white md:rounded-2xl md:shadow-sm md:overflow-hidden">
                <!-- Desktop page title -->
                <div class="hidden md:block px-8 pt-8 pb-4 border-b border-[#E5E7EB]">
                    <h1 class="text-2xl font-bold text-[#111827]">مراجعة التحويل</h1>
                    <p class="text-sm text-[#6B7280] mt-1">يرجى تأكيد التفاصيل أدناه قبل الإرسال</p>
                </div>

                <!-- Mobile page title -->
                <div class="md:hidden pt-6 pb-2">
                    <h1 class="text-xl font-bold text-[#111827]">مراجعة التحويل</h1>
                    <p class="text-sm text-[#6B7280] mt-1">يرجى تأكيد التفاصيل أدناه قبل الإرسال</p>
                </div>

                <div class="md:px-8 md:py-6 pb-32 md:pb-8">
                    <!-- Transfer Visualization -->
                    <div class="flex items-center justify-between mb-8 px-4">
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-[#E5E7EB] mx-auto mb-2">{{ senderCountryFlag }}</div>
                            <div class="text-xs font-semibold">{{ senderCountry }}</div>
                        </div>
                        <div class="flex-1 text-center px-4">
                            <div class="text-2xl">💸</div>
                            <div class="text-xs text-[#6B7280] mt-2">تحويل</div>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-[#E5E7EB] mx-auto mb-2">{{ receiverCountryFlag }}</div>
                            <div class="text-xs font-semibold">{{ receiverCountry }}</div>
                        </div>
                    </div>

                    <!-- Amount Display -->
                    <div class="text-center mb-8">
                        <div class="text-sm-muted mb-2">المبلغ المرسل</div>
                        <div class="amount-display">{{ senderCurrency }} {{ senderAmount }}</div>
                    </div>

                    <!-- Details Card -->
                    <AppCard class="mb-6">
                        <div class="space-y-4">
                            <div class="flex justify-between pb-3 border-b border-[#E5E7EB]">
                                <span class="text-sm-muted">المستقبل</span>
                                <span class="font-semibold text-sm">{{ receiverName }}</span>
                            </div>

                            <div class="flex justify-between pb-3 border-b border-[#E5E7EB]">
                                <span class="text-sm-muted">المحفظة</span>
                                <span v-if="receiverWalletName" class="text-sm font-semibold">
                                    {{ receiverWalletName }}
                                </span>
                            </div>

                            <div class="flex justify-between pb-3 border-b border-[#E5E7EB]">
                                <span class="text-sm-muted">سعر الصرف</span>
                                <span class="text-sm font-semibold">1 {{ receiverCurrency }} = {{ transferRate }} {{
                                    senderCurrency }}</span>
                            </div>

                            <div
                                class="flex justify-between pb-3 border-b border-[#E5E7EB] bg-[#F0FFFE] -mx-6 px-6 py-4">
                                <span class="text-sm-muted">سيستلم</span>
                                <span class="text-sm font-semibold text-[#0CAB9A]">{{ receiverCurrency }} {{ destinationAmount }}</span>
                            </div>

                            <div class="flex justify-between pt-2">
                                <span class="text-sm-muted">رسوم التحويل</span>
                                <span class="text-sm font-semibold">{{ senderCurrency }} {{ transferFee }}</span>
                            </div>
                        </div>
                    </AppCard>

                    <!-- Info Note -->
                    <div class="p-4 bg-[#E0F7F4] text-[#0A8F7F] rounded-lg text-sm mb-6">
                        سيصل المبلغ إلى محفظة {{ receiverWalletName }} عادة خلال دقائق معدودة
                    </div>

                    <!-- Confirm Button (desktop) -->
                    <div class="hidden md:block mt-8">
                        <AppButton text="تأكيد التحويل" @click="confirmTransfer" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Confirm Button -->
        <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-[#E5E7EB] px-4 py-4 z-50">
            <button @click="confirmTransfer" class="btn-gradient">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                تأكيد التحويل
            </button>
        </div>
    </div>

</template>

<script setup>
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { useTransferStore } from '../stores/transfer';
import AppCard from '../components/AppCard.vue';
import AppButton from '../components/AppButton.vue';
import { useAuthStore } from '../stores/auth';
import api from '../services/api';

const router = useRouter();
const transfer = useTransferStore();
const auth = useAuthStore();

const countryNames = {
	SA: 'السعودية',
	EG: 'مصر',
	AE: 'الإمارات',
	KW: 'الكويت',
	JO: 'الأردن',
	MA: 'المغرب'
};

const countryFlags = {
	SA: '🇸🇦',
	EG: '🇪🇬',
	AE: '🇦🇪',
	KW: '🇰🇼',
	JO: '🇯🇴',
	MA: '🇲🇦'
};

const senderCountry = computed(() => countryNames[auth.user?.country] || '—');
const senderCountryFlag = computed(() => countryFlags[auth.user?.country] || '');
const receiverCountry = computed(() => transfer.receiver?.country || '—');
const receiverCountryFlag = computed(() => transfer.receiver?.countryFlag || '');
const receiverName = computed(() => transfer.receiver?.name || '—');
const receiverWalletName = computed(() => transfer.receiver?.wallet?.name || '—');

const senderCurrency = computed(() => transfer.senderCurrency || 'EGP');
const receiverCurrency = computed(() => transfer.receiverCurrency || '—');
const destinationAmount = computed(() => transfer.destinationAmount || '0.00');
const senderAmount = computed(() => transfer.amount || '0.00');

const transferRate = computed(() => transfer.rate ?? 1);
const transferFee = computed(() => transfer.fee ?? 0);

const confirmTransfer = async () => {
    try {
        transfer.setStatus('processing');
        router.push({ name: 'processing' });

        const payload = {
            receiver_phone: transfer.receiver.phone,
            amount: parseFloat(transfer.amount),
            receiver_full_name: transfer.receiver.name,
            reason: transfer.reason || ''
        };

        // Call the send transaction API
        const response = await api.post('/transactions/send', payload);
        const data = response?.data?.data;

        if (data) {
            transfer.setReferenceNumber(data.transaction.reference_code);
            
            const updatedUser = JSON.parse(localStorage.getItem('user') || '{}');
            updatedUser.wallet_balance = response?.data.data?.user_balance;
            localStorage.setItem('user', JSON.stringify(updatedUser));
            auth.setUser(updatedUser);

            transfer.setStatus('success');
            setTimeout(() => {
                router.push({ name: 'success' });
            }, 3000);
        }
    } catch (error) {
        console.error('Transaction failed:', error);
        transfer.setStatus('error');
        // Optionally show error message to user
        setTimeout(() => {
            router.push({ name: 'review' }); // Go back to review
        }, 2000);
    }
};
</script>