---
## Описание

Этот проект представляет собой веб-приложение на базе Laravel, настроенное с использованием Docker.

## Требования
- Docker
- Docker Compose

## Установка и запуск

### 1. Клонируйте репозиторий

Откройте терминал и выполните команду:

```bash
git clone https://github.com/1Frayz/store.git
cd store
```

### 2. Создайте файл `.env`

Скопируйте файл `.env.example` и переименуйте его в `.env`:

```bash
cp .env.example .env
```

### 3. Запустите контейнеры

Используйте Docker Compose для запуска всех необходимых контейнеров:

```bash
docker-compose up -d
```

Это запустит контейнеры для вашего приложения Laravel, базы данных MySQL и Nginx.

### 4. Установите зависимости

После запуска контейнеров войдите в контейнер приложения и установите PHP-зависимости с помощью Composer:

```bash
docker-compose exec app composer install
```

### 5. Выполните миграции

После установки зависимостей выполните миграции базы данных:

```bash
docker-compose exec app php artisan migrate
```

### 6. Сгенерируйте ключ приложения

Сгенерируйте ключ для вашего приложения Laravel:

```bash
docker-compose exec app php artisan key:generate
```

### 7. Откройте приложение в браузере

Откройте ваш браузер и перейдите по адресу:

```
http://localhost
```

Вы должны увидеть ваше веб-приложение Laravel.

## Остановка и удаление контейнеров

Чтобы остановить и удалить контейнеры, используйте следующую команду:

```bash
docker-compose down
```

### Дополнительные команды

- **Просмотр логов**: Для просмотра логов приложения используйте:

  ```bash
  docker-compose logs
  ```

- **Войти в контейнер**: Для входа в контейнер приложения используйте:

  ```bash
  docker-compose exec app bash
  ```

## Примечания

- Убедитесь, что у вас установлен Docker и Docker Compose.
- Убедитесь, что файлы конфигурации и зависимости проекта правильно настроены.

## Структура проекта

- `app/` - Содержит ядро приложения.
- `bootstrap/` - Содержит файлы начальной загрузки и кеширования.
- `config/` - Содержит все конфигурационные файлы.
- `database/` - Миграции базы данных и сидеры.
- `public/` - Публичные файлы, такие как index.php и ресурсы.
- `resources/` - Шаблоны и локализации.
- `routes/` - Файлы маршрутов.
- `storage/` - Файлы, требующие постоянного хранения, такие как логи и сессии.
- `tests/` - Тесты приложения.
- `vendor/` - Пакеты, установленные через Composer.

## Лицензия

Этот проект лицензирован по [MIT License](LICENSE).
```
