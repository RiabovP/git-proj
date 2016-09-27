<?php
  $connect=mysql_connect("localhost");                       // коннект к базе 
  $database = "test_db";
  $table_name = "zakazi";
  mysql_select_db($database);                                // выбираем базу данных
  $list_f = mysql_list_fields($database,$table_name);        // Определяем поля в таблице
  $n = mysql_num_fields($list_f);                            // число полей в таблице
  $sql = "INSERT INTO $table_name SET ";                     // Создание начального запроса
  for($i=0;$i<$n; $i++)
  {
      $name_f = mysql_field_name ($list_f,$i);               // определение имя поля
      $value = $_POST[$name_f];                              // вывод введеных данных из глобального массива значение поля
      $j = $i + 1;
      $sql = $sql . $name_f." = '$value'";                   // приписываем к запросу первое поле 
      if ($j <> $n) $sql = $sql . ", ";                      // если поле не последнее, то ставим зпт
  }
  $result = mysql_query($sql, $connect);                     // Отправка запроса на сервер
  
  if($result)                                                // ПРоверка выполнения запроса
    echo"<h2 align=center>Данные успешно занесены</h2>";
  else echo "<h1>Ошибка внесения данных</h1>";

  echo "<form action=index.php>";
    echo "<input type=submit name='add' value='Вернуться'>";
  echo "</form>";
?>
