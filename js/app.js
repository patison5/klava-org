function drawSearchTableLine (data) {
	var form__result = document.getElementsByClassName('search-form__result')[0];
	var form__body   = form__result.getElementsByClassName('search__body')[0];

	form__body.innerHTML = "";

	for (var i = 0; i < data.length; i++) {

		var row = document.createElement('tr');
			row.className = "form__result-row";

		Object.keys(data[i]).forEach(key => {
			
			// if ( data[i][key] != null) {
				let value = data[i][key];
				let cell = document.createElement('td');
				cell.className = "form__result-cell"
				cell.innerHTML = value;

				row.appendChild(cell);
			// }
		});

		row.addEventListener('click', function () {
			let cells = this.getElementsByClassName('form__result-cell');
			let main__table = document.getElementById('main__table-js');

			let mainRow = document.createElement('tr');
				mainRow.className = "grid-table__row";


			console.log(cells)

			for (let i = 0; i < cells.length; i++) {
				let cell = document.createElement('td');
				cell.className = "grid-table__column"
				cell.innerHTML = cells[i].innerHTML;

				mainRow.appendChild(cell);
			}

			form__result.style.display = "none";
			main__table.appendChild(mainRow);

		})

		form__body.appendChild(row);
	}


	if (data.length != 0)
		form__result.style.display = "block";
}

function sendSearchRequest (search__input) {
	let searchValue = search__input.value;

	let formData = new FormData();
		formData.append("search_value", searchValue);

	let request = new XMLHttpRequest();
		request.open('POST', 'http://localhost/klava-org/search.php');

	// при изменении состояния запроса
    request.addEventListener('readystatechange', function() {

		if (this.readyState == 4 && this.status == 200) {

			if (this.responseText) {
				let response = JSON.parse(this.responseText);

				if (response.data) {
					let data = response.data;
					console.log(data)
					drawSearchTableLine(data);
				} else {
					console.log('Nothing have been found...')
				}
			} else {
				console.warn("get bad data from server");
			}

		}
    });

     //отправляем запрос на сервер
	request.send(formData);
}

window.onload = function  () {
	let search__form  = document.getElementsByClassName('search-order__form')[0];
	let search_brn 	  = document.getElementById('search__from-btn');
	let search__text  = document.getElementById('search__text');


	search__text.addEventListener('change', function (e) {
		sendSearchRequest(this)
	})

}