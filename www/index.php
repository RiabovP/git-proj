<!Doctype>
<HTML>
	<head>
		<meta charset=UTF8>
		<title>
			"Коннект к базе данных MySQL"
		</title>
		<link rel="stylesheet" type="text/css">
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
			$value=mysql_result($query, $i, mysql_field_name($list_f, $j)); //сохранение значения из поля таблицы в переменной
			echo "<td align=center>$value</td>";
		}
		echo "</tr>";
	}
?>

<?php
	echo "<form method=post action=insert.php>";
	echo "&nbsp;<table border=0 cellspacing=0 width=20% ><tr><td bgcolor='#005533' align=center><font color='#FFFFFF'>
    <b> Добавить новые заказы в таблицу - $table_name</b></font></td></tr><tr><td></td></tr></table>";
    echo "<table border=0 CELLSPACING=1 cellpadding=0 width=20% >";

for($i=0;$i<$n; $i++)
{
    $type = mysql_field_type($list_f, $i);
    $name_f = mysql_field_name ($list_f,$i);
    $len = mysql_field_len($list_f, $i);
    $flags_str = mysql_field_flags ($list_f, $i);

    $flags = explode(" ", $flags_str); 
    foreach ($flags as $f)
    {
        if ($f == 'auto_increment') $key = $name_f;   // запоминаем имя автоинкремента
    }
/* для каждого поля, не являющегося автоинкрементом, в 
зависимости от его типа выводим подходящий элемент формы */
	if ($key <> $name_f)
	{ 
		echo "<tr><td align=right bgcolor='#C2E3B6'><font size=2><b>&nbsp;". $name_f ."</b></font></td>";
		switch ($type)
		{
        	case "string":
            	$w = $len/5;
            	echo "<td><input type=text name=\"$name_f\"size = $w ></td>";
        	break;
        	case "int": 
            	$w =  $len/5;
            	echo "<td><input type=text name=\"$name_f\"size = $w ></td>";
        	break;  
        	case "blob":
            	echo "<td><textarea rows=6 cols=60 name=\"$name_f\"></textarea></td>";
        	break;   
    	} 
	}
    echo "</tr>";
}
echo "</table>";
echo "<input type=submit name='add' value='Add'>";
echo "</form>";
?>
<?php
	echo"<br><br>";
	echo "<form method=post action=delete.php>";
	echo "<table border=0 cellspacing=0 width=20%><tr><td bgcolor='ffff3f' align=center> Удалить строку из таблицы $table_name</td></tr>";
	echo "<tr><td align=right bgcolor='#C2E3B6'>id строки</td>";
	echo "<td><input type=text name=id size=$w></td>";
	echo "</tr></table>";
	echo "<input type=submit name='del' value='Delete'>";
	echo "</form>";
?>
</body>