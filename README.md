# laravel_test

<h2>Api запросы:</h2>
<ul>
<li>POST api/register - Регистрация пользователя, получение Bearer access_token для дальнейшей аутентификации</li>
<li>POST api/login - Ввод логина и пароля, получение Bearer access_token для аутентификации</li>
<li>POST api/paste - Создание пасты</li>
<li>GET api/paste/{paste_uri} - Получение пасты по ссылке</li>
<li>GET api/recent-pastes - Получение недавних public паст</li>
<li>GET api/recent-user-pastes - Получение недавних паст текущего пользователя, требуется авторизация</li>
<li>GET api/user-pastes - Получение паст текущего пользователя, пагинация через параметр ?page=1, требуется авторизация</li>
<li>POST api/paste/{paste_uri}/complaint - Создание жалобы по ссылке пасты, требуется авторизация</li>
</ul>
