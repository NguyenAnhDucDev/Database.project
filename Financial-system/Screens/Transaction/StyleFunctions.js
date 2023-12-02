function ChangeLabelCards(color, classe) {
	document.getElementsByClassName(classe)[0].style.color = color
	document.getElementsByClassName(classe)[1].style.color = color
}

function OpenForm(id) {
	switch (id) {
		case 'formCategory':
			document.getElementById('formCategory').style.display = 'flex'
			document.getElementById('table-category').style.display = 'flex'
			document.getElementById('table-category2').style.display = 'flex'
			document.getElementById('formRece').style.display = 'none'
			document.getElementById('formDesp').style.display = 'none'
			window.location.href = 'TransactionPage.php#formCategory'
			break

		case 'formRece':
			if (document.getElementById('blockedReceive') === null) {
				document.getElementById('formCategory').style.display = 'none'
				document.getElementById('table-category').style.display = 'none'
				document.getElementById('table-category2').style.display = 'none'
				document.getElementById('formRece').style.display = 'flex'
				document.getElementById('formDesp').style.display = 'none'
				window.location.href = 'TransactionPage.php#formRece'
			} else {
				alert('Você não possui categoria de receita registrada, cadastre e tente novamente')
			}

			break

		case 'formDesp':
			if (document.getElementById('blockedExpense') === null) {
				document.getElementById('formCategory').style.display = 'none'
				document.getElementById('table-category').style.display = 'none'
				document.getElementById('table-category2').style.display = 'none'
				document.getElementById('formRece').style.display = 'none'
				document.getElementById('formDesp').style.display = 'flex'
				window.location.href = 'TransactionPage.php#formDesp'
			} else {
				alert('Você não possui categoria de despesa registrada, cadastre e tente novamente')
			}
			break
	}
}

function CloseForm() {
	document.getElementById('formCategory').style.display = 'none'
	document.getElementById('table-category').style.display = 'none'
	document.getElementById('table-category2').style.display = 'none'
	document.getElementById('formRece').style.display = 'none'
	document.getElementById('formDesp').style.display = 'none'
}
