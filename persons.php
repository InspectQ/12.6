<?php
$persons = [
	[
		'fullname' => '  ИВАНОВ    Иван   Иванович',
		'job' => 'tester',
	],
	[
		'fullname' => 'Степанова Наталья Степановна',
		'job' => 'frontend-developer',
	],
	[
		'fullname' => 'Пащенко Владимир Александрович',
		'job' => 'analyst',
	],
	[
		'fullname' => 'Громов Александр Иванович',
		'job' => 'fullstack-developer',
	],
	[
		'fullname' => 'Славин Семён Сергеевич',
		'job' => 'analyst',
	],
	[
		'fullname' => 'Цой Владимир Антонович',
		'job' => 'frontend-developer',
	],
	[
		'fullname' => 'Быстрая Юлия Сергеевна',
		'job' => 'PR-manager',
	],
	[
		'fullname' => 'Шматко Антонина Сергеевна',
		'job' => 'HR-manager',
	],
	[
		'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
		'job' => 'analyst',
	],
	[
		'fullname' => 'Бардо Жаклин Фёдоровна',
		'job' => 'android-developer',
	],
	[
		'fullname' => 'Шварцнегер Арнольд Густавович',
		'job' => 'babysitter',
	],
];

foreach ($persons as $key => &$item) {
	// удаляем лишние пробелы по краям строки
	$item['fullname'] = trim($item['fullname']);

	// изменяем регистр в строке на нужный нам (реализуем в задаче №5)
	//$item['fullname'] = mb_convert_case($item['fullname'], MB_CASE_TITLE_SIMPLE);

	// удаляем лишние пробелы в строке, если такие будут (добавляем подстроки в массив)
	$arr = preg_split('/\s+/', $item['fullname']);
	// получаем строку из элементов массива с указанным разделителем
	$item['fullname'] = implode(' ', $arr);
}
?>