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

			<div class="tab-menu__panel-wraper">
				<ul class="tab-menu__panel">
					<li class="tab-menu__element" data-id="tab-el__1">Добавить товар в БД</li>
					<li class="tab-menu__element" data-id="tab-el__2">Создать заказ</li>
					<li class="tab-menu__element" data-id="tab-el__3">Созданные заказы</li>
				</ul>
			</div>

			<div class="tab-panel__elements" id="tab-el__1">

				<form action="#" class="create-order__form">

					<h4 class="form__title">Добавить товар</h4>

					<label for="order-id1" class="order__input-label">
						<span class="order__input-label">Название</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id2" class="order__input-label">
						<span class="order__input-label">Характеристика</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id3" class="order__input-label">
						<span class="order__input-label">Поставщик</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id4" class="order__input-label">
						<span class="order__input-label">Контактное лицо</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id5" class="order__input-label">
						<span class="order__input-label">Телефон</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id6" class="order__input-label">
						<span class="order__input-label">Сайт</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id7" class="order__input-label">
						<span class="order__input-label">Вес товара</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id8" class="order__input-label">
						<span class="order__input-label">Объем товара</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<label for="order-id9" class="order__input-label">
						<span class="order__input-label">цена товара</span>
						<input type="text" required="required" class="order__input-text">
					</label>

					<input type="submit" class="send__order-btn btn" value="Добавить товар">
				</form>





				<table class="grid-table-main tablesorter"  id="myTable">
					<thead>
						<tr class="grid-table__row-main">
							<th class="grid-table__column-main">Порядковый номер</th>
							<th class="grid-table__column-main">Наименование товара</th>
							<th class="grid-table__column-main">Характеристика товара</th>
							<th class="grid-table__column-main">Поставщик</th>
							<th class="grid-table__column-main">Контактное лицо</th>
							<th class="grid-table__column-main">Контактный телефон</th>
							<th class="grid-table__column-main">Сайт</th>
							<th class="grid-table__column-main">Вес единицы,кг</th>
							<th class="grid-table__column-main">Объем единицы,куб.м</th>
							<th class="grid-table__column-main">Цена за ед. руб</th>
							<th class="grid-table__column-main">Упраление</th>
						</tr>
					</thead>

					<tbody>

						<?php 

							$products = mysqli_query($db, "SELECT * FROM `products_table` ORDER BY `products_table`.`id` ASC LIMIT 0, 10");

							while ($product = $products->fetch_array()) {

								echo '<tr class="grid-table__row-main">
									<td class="grid-table__column-main">'.$product['id'].'</td>
									<td class="grid-table__column-main">'.$product['product_title'].'</td>
									<td class="grid-table__column-main">'.$product['product_characteristic'].'</td>
									<td class="grid-table__column-main">'.$product['product_provider'].'</td>
									<td class="grid-table__column-main">'.$product['contact_person'].'</td>
									<td class="grid-table__column-main">'.$product['contact_tell_number'].'</td>
									<td class="grid-table__column-main">'.$product['site'].'</td>
									<td class="grid-table__column-main">'.$product['product_weight'].'</td>
									<td class="grid-table__column-main">'.$product['product_volume'].'</td>
									<td class="grid-table__column-main">'.$product['product_price'].'</td>
									<td class="grid-table__column-main"><span class="delete-btn">удалить</span></td>
								</tr>';

							}
						?>
					</tbody>

					<tfoot>
						<tr class="grid-table__row-main">
							<th class="grid-table__column-main">Порядковый номер</th>
							<th class="grid-table__column-main">Наименование товара</th>
							<th class="grid-table__column-main">Характеристика товара</th>
							<th class="grid-table__column-main">Поставщик</th>
							<th class="grid-table__column-main">Контактное лицо</th>
							<th class="grid-table__column-main">Контактный телефон</th>
							<th class="grid-table__column-main">Сайт</th>
							<th class="grid-table__column-main">Вес единицы,кг</th>
							<th class="grid-table__column-main">Объем единицы,куб.м</th>
							<th class="grid-table__column-main">Цена за ед. руб</th>
							<th class="grid-table__column-main">Упраление</th>
						</tr>
					</tfoot>
				</table>

			</div>

			<div class="tab-panel__elements" id="tab-el__2">
				<form action="#" class="create-order__form" id="step-one__form">

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
						<input type="text" required="required" class="order__input-text" id="transport__distance">
					</label>

					<input type="submit" class="send__order-btn btn" value="Добавить заказ" id="step_one__finish">
				</form>


				<div class="search-form__wrap">
					<div class="search__form">
						<form action="#" class="search-order__form">

							<h4 class="form__title">Добавить заказ</h4>

							<label for="order-id1" class="order__input-label">
								<span class="order__input-label">Поиск товара</span>

								<div class="search-input__wrap">
									<input type="text"  class="order__input-text order__input-search"  id="search__text">
									<i class="search-ico"></i>
								</div>
							</label>

							<input type="submit" class="send__order-btn btn" value="Добавить" id="search__from-btn">
						</form>
					</div>

					<div class="search-form__result">
						<table class="search-form__result-table">
							<tbody class="search__body">
							</tbody>
						</table>
					</div>
				</div>
			</div>



			<div class="tab-panel__elements" id="tab-el__3">
				<table class="grid-table tablesorter"  id="myTable">
					<thead>
						<tr class="grid-table__row">
							<th class="grid-table__column">id</th>
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

					<tbody id="main__table-js"></tbody>

					<tfoot>
						<tr class="grid-table__row">
							<th class="grid-table__column">id</th>
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

						<tr class="grid-table__row">
							<th class="grid-table__column">Итого стоимость заказа</th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
						</tr>

						<tr class="grid-table__row">
							<th class="grid-table__column">транспортные расходы</th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"><input type="text"  id="transport-js" class="count__area"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
						</tr>

						<tr class="grid-table__row">
							<th class="grid-table__column">Итого стоимость заказа с учетом транспорта</th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
							<th class="grid-table__column"></th>
						</tr>
					</tfoot>
				</table>



				<div class="table__footer-panel">
					<span class="btn countIt" id="count_now-js">подсчитать</span>
<!-- 
					<input type="text" class="transport__price"> -->
				</div>
			</div>

			

			
		</div>

		

		<div class="center">
			
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$("#myTable").tablesorter();
		});
	</script>
</body>
</html>