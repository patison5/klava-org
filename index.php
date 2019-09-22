<?php include("db.php");  ?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="css/style.css">

	<script type="text/javascript" src="js/jquery-latest.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script src="js/app.js"></script>

</head>
<body>
	<div class="wraper">
		
		<?php
		  // Скрипт проверки

			$login_form = '<div class="auth__wrap">
							<div class="search__form">
								<form action="#" class="search-order__form" id="login-form">

									<h4 class="form__title">Авторизация</h4>

									<label for="order-id3" class="order__input-label">
										<span class="order__input-label">Логин</span>
										<input type="text" required="required" class="order__input-text">
									</label>

									<label for="order-id3" class="order__input-label">
										<span class="order__input-label">Пароль</span>
										<input type="text" required="required" class="order__input-text">
									</label>

									<input type="submit" class="send__order-btn btn" id="authorisation__btn-js" value="Авторизоваться">
								</form>
							</div>
						</div>

						<script src="js/login.js"></script>';


			if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_hash'])) {
				$query = mysqli_query($db, "SELECT * FROM users WHERE user_id = '".$_COOKIE['user_id']."' LIMIT 1");

				if ($query) {
					$userdata = mysqli_fetch_assoc($query);
				} else {
					die("Пользователь не найден");
				}

				if(($userdata['user_hash'] !== $_COOKIE['user_hash']) or ($userdata['user_id'] !== $_COOKIE['user_id'])) {
					setcookie("user_id", "", time() - 3600*24*30*12, "/");
					setcookie("user_hash", "", time() - 3600*24*30*12, "/");

					echo $login_form;
					exit();
				}

			} else {
				echo $login_form;

				exit();
			}
		?>

		<div class="center">
			<div class="text-center">
				<input type="submit" class="send__order-btn btn" value="Создать заказ">
			</div>

			<form action="#" class="create-order__form">

				<h4 class="form__title">Шаг 1</h4>

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

				<h4 class="form__title">Добавить заказ</h4>

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

					<?php 

						$products = mysqli_query($db, "SELECT * FROM `products_table` ORDER BY `products_table`.`id` ASC LIMIT 0, 10");

						while ($product = $products->fetch_array()) {

							echo '<tr class="grid-table__row">
								<td class="grid-table__column">'.$product['id'].'</td>
								<td class="grid-table__column">'.$product['product_title'].'</td>
								<td class="grid-table__column">'.$product['product_characteristic'].'</td>
								<td class="grid-table__column">'.$product['product_provider'].'</td>
								<td class="grid-table__column">'.$product['contact_person'].'</td>
								<td class="grid-table__column">'.$product['contact_tell_number'].'</td>
								<td class="grid-table__column">'.$product['site'].'</td>
								<td class="grid-table__column">'.$product['product_weight'].'</td>
								<td class="grid-table__column">'.$product['product_volume'].'</td>
								<td class="grid-table__column">'.$product['product_price'].'</td>
								<td class="grid-table__column"></td>
								<td class="grid-table__column"></td>
								<td class="grid-table__column"></td>
								<td class="grid-table__column"></td>
							</tr>';

						}
					?>

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