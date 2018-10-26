<?php

/**
* 
*/
class Product
{
	 // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;
	
	function __construct(argument)
	{
		# code...
	}


	//Возвращает список последних продуктов
	public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
	{
		// Соединение с БД
		$db = Db::getConnection();

		//запрос к БД и получение результата
		$query = "SELECT * FROM product ORDER BY id_product DESC LIMIT ".$count;
		$result = mysqli_query($link, $query);

		if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_array($result);

		//отборажение списка товаров (название товара + кнопка "в корзину")
		do {
			
			echo '
			<form action="class_cart.php" method="post">
			<span>'. $row["name"].'</span>
			<input type="hidden" name="id" value="'.$row["id_product"].'">
			<input type="submit" value="в корзину" /> </br> 
			</form>
			';

			} while ($row = mysqli_fetch_array($result));

		}
	  // очищение результирующего набора 
	  mysqli_free_result($result);
		// закрытие подключения 
		mysqli_close($db);
	}

  //Возвращает список товаров
  public static function getProductsList()
  {
    // Соединение с БД
   	$db = Db::getConnection();

   // Запрос к БД и получение результата
  	$query = "SELECT * FROM product ORDER BY id_product ASC";
  	$result = mysqli_query($link, $query);

  	//массив с информауцие о товаре
  	$productsList = array();
  	$i = 0;
  	//заполнение массива
  	while ($row = mysqli_fetch_assoc($result)) {
      $productsList[$i]['id'] = $row['id'];
      $productsList[$i]['name'] = $row['name'];
      $productsList[$i]['price'] = $row['price'];
      $productsList[$i]['current_discount'] = $row['current_discount'];

      $i++;
    }
    return $productsList;
  }

	// Возвращает продукт с указанным id
	public static function getProductById($id_product)
	{
	  // Соединение с БД
	  $db = Db::getConnection();
	  // Запрос к БД и получение результата
	  $query = "SELECT * FROM product WHERE id_product = ".$id_product;
	  $result = mysqli_query($link, $query);
			        
	  return mysqli_fetch_assoc($result);
	}

	// Удаляет продук с указанным id
	public static function deleteProductById($id_product)
	{
	  // Соединение с БД
	  $db = Db::getConnection();
	  // Запрос к БД и получение результата
	  $query = "DELETE FROM product WHERE id_product = ".$id_product;
	  $result = mysqli_query($link, $query);

	  return $result; // boolean
	}

	// Устанавливает скидку на все товары (распродажа)
	public static function setSellOut($sell_out)
	{
	  // Соединение с БД
	  $db = Db::getConnection();
	  // Запрос к БД и получение результата
	  $query = "UPDATE `product` SET `sell_out`= ".$sell_out;
	  $result = mysqli_query($db, $query);
			        
	  return $result; // boolean
	}


	// Устанавливает текущую скидку на продук с указанным id 
	public static function setCurrentDiscount($current_discount, $id_product)
	{
	  // Соединение с БД
	  $db = Db::getConnection();
	  // Запрос к БД и получение результата
	  $query = "UPDATE `product` SET `current_discount`= ".$current_discount." WHERE `id_product`= ".$id_product;
	  $result = mysqli_query($db, $query);
			        
	  return $result; // boolean
	}

//Устанавливает скидку покупателя 
	public static function setBuyerDiscount($buyer_discount, $id_customer)
	{
	  // Соединение с БД
	  $db = Db::getConnection();
	  // Запрос к БД и получение результата
	  $query = "UPDATE `customer` SET `current_discount`= ".$buyer_discount." WHERE `id_customer`= ".$id_customer;
	  $result = mysqli_query($db, $query);
			        
	  return $result; // boolean
	}



}


?>