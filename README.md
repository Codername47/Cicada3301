# Cicada3301
Головоломка-квест, с уклоном в криптографию по мотивам знаменитого интернет-квеста. Каждый пользователь может наблюдать за своим прогрессом
# Установка
- composer install
- docker-compose up -d (установка mailcatcher для регистрации)
- В файле .env указать подключение к базе данных (база данных не входит в docker)
- php bin/console doctrine:create:schema (Ошибка может быть, если она уже создана)
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load
- symfony serve -d (Нужен Symfony CLI)
# Данные
Стандартная учетная запись администратора:
- admin:admin
Стандартная учетная запись пользователя:
- username:username
