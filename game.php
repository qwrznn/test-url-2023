<?php

$n = rand(1, 8); //Задумане число
$count = 0; // Кількість спроб
$text = ""; // Текст підсказки
$nameErr = ""; // Повідомлення про помилку
//echo $n."\n";
if (isset($_REQUEST['Submit'])) { // Якщо натиснута кнопка 'Submit'
  $n = $_REQUEST['n'];
  //echo $n."\n";
  $count = $_REQUEST['count'] + 1;// Збільшуємо лічильник на 1

  echo "$count спроба";

  if (empty($_REQUEST["my_number"])) { // Якщо нічого не ввели
    $nameErr = "Число обов'язкове для введення!";
  } else {
    $my_number = trim($_REQUEST["my_number"]);// Видаляємо зайві прогалини

    // перевірка, чи міститься лише число
    if (!preg_match("/^[1-8]$/", $my_number)) {
      $nameErr = "Дозволяється лише число від 1 до 8!";
    }
  }
  if ($nameErr === "") { // Якщо не було помилки
    if ($my_number > $n)
      $text = "Занадто багато!";
    elseif ($my_number < $n) {
      $text = "Замало!";
    } else {
      $text = "Точно! Вгадано з $count спроби!<br/>";
    }
  }

  if (isset($_POST['Clear'])) { // Якщо натиснута кнопка 'Clear'
    unset($_POST); // Видалення массиву $_POST
    $count = 0;
    $text = "";
    $nameErr = "";
    header("Location:".$_SERVER['PHP_SELF']); // Перечитуємо ту ж саму сторінку
    exit; // Выход
  }
}?>
<p>Вгадай число от 1 до 8:</p>
<form action="<?= $_SERVER['PHP_SELF']?>" name="myform" method="POST">
  <input type="text" name="my_number" size="5"><?= $text ?><?= $nameErr ?><br/>
  <input type="hidden" name="count" size="50" value="<?= $count ?>">

  <input type="hidden" name="n" size="50" value="<?= $n ?>">

  <input name="Submit" type="submit" value="Відправити"><br/>
  <input name="Clear" type="submit" value="Заново">
</form>