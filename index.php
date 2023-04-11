<?php include 'persons.php'; ?>
<?php include 'functions.php'; ?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./style.css">
</head>

<body>
	<div class="wrapper">
		<main class="content">
			<article class="home-work">
				<div class="home-work-content">
					<section class="task">
						<h3 class="task__title">Задача №1</h3>
						<div class="task__text">
							<p>Результат работы функции:</p>
							<code class="task__code">
								<?= $name = getFullnameFromParts('Морозова', 'Ольга', 'Сергеевна'); ?>
							</code>
							<p>Результат работы функции:</p>
							<code class="task__code">
								<?php print_r(getPartsFromFullname($name)); ?>
							</code>
						</div>
					</section>
					<section class="task">
						<h3 class="task__title">Задача №2</h3>
						<div class="task__text">
							<p>Результат работы функции:</p>
							<code class="task__code">
								<?= getShortName($name); ?>
							</code>
						</div>
					</section>
					<section class="task">
						<h3 class="task__title">Задача №3</h3>
						<div class="task__text">
							<p>Результат работы функции:</p>
							<code class="task__code">
								<?php
								if (getGenderFromName($name) === 1) {
									echo 'мужской пол';
								} else if (getGenderFromName($name) === -1) {
									echo 'женский пол';
								} else {
									echo 'не удалось определить';
								}
								?>
							</code>
						</div>
					</section>
					<section class="task">
						<h3 class="task__title">Задача №4</h3>
						<div class="task__text">
							<p>Результат работы функции:</p>
							<code class="task__code">
								<pre><?php echo getGenderDescription($persons); ?></pre>
							</code>
						</div>
					</section>
					<section class="task">
						<h3 class="task__title">Задача №5</h3>
						<div class="task__text">
							<p>Результат работы функции:</p>
							<code class="task__code">
								<pre><?= getPerfectPartner('Премудрая', 'Василиса', 'Васильевна', $persons); ?></pre>
							</code>
						</div>
					</section>
				</div>
			</article>
		</main>


	</div>
</body>

</html>