## Среда разработки
1. php - PHP 8.1.9
2. apache 2.4 + nginx 1.23
3. mysql 8.0


## Настройка проекта
1. Настройте подключение к бд в .env
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dbname
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

2. Run
    ```bash
    cd ltproj
    composer update
    ```
3. Загрузка миграций
    ```bash
    php artisan migrate
    ```

4. Загрузка тестовых пользователей в таблицу User и их контакты в Contacts
    ```bash
    php artisan db:seed
    ```


# Методы API

------------------------------------------------------------------------------------------



## Авторизация
1. Авторизацию сделал через мидлвер, проверяя auth_token у пользователя, отправляйте bearer-token через Authorization в каждом методе


------------------------------------------------------------------------------------------


## Список контактов авторизованного пользователя (свойства контакта: ФИО, дата рождения)
<details>
 <summary><code>GET</code> <code><b>/contact/my-contacts</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
Пример https://ibb.co/2PHJ24y
###### Ответ: Спмсок контактов этого пользователя.
</details>

------------------------------------------------------------------------------------------


## Массовое создание телефонных номеров у контакта
<details>
 <summary><code>POST</code> <code><b>/contact/phones/bulk-create</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | phone_numbers[] |  required | array   | ключи: phone и contact_id |

##### Пример https://ibb.co/FHh2qVt
###### Массовое изменение делать не стал, т.к. не понял условий изменения.
</details>

------------------------------------------------------------------------------------------

## Массовое создание email у контакта
<details>
 <summary><code>POST</code> <code><b>/contact/emails/bulk-create</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | emails[] |  required | array   | ключи: email и contact_id |

##### Пример https://ibb.co/8XF8KTD
###### Массовое изменение делать не стал, т.к. не понял условий изменения.
</details>

------------------------------------------------------------------------------------------

## Удаление номера телефона у контакта
<details>
 <summary><code>POST</code> <code><b>/contact/phones/delete</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | phone_id |  required | integer   | id номера телефона |

###### Удаление произойдет если контакт привязан к юзеру и находится в его книжке.
</details>

------------------------------------------------------------------------------------------

## Удаление email адреса у контакта
<details>
 <summary><code>POST</code> <code><b>/contact/emails/delete</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | email_id |  required | integer   | id почты |

###### Удаление произойдет если контакт привязан к юзеру и находится в его книжке.
</details>

------------------------------------------------------------------------------------------
## Поиск контакта по ФИО
<details>
 <summary><code>POST</code> <code><b>/contact/search</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | full_name |  required | string   | Имя контакта |
</details>

------------------------------------------------------------------------------------------

## Поиск контакта по телефону номера
<details>
 <summary><code>POST</code> <code><b>/contact/phones/search</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | phone |  required | numeric   | номер телефона |
</details>

------------------------------------------------------------------------------------------

## Поиск контакта по почте
<details>
 <summary><code>POST</code> <code><b>/contact/emails/search</b></code></summary>

##### headers
###### в Postman это Bearer Token во вкладке Authorization.
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | authorization |  required | string   | auth_token из таблицы user  |
##### Parameters
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | email |  required | string | почта |
</details>

------------------------------------------------------------------------------------------
