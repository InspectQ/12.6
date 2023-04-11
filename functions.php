<?php
// ===== Задание 1
// объединение в строку // передаем в функцию 3 строки
function getFullnameFromParts($surname, $name, $patronomyc) {
	$str = "{$surname} {$name} {$patronomyc}"; // склеиваем 3 строки в одну через пробел, используя "" 
	return $str; // возвращаем получившуюся строку
}

// разбиение строки на элементы массива // функция принимает строку
function getPartsFromFullname($str) {
	$array1 = ['surname', 'name', 'patronomyc']; // значения будем использовать как ключи
	$array2 = explode(' ', $str); // разбиваем строку на подстроки и помещаем их в массив
	// создаем новый массив с ключами из array1 и значениями из array2
	$full_name_values = array_combine($array1, $array2);
	return $full_name_values; // возвращаем полученный массив
}

// ===== Задание 2

function getShortName($str) { // функция принимает строку
	$arr = getPartsFromFullname($str); // преобразовываем строку в массив
	// сокращаем значение ключа 'surname' (первая буква + .)
	$arr['surname'] = mb_substr($arr['surname'], 0, 1) . '.';
	unset($arr['patronomyc']); // удаляем элемент из массива
	$arr = array_reverse($arr); // возвращаем массив в обратном порядке 
	$short_name = implode(' ', $arr); // получаем из массива строку
	return $short_name; // возвращаем получившуюся строку
}

// ===== Задание 3

function getGenderFromName($str) { // функция принимает строку
	$arr = getPartsFromFullname($str); // преобразовываем строку в массив
	$value = 0; // значение по умолчанию равно 0 

	if ( // если одно из условий истинное
		mb_strpos($arr['surname'], 'ва', -2) ||
		mb_strpos($arr['name'], 'a', -1) ||
		mb_strpos($arr['patronomyc'], 'вна', -3) ||
		mb_strpos($arr['patronomyc'], 'чна', -3)
	) {
		$value--; // то уменьшаем значение на 1
	} else if ( // если одно из условий истинное
		mb_strpos($arr['surname'], 'в', -1) ||
		mb_strpos($arr['name'], 'й', -1) ||
		mb_strpos($arr['name'], 'н', -1) ||
		mb_strpos($arr['patronomyc'], 'ич', -2)
	) {
		$value++; // то увеличиваем значение на 1
	}
	// если значение: < 0 - вернется -1, > 0 - вернется 1, == 0 - вернется 0
	return $value <=> 0;
}

// Задание 4

function getGenderDescription($array) {
	/*
	// тоже самое используя foreach()
	foreach ($array as $key => $value) {
		$result = getGenderFromName($value['fullname']);
		if ($result === 1) {
			$men[] = $value;
		} else if ($result === -1) {
			$women[] = $value;
		}
	}
	*/
	// отфильтрованный массив с мужскими именами
	$men = array_filter($array, function ($array) {
		$value = getGenderFromName($array['fullname']);
		return $value === 1;
	});
	// отфильтрованный массив с женскими именами
	$women = array_filter($array, function ($array) {
		$value = getGenderFromName($array['fullname']);
		return $value === -1;
	});
	// математика 
	$percent_of_men = count($men) / count($array) * 100; // получаем процент мужских имен
	$percent_of_men = round($percent_of_men, 1); // округляем
	$percent_of_women = count($women) / count($array) * 100; // получаем процент женских имен
	$percent_of_women = round($percent_of_women, 1); // округляем
	// НЕ создаем отдельный фильтрованный массив с именами, по кот. не удалось определить пол,
	// а просто вычитаем из 100 процент мужских и процент женских имен
	$percent_unknown_gender = 100 - $percent_of_men - $percent_of_women;
	// выводим строку в таком виде
	$info = <<<text
	Гендерный состав аудитории: 
	---------------------------
	Мужчины - {$percent_of_men} %
	Женщины - {$percent_of_women} %
	Не удалось определить - {$percent_unknown_gender} %
	text;
	return $info; // функция возвращает строку в нужном нам виде
}

// Задание 5

function getPerfectPartner($surname, $name, $patronomyc, $array) {
	$surname = trim(mb_convert_case($surname, MB_CASE_TITLE_SIMPLE)); // меняем регистр
	$name = trim(mb_convert_case($name, MB_CASE_TITLE_SIMPLE)); // меняем регистр
	$patronomyc = trim(mb_convert_case($patronomyc, MB_CASE_TITLE_SIMPLE)); // меняем регистр
	$current_user_name = getFullnameFromParts($surname, $name, $patronomyc); // склеиваем строку
	$user_gender = getGenderFromName($current_user_name); // 1||0||-1 (определяем пол указанного имени)
	if ($user_gender === 0) {
		return 'не удалось подобрать пару :(';
	}

	$random_index = array_rand($array); // получаем случайный индекс массива
	$random_user_name = ($array[$random_index]['fullname']); // получаем случайное имя из массива
	$random_user_gender = getGenderFromName($random_user_name); // определяем пол случайного имени из массива 

	// если указанный пол и случайный пол из массива равны ИЛИ пол из массива не удалось определить
	if ($user_gender === $random_user_gender || $random_user_gender === 0) {
		while (true) { // запускаем бесконечный цикл
			$random_index = array_rand($array); // получаем случайный индекс массива
			$random_user_name = ($array[$random_index]['fullname']); // получаем случайное имя из массива
			$random_user_gender = getGenderFromName($random_user_name); // определяем пол случайного имени из массива
			if ($user_gender !== $random_user_gender && $random_user_gender !== 0) break; // выходим из цикла если true
		}
	}

	$random_user_name = mb_convert_case($random_user_name, MB_CASE_TITLE_SIMPLE); // меняем регистр
	$random_user_short_name = getShortName($random_user_name); // сокращаем случайного имя из массива
	$current_user_short_name = getShortName($current_user_name); // сокращаем указанное имя
	// получаем случайное число от 50 до 100, с округлением до сотых 
	$random_percent = round(rand(5000, 10000) / 100, 2);
	// выводим строку в таком виде
	$info = <<<text
		 {$current_user_short_name} + {$random_user_short_name}  =
		 Идеально на {$random_percent}%  
		text;

	return $info; // функция возвращает созданную строку
}
?>