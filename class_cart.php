﻿<?php
/**
* 
*/
class Cart 
{
	
	function __construct(argument)
	{
		# code...
	}

// Добавляет продукт в количестве count с указанным id в корзину
	public static function addProducrt($id_product, $count = 1)
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Провереряем, если в таблице cart записиь с указанным id продукта
		$query = "SELECT `id_cart` FROM `cart` WHERE `id_product_cart`= ".$id.""; // 
		// Запрос к БД и получение результата
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);
		// Если есть, то увеличивает значение 'count' с указанным id (записи)
		if (isset($row)) 
		{	
			$query_update = "UPDATE `cart` SET `count` = `count`+ ".$count." WHERE `id_cart` = ".$row["id_cart"];
			return mysqli_query($db, $query_update); // boolean
		} // Иначе добавляем новую запись с указанным id продукта и его количеством 
			else 
			{
				$query_add = "INSERT INTO `cart`(`id_product_cart`, `count`) VALUES (".$id.", ".$count.")";
				return mysqli_query($db, $query_add); // boolean
			}
	}

	// Возвращает список товаров в корзине
	public static function getProductsCartList()
	{
		// Соединение с БД
		$db = Db::getConnection();
  		// Запрос к БД и получение результата
   		$query = "SELECT id_cart, name, count, price, discount_price FROM product, cart WHERE `cart`.`id_product_cart` = `product`.`id_product`";
  		$result = mysqli_query($db, $query);
  		//массив с информауцие о товаре в корзине
  		$products_cart_list = array();
  		$i = 0;
  		//заполнение массива
  		while ($row = mysqli_fetch_assoc($result)) {
			$products_cart_list[$i]['id_cart'] = $row['id_cart'];
			$products_cart_list[$i]['name'] = $row['name'];
			$products_cart_list[$i]['count'] = $row['count'];
			$products_cart_list[$i]['price'] = $row['count'];
			$products_cart_list[$i]['discount_price'] = $row['discount_price'];
      
     			$i++;
    		}
   		return $products_cart_list;
	}

	// Удаляет продукт из корзины с указанным id (id записи в таблице cart)
	public static function deleteProductsCart($id_cart)
	{
		// Соединение с БД
   		$db = Db::getConnection();
   		// Запрос к БД и получение результата
	  	$query = "DELETE FROM cart WHERE id_cart = ".$id_cart;
	 	$result = mysqli_query($db, $query);

	 	return $result; // boolean
	}

	// Возвращает количество товаров в корзине 
	public static function getCountProductsCart()
	{
		// Соединение с БД
   		$db = Db::getConnection();
  		// Запрос к БД и получение результата
   		$query = "SELECT COUNT(id_cart) FROM cart";
  		$result = mysqli_query($db, $query);
  		//заполнение массива
  		return mysqli_fetch_assoc($result);
	}


	// Возвращает сумму товаров в корзине без учета скидок 
	public static function getFullPriceWithoutDiscounts()
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "SELECT SUM(`product`.`price`*`cart`.`count`) FROM `product`, `cart` WHERE `cart`.`id_product_cart`=`product`.`id_product`";
		$result = mysqli_query($db, $query);
		$price_without_discount = mysqli_fetch_assoc($result);
		
		return $price_without_discount["SUM(`product`.`price`*`cart`.`count`)"];        
	}

	// Возвращает сумму товаров в корзине с учетом скидок 
	public static function getFullDiscountPrice()
	{
		// Соединение с БД
		$db = Db::getConnection();
		// Запрос к БД и получение результата
		$query = "SELECT SUM(`product`.`discount_price`*`cart`.`count`) FROM `product`, `cart` WHERE `cart`.`id_product_cart`=`product`.`id_product`";
		$result = mysqli_query($db, $query);
		$price_without_discount = mysqli_fetch_assoc($result);

		return $price_without_discount["SUM(`product`.`price`*`cart`.`count`)"];        
	}



}

?>


