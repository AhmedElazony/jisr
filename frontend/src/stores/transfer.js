import { defineStore } from 'pinia';

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
			country: ''
		},
		amount: '',
		destinationAmount: '',
		rate: 1,
		fee: 0,
		status: 'idle', // idle, processing, success
		referenceNumber: '',
		senderCurrency: 'EGP',
		receiverCurrency: ''
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
		reset() {
			this.sender = { phone: '', countryCode: '', wallet: null, country: '' };
			this.receiver = { name: '', phone: '', countryCode: '', wallet: null, country: '' };
			this.amount = '';
			this.destinationAmount = '';
			this.rate = 1;
			this.fee = 0;
			this.status = 'idle';
			this.referenceNumber = '';
		}
	}
});
