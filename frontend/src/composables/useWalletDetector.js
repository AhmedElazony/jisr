const wallets = [
	{
		dialCode: '+20',
		country: 'مصر',
		name: 'InstaPay',
		badge: 'bg-green-100 text-green-700'
	},
	{
		dialCode: '+966',
		country: 'السعودية',
		name: 'STC Pay',
		badge: 'bg-purple-100 text-purple-700'
	},
	{
		dialCode: '+971',
		country: 'الإمارات',
		name: 'Apple Pay / تحويل',
		badge: 'bg-black text-white'
	},
	{
		dialCode: '+965',
		country: 'الكويت',
		name: 'K-Net / Tap',
		badge: 'bg-blue-100 text-blue-700'
	},
	{
		dialCode: '+962',
		country: 'الأردن',
		name: 'eFAWATEERcom',
		badge: 'bg-orange-100 text-orange-700'
	},
	{
		dialCode: '+212',
		country: 'المغرب',
		name: 'CIH Pay',
		badge: 'bg-red-100 text-red-700'
	}
];

export function useWalletDetector() {
	const detectWallet = (dialCode = '') => {
		if (!dialCode) return null;
		return wallets.find((wallet) => dialCode.startsWith(wallet.dialCode)) || null;
	};

	const getCurrencyByDialCode = (dialCode = '') => {
		const currencyMap = {
			'+20': 'EGP',
			'+966': 'SAR',
			'+971': 'AED',
			'+965': 'KWD',
			'+962': 'JOD',
			'+212': 'MAD'
		};
		return currencyMap[dialCode] || 'EGP';
	};

	return { detectWallet, getCurrencyByDialCode, wallets };
}
