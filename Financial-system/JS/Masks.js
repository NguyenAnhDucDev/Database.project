function PhoneMask(id) {
	var phoneInput = document.getElementById(id).value

	if (phoneInput[0] !== undefined) {
		if (phoneInput[0] !== '(') {
			document.getElementById(id).value = '(' + phoneInput[0]
		}
	}

	if (phoneInput[3] !== undefined) {
		if (phoneInput[3] !== ')') {
			document.getElementById(id).value = phoneInput.slice(0, 3) + ')' + ' ' + phoneInput[3]
		}
	}

	if (phoneInput[10] !== '-') {
		if (phoneInput[10] !== undefined) {
			document.getElementById(id).value = phoneInput.slice(0, 10) + '-' + phoneInput[10]
		}
	}
}

function MoneyMask(id) {
	let valor = document.getElementById(id).value
	const typeCoin = { style: 'currency', currency: 'USD', useGrouping: false }
	const formatCoin = new Intl.NumberFormat('en', typeCoin)
	document.getElementById(id).value = formatCoin.format(valor)
}
// 'R' + 