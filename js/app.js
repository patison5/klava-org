function countTotal () {
	let rows = document.getElementsByClassName('grid-table__row');

	var TOTAL_WEIGHT = 0;
	var TOTAL_VOLUME = 0;
	var TOTAL_COUNT  = 0;

	for (let i = 1; i < rows.length - 4 ; i++) {

		console.log(rows[i].getElementsByClassName('count__area')[0])


		let weight = parseFloat(rows[i].getElementsByClassName('grid-table__column')[7].innerHTML);
		let volume = parseFloat(rows[i].getElementsByClassName('grid-table__column')[8].innerHTML);
		let price  = parseFloat(rows[i].getElementsByClassName('grid-table__column')[9].innerHTML);
		let amount = rows[i].getElementsByClassName('count__area')[0].value;
		let transport = document.getElementById('transport-js');
		let transport__distance = document.getElementById('transport__distance');

		let ownTransportValue = document.getElementById('transport_own_value-js').value;

		if (amount.length != 0) {
			amount = parseFloat(amount);


			if (ownTransportValue.length == 0) {
				transport.value = transport__distance.value * price;
			} else {
				transport.value = ownTransportValue * price;
			}


			rows[i].getElementsByClassName('count__area')[0].style.border = '1px solid #ccc';
			transport.style.border = '1px solid #ccc';


			rows[i].getElementsByClassName('grid-table__column')[11].innerHTML = amount * weight;  // 12 столбец
			rows[i].getElementsByClassName('grid-table__column')[12].innerHTML = amount * volume;  // 13 столбец
			rows[i].getElementsByClassName('grid-table__column')[13].innerHTML = amount * price;   // 13 столбец
		


		} else {
			rows[i].getElementsByClassName('count__area')[0].style.border = '1px solid red';
		}



		TOTAL_WEIGHT += parseFloat(rows[i].getElementsByClassName('grid-table__column')[11].innerHTML);
		TOTAL_VOLUME += parseFloat(rows[i].getElementsByClassName('grid-table__column')[12].innerHTML);
		TOTAL_COUNT  += parseFloat(rows[i].getElementsByClassName('grid-table__column')[13].innerHTML);
		// подсчет итоговых по столбцам

	}


	//вывд тотальных столбцов....
	document.getElementById('total_weight').innerHTML = TOTAL_WEIGHT;
	document.getElementById('total_volume').innerHTML = TOTAL_VOLUME;
	document.getElementById('total_count').innerHTML  = TOTAL_COUNT;

	// document.getElementById('transport__price-js').innerHTML = 
}

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


				if (i == 10) {
					let count__input = document.createElement('input')
						count__input.className = "count__area";

					cell.appendChild(count__input)
				}

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
	// let search_brn 	  = document.getElementById('search__from-btn');
	let search__text  = document.getElementById('search__text');
	let loopBTN = document.getElementById('l_start_search__-js');



	search__text.addEventListener('change', function (e) {
		sendSearchRequest(this)
	})

	loopBTN.addEventListener('click', function (e) {
		sendSearchRequest(search__text)
	})

	let countNowBtn = document.getElementById('count_now-js');
		countNowBtn.addEventListener('click', countTotal);


	//последовательное появление полей во второй вкладке
	var stepOneFinishBtn = document.getElementById('step_one__finish');

	stepOneFinishBtn.addEventListener('click', function () {
		let form = document.getElementById('step-one__form');
		let inputs = form.getElementsByClassName('order__input-text');
		let flag = true;


		for (let i = 0; i < inputs.length; i++) {
			if (inputs[i].value == ""){
				flag = false;
				break;
			}
		}
		
		if (flag)
			document.getElementsByClassName('search-form__wrap')[0].style.display = "block";
	})


	//Обработчик трех вкладок - меню
	var tabElements = document.getElementsByClassName('tab-menu__element');

	for (var i = 0; i < tabElements.length; i++) {
		tabElements[i].addEventListener('click', function () {

			var tab__elements = document.getElementsByClassName('tab-panel__elements');

			for (var i = 0; i < tab__elements.length; i++) {
				if (tab__elements[i].id == this.dataset.id) {
					tab__elements[i].style.display = "block";
				} else {
					tab__elements[i].style.display = "none";
				}
			}

		})
	}



	var deleteProductBtn = document.getElementsByClassName('delete-product__btn-js');
	for (var i = 0; i < deleteProductBtn.length; i++) {
		deleteProductBtn[i].addEventListener('click', function (e) {
			e.preventDefault();

			var request  = new XMLHttpRequest();
			var formData = new FormData();

			formData.append("products_id",  this.dataset.product_id);
			request.open('POST', 'http://localhost/klava-org/deleteProduct.php');

			// при изменении состояния запроса
		    request.addEventListener('readystatechange', function() {

				if (this.readyState == 4 && this.status == 200) {
					var data;
					console.log(this.responseText)				
				}
		    });

		     //отправляем запрос на сервер
	    	request.send(formData);

		})
	}

}