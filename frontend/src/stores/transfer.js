import { defineStore } from 'pinia';
import { useAuthStore } from './auth';

export const useTransferStore = defineStore('transfer', {
	state: () => ({
		sender: {
			phone: '',
			countryCode: '',
			wallet: null,
			country: ''
		},
		receiver: {
			name: '',
			phone: '',
			countryCode: '',
			wallet: null,
			countryName: '',
			country: '',
			countryFlag: ''
		},
		amount: '',
		destinationAmount: '',
		rate: 1,
		fee: 5,
		status: 'idle', // idle, processing, success
		referenceNumber: '',
		senderCurrency: useAuthStore().user?.currency || 'EGP',
		receiverCurrency: '',
		reason: ''
	}),

	actions: {
		setSender(payload) {
			this.sender = { ...this.sender, ...payload };
		},
		setReceiver(payload) {
			this.receiver = { ...this.receiver, ...payload };
		},
		setAmount(amount) {
			this.amount = amount;
		},
		setDestinationAmount(amount) {
			this.destinationAmount = amount;
		},
		setPricing(payload) {
			this.rate = payload.rate || 1;
			this.fee = payload.fee || 0;
			this.receiverCurrency = payload.receiverCurrency || '';
		},
		setStatus(status) {
			this.status = status;
		},
		setReferenceNumber(ref) {
			this.referenceNumber = ref;
		},
		setReason(reason) {
			this.reason = reason;
		},
		reset() {
			this.sender = { phone: '', countryCode: '', wallet: null, country: '' };
			this.receiver = { name: '', phone: '', countryCode: '', wallet: null, country: '' };
			this.amount = '';
			this.destinationAmount = '';
			this.rate = 1;
			this.fee = 5;
			this.status = 'idle';
			this.referenceNumber = '';
			this.senderCurrency = 'EGP';
			this.receiverCurrency = '';
		}
	}
});