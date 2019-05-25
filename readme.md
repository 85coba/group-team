<h2>Restful api додаток для ведення футбольних груп.</h2>
<p>Реалізовано наступний функціонал:</p>
<ol>
    <li>Створення та видалення груп</li>
    <li>Додавання та видаленнякоманд у та з групи<li>
    <li>Генерація матчів у групі</li>
    <li>Зміна результату конкретного матчу</li>
    <li>Дані такі як групи, команди та результати ігор зберігаються в базі даних</li>
</ol>
<p>Для побудови додатка використав:</p>
<ol>
    <li>Backend - Laravel 5.8</li>
    <li>Frontend - VueJS ( + vue-route)</li>
    <li>Збереження даних - MySQL</li>
</ol>
<p>Список маршутів API:</p>
   GET | api/group                         | App\Http\Controllers\Groups@index </br>
  POST | api/group                         | App\Http\Controllers\Groups@store </br>
   GET | api/group/{group}                 | App\Http\Controllers\Groups@show  </br>
DELETE | api/group/{group}                 | App\Http\Controllers\Groups@destroy </br>
  POST | api/group/{group}/matches         | App\Http\Controllers\MatchesController@store </br>
   PUT | api/group/{group}/matches/{match} | App\Http\Controllers\MatchesController@update </br>
  POST | api/group/{group}/teams           | App\Http\Controllers\TeamsController@store </br>
DELETE | api/group/{group}/teams/{team}    | App\Http\Controllers\TeamsController@destroy </br>
    
