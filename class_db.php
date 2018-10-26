<?php
/**
* Класс Db
* Для работы с базой данных
*/
class Db  
{
	
	function __construct()
	{
		# code...
	}

	/**
	* Устанавливает соединение с базой данных
	*/
	public static function getConnection()
	{

		$link = mysqli_connect("localhost", "root", "", "db_cart");

		/* проверка подключения */
		if (mysqli_connect_errno()) {
		    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
		    exit();
		}

		return $link;
	}

}

?>