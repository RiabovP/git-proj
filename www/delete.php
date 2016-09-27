<?php
	$connect=mysql_connect("localhost");      				 // коннект к базе 
  	$database = "test_db";
  	$table_name = "zakazi";
  	mysql_select_db($database); 					         // выбираем базу данных
  	$sql_query = "DELETE FROM zakazi WHERE id=";			 // Создание запроса на удаление
  
  	$value=$_POST[id];									     // Вывод запроса из глобального массива через метод post
  
  	$sql_query=$sql_query.$value.";";						 // Добавления значения необходимой строки для удаления
  	
  	$result = mysql_query($sql_query,$connect);			     // Запрос к базе данных на удаление строки

  	if($result)
 	   echo"<h2 align=center>Данные удалены из строки $value</h2>";
 	 else echo "<h1>Ошибка внесения данных</h1>";

	echo "<form action=index.php>";
  	echo "<input type=submit name='add' value='Вернуться'>";
 	echo "</form>";
 	
 ?>