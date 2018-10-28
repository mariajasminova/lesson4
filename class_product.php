<?php

/**
* 
*/
class Product
{
	
	function __construct(argument)
	{
		# code...
	}

	// Возвращает список товаров
	public static function getProductsList()
	{
		// Соединение с БД
	   	$db = Db::getConnection();

		// Запрос к БД и получение результата
	  	$query = "SELECT * FROM product ORDER BY id_product ASC";
	  	$result = mysqli_query($db, $query);

 	 	//массив с информауцие о товаре
	  	$products_list = array();
	  	$i = 0;
	  	//заполнение массива
  		while ($row = mysqli_fetch_assoc($result)) {
			$products_list[$i]['id'] = $row['id'];
			$products_list[$i]['name'] = $row['name'];
			$products_list[$i]['price'] = $row['price'];
			$products_list[$i]['current_discount'] = $row['current_discount'];
			$products_list[$i]['sell_out'] = $row['sell_out'];
			$products_list[$i]['full_discount'] = $row['full_discount'];
			$products_list[$i]['discount_price'] = $row['discount_price'];

			$i++;
    		}
		return $products_list;
	}

	// Возвращает продукт с указанным id
	public static function getProductById($id_product)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "SELECT * FROM product WHERE id_product = ".$id_product;
		 $result = mysqli_query($db, $query);
			        
		return mysqli_fetch_assoc($result);
	}

	// Удаляет продук с указанным id
	public static function deleteProductById($id_product)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "DELETE FROM product WHERE id_product = ".$id_product;
		$result = mysqli_query($db, $query);

		return $result; // boolean
	}

	// Устанавливает скидку на все товары (распродажа)
	public static function setSellOut($sell_out)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "UPDATE product SET sell_out= ".$sell_out;
		$result = mysqli_query($db, $query);
			        
		return $result; // boolean
	}


	// Устанавливает текущую скидку на продук с указанным id 
	public static function setCurrentDiscount($current_discount, $id_product)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "UPDATE product SET current_discount= ".$current_discount." WHERE id_product= ".$id_product;
		$result = mysqli_query($db, $query);
			        
		return $result; // boolean
	}

	// Устанавливает скидку покупателя 
	public static function setBuyerDiscount($buyer_discount, $id_customer)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата	
		$query = "UPDATE customer SET current_discount= ".$buyer_discount." WHERE id_customer= ".$id_customer;
		$result = mysqli_query($db, $query);
			        
		return $result; // boolean
	}

	//Возвращает скидку покупателя
	public static function getBuyerDiscount($id_customer)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "SELECT * FROM customer WHERE id_customer = ".$id_customer;
		$result = mysqli_query($db, $query);
			        
		return mysqli_fetch_assoc($result);
	}



}


?>