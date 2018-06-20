<?php
/**
 * Забираю JSON массив и парсером его в верстку
 * Работа с JSON масивами данных для вывода в верстку
 * ---------------------------------------------------------------------------------------------------------------------
 */
function get_webmasters()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, "https://aff.revenuelab.biz/afn-ui/top-bonus/?api_key=728cb888-5977-4fd5-890f-ee51569a67ea"); //ссылка на масив данных
    $output = curl_exec($ch);
    curl_close($ch);
    return  json_decode($output, true);
}
/**
 * забираю джейсон массив и парсером его в верстку
 * ---------------------------------------------------------------------------------------------------------------------
Пример данных которые забираются по ссылке - в данном примере 1 массив в котором 2 обьекта в которых по 4 ключа со значениями
[{"position":1,"username":"webmaster","bonusPoints":52615,"tickets":52},{"position":2,"username":"webmaster","bonusPoints":42530,"tickets":42}]
в данном примере имеется массив обьектов с ключами
массив взят в квадратные скобки
обьекты с ключами в фигурные скобки
к примеру ключь это "position":1 а его значение :1 --- так же ключь это "username":"webmaster" а его значение "webmaster"
http://php.net/manual/ru/function.array-slice.php - более подробно о array_slice и его значениях


Пример выводв данных на странице - так же можно выводить кастомные поля в цикле

    <?php $webmasters = get_webmasters(); ?> //передаю результат функции get_webmasters() в переменную $webmasters

    <?php foreach (array_slice($webmasters, 0, 5) as $value): ?> //забираю масив данных отдельно по обьекту и передаю в $value обьекты (в данных они взяты в фигурные скобки)
        <ul class="webmaster__list-row"> <-- // обьекты берутся с первого тоесть с offset-0 по пятый тоесть length-5 -->
            <li class="place">
                <div class="mobile-head"><?= $value['position'] ?></div> <-- // Беру обьекты из $value и вывожу через ?= (echo) значение ключа 'position' -->
            </li>
            <li class="name">
                <div class="mobile-head"><?= $value['username'] ?></div> <-- // Беру обьекты из $value и вывожу через ?= (echo) значение ключа 'username' -->
            </li>
            <li class="total">
                <div class="mobile-head"><?= $value['bonusPoints'] ?></div> <-- // Беру обьекты из $value и вывожу через ?= (echo) значение ключа 'bonusPoints' -->
            </li>
            <li class="count">
                <div class="mobile-head"><?= $value['tickets'] ?></div> <-- // Беру обьекты из $value и вывожу через ?= (echo) значение ключа 'tickets' -->
            </li>
        </ul>
    <?php endforeach ?>
 *
 *
 *
 * Получаю в итоге такой html в цикле 5 списков с ыерсткой и значениями

<ul class="webmaster__list-row">
    <li class="place">
        <div class="mobile-head">1</div>
    </li>
    <li class="name">
        <div class="mobile-head">webmaster</div>
    </li>
    <li class="total">
        <div class="mobile-head">52615</div>
    </li>
    <li class="count">
        <div class="mobile-head">52</div>
    </li>
</ul>

 */
