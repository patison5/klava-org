<?php include("db.php");  ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="css/style.css">

	<script type="text/javascript" src="js/jquery-latest.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<!-- <script src="js/app.js"></script> -->
</head>
<body>
	<div class="wraper">
		<div class="center">
			<div class="text-center">
				<input type="submit" class="send__order-btn btn" value="Создать заказ">
			</div>

			<form action="#" class="create-order__form">

				<label for="order-id1" class="order__input-label">
					<span class="order__input-label">Дата заказа</span>
					<input type="text" required="required" class="order__input-text">
				</label>

				<label for="order-id2" class="order__input-label">
					<span class="order__input-label">Уникальный номер заказа в формате 111-111</span>
					<input type="text" required="required" class="order__input-text">
				</label>

				<label for="order-id3" class="order__input-label">
					<span class="order__input-label">Цена в рублях</span>
					<input type="text" required="required" class="order__input-text">
				</label>

				<label for="order-id4" class="order__input-label">
					<span class="order__input-label">Расстояние доставки в км.</span>
					<input type="text" required="required" class="order__input-text">
				</label>

				<input type="submit" class="send__order-btn btn">
			</form>
		</div>

		<div class="search__form">
			<form action="#" class="search-order__form">

				<label for="order-id1" class="order__input-label">
					<span class="order__input-label">Поиск товара</span>
					<div class="search-input__wrap">
						<input type="text" required="required" class="order__input-text order__input-search">
						<i class="search-ico"></i>
					</div>
				</label>

				<input type="submit" class="send__order-btn btn" value="Добавить">
			</form>
		</div>


		<div class="center">
			<table class="grid-table tablesorter"  id="myTable">
				<thead>
					<tr class="grid-table__row">
						<th class="grid-table__column">Порядковый номер</th>
						<th class="grid-table__column">Наименование товара</th>
						<th class="grid-table__column">Характеристика товара</th>
						<th class="grid-table__column">Поставщик</th>
						<th class="grid-table__column">Контактное лицо</th>
						<th class="grid-table__column">Контактный телефон</th>
						<th class="grid-table__column">Сайт</th>
						<th class="grid-table__column">Вес единицы,кг</th>
						<th class="grid-table__column">Объем единицы,куб.м</th>
						<th class="grid-table__column">Цена за ед. руб</th>
						<th class="grid-table__column">Количество</th>
						<th class="grid-table__column">Итого вес, кг</th>
						<th class="grid-table__column">Итого объем куб.м</th>
						<th class="grid-table__column">Сумма, руб</th>
					</tr>
				</thead>

				<tbody>
					<tr class="grid-table__row">
						<td class="grid-table__column">1</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь отб ГОСТ</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь, отб. ГОСТ, размер 150х215 см, плотность 142г/кв.м</td>
						<td class="grid-table__column">ООО "текстиль"</td>
						<td class="grid-table__column">Петр</td>
						<td class="grid-table__column">8 800 555-35-35</td>
						<td class="grid-table__column">textril.ru</td>
						<td class="grid-table__column">0.250</td>
						<td class="grid-table__column">0.0025</td>
						<td class="grid-table__column">142.00</td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
					</tr>
					<tr class="grid-table__row">
						<td class="grid-table__column">2</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь отб ГОСТ</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь, отб. ГОСТ, размер 150х215 см, плотность 142г/кв.м</td>
						<td class="grid-table__column">ООО "текстиль"</td>
						<td class="grid-table__column">Иван</td>
						<td class="grid-table__column">8 800 555-35-35</td>
						<td class="grid-table__column">textril.ru</td>
						<td class="grid-table__column">0.2350</td>
						<td class="grid-table__column">0.00325</td>
						<td class="grid-table__column">140.00</td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
					</tr>
				</tbody>
			</table>

			<!-- <table id="myTable" class="tablesorter grid-table">
				<thead>
					<tr class="grid-table__row">
						<th class="grid-table__column">Порядковый номер</th>
						<th class="grid-table__column">Наименование товара</th>
						<th class="grid-table__column">Характеристика товара</th>
						<th class="grid-table__column">Поставщик</th>
						<th class="grid-table__column">Контактное лицо</th>
						<th class="grid-table__column">Контактный телефон</th>
						<th class="grid-table__column">Сайт</th>
						<th class="grid-table__column">Вес единицы,кг</th>
						<th class="grid-table__column">Объем единицы,куб.м</th>
						<th class="grid-table__column">Цена за ед. руб</th>
						<th class="grid-table__column">Количество</th>
						<th class="grid-table__column">Итого вес, кг</th>
						<th class="grid-table__column">Итого объем куб.м</th>
						<th class="grid-table__column">Сумма, руб</th>
					</tr>
				</thead>

				<tbody>
					<tr class="grid-table__row">
						<td class="grid-table__column">1</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь отб ГОСТ</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь, отб. ГОСТ, размер 150х215 см, плотность 142г/кв.м</td>
						<td class="grid-table__column">ООО "текстиль"</td>
						<td class="grid-table__column">Иван</td>
						<td class="grid-table__column">8 800 555-35-35</td>
						<td class="grid-table__column">textril.ru</td>
						<td class="grid-table__column">0.250</td>
						<td class="grid-table__column">0.0025</td>
						<td class="grid-table__column">140.00</td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
					</tr>
					<tr class="grid-table__row">
						<td class="grid-table__column">1</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь отб ГОСТ</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь, отб. ГОСТ, размер 150х215 см, плотность 142г/кв.м</td>
						<td class="grid-table__column">ООО "текстиль"</td>
						<td class="grid-table__column">Иван</td>
						<td class="grid-table__column">8 800 555-35-35</td>
						<td class="grid-table__column">textril.ru</td>
						<td class="grid-table__column">0.250</td>
						<td class="grid-table__column">0.0025</td>
						<td class="grid-table__column">140.00</td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
					</tr>
					<tr class="grid-table__row">
						<td class="grid-table__column">1</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь отб ГОСТ</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь, отб. ГОСТ, размер 150х215 см, плотность 142г/кв.м</td>
						<td class="grid-table__column">ООО "текстиль"</td>
						<td class="grid-table__column">Иван</td>
						<td class="grid-table__column">8 800 555-35-35</td>
						<td class="grid-table__column">textril.ru</td>
						<td class="grid-table__column">0.250</td>
						<td class="grid-table__column">0.0025</td>
						<td class="grid-table__column">140.00</td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
					</tr>
					<tr class="grid-table__row">
						<td class="grid-table__column">1</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь отб ГОСТ</td>
						<td class="grid-table__column">Простыня 1.5 спальная бязь, отб. ГОСТ, размер 150х215 см, плотность 142г/кв.м</td>
						<td class="grid-table__column">ООО "текстиль"</td>
						<td class="grid-table__column">Иван</td>
						<td class="grid-table__column">8 800 555-35-35</td>
						<td class="grid-table__column">textril.ru</td>
						<td class="grid-table__column">0.250</td>
						<td class="grid-table__column">0.0025</td>
						<td class="grid-table__column">140.00</td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
						<td class="grid-table__column"></td>
					</tr>
				</tbody>
			</table> -->
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$("#myTable").tablesorter();

			console.log('hello')
		});
	</script>
</body>
</html>