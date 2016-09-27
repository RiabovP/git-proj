<!Doctype>
<HTML>
	<head>
		<meta charset=UTF8 content="масло двигатель коробка mobil" name="">
		<title>
			"Коннект к базе данных MySQL"
		</title>
		<link rel="stylesheet" href="style1.css" type="text/css">
	</head>
<body bgcolor="	#D3D3D3">
	
<?php
	echo "<H1 align=center> Соединение с базой данных MySQL и запрос у неё данных из таблицы 'zakazi'</H1>";
?>
<?php
	$conn=mysql_connect("localhost");  							  			// Коннект к базе
	$database="test_db";													// присвоение переменной имени базы
	$table_name="zakazi";
	mysql_select_db($database);												// Выбор базы
	$list_f=mysql_list_fields($database,$table_name); 						// Получение списка полей таблицы
	$n=mysql_num_fields($list_f);											// Получение количества полей таблицы
									
	ECHO "&nbsp;<table align=center width=700 cellspacing=0 border=2 cols=15>";
	
	for($i=0; $i<$n; $i++)
	{
		$name_f=mysql_field_name($list_f, $i);								// Получение имени поля таблицы
		$len=mysql_field_len($list_f, $i);									// Получение длины поля таблицы
		ECHO "<th align=center><font size=4>$name_f</font></th>";
	}

	$sql= "SELECT * FROM $table_name";										// Создание запроса на вывод данных из таблицы
	$query=mysql_query($sql,$conn) or die();								// Непосредственный запрос базе данных на вывод
	$n_rows=mysql_num_rows($query);											// Определение кол-ва строк в таблице

	for($i=0; $i<$n_rows; $i++)
	{
		echo "<tr>";
		for($j=0; $j<$n; $j++)
		{
			$value=mysql_result($query, $i, mysql_field_name($list_f, $j));
			echo "<td align=center>$value</td>";
		}
		echo "</tr>";
	}
?>

</body>