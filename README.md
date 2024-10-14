## Задание 

Написать RESTful API на Laravel под фронт системы учета денежных операций (для аутентификации можно использовать встроенный Sanctum):

1. Модели (User, Role, Transaction) - наполнение по своему усмотрению, опираясь на логику.
2. Связи (Role-User - many2many, Transaction-User - many2one)
3. Endpoints:
   3.1. CRUD для User
   3.2. CRUD для Role
   3.3. CRUD для Transaction
4. Авторизация (плюсом будет использование Policies):
   4.1. Role могут создавать, изменять и удалять только пользователи с ролью admin
   4.2. User могут создавать, изменять только пользователи с ролью operator, а удалять только admin
   4.3. Transaction могут создавать, изменять и удалять только пользователи с ролью operator.
5. Привести примеры запросов для каждого Endpoint в Postman.
6. Плюсом будет кеширование листинга транзакций в Redis.
7. Плюсом будет использование Events (можно болванки сделать) для CRUD какой-либо модели.

## Запуск проекта

1. make setup
2. make compose
3. make compose-app-bash
4. make compose-setup

### Работа с Postman

1. Импортировать в Postman из директории Postman проекта
2. Выполнить запрос Auth/Login admin
3. Выполнить запрос Auth/Login operator
4. Выполнить запрос Auth/Login user
5. Заполнить environment токенами
6. Выполнить необходимые запросы

## Проект доступен по адресу

- http://localhost:8076/

## Точка входа апи

- http://localhost:8076/api/v1/
