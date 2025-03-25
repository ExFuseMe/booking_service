# Тестовый проект компании ЦПО


## Установка + развёртка проекта
Важно:
1. скопировать env файл из env example
2. Наличие установленного docker
```bash
composer i
vendor/bin/sail up -d
vendor/bin/sail artisan key:generate
```
## Миграции бд
```bash
vendor/bin/sail artisan migrate:fresh --seed
```
## Ре-build swagger
Важно - не забудьте вставить Bearer token из запроса Auth/Login в input на странице сваггера
```bash
vendor/bin/sail artisan l5-swagger:generate
```

## Запуск очередей(для проверки нотификаций)
очереди настроены через бд
```bash
vendor/bin/sail artisan queue:work
```

## Запуск тестов
```bash
vendor/bin/sail artisan test
```


### Small info о проекте:
1. Все сваггер схемы(requests и resources) расположены в app/Swagger - удобно переиспользовать и масштабить в продуктах
2. Реализован observer для отслеживания создания и удаления bookings
3. Все repositories extend-ятся от самописного CoreRepository, который можно замасштабить(Реальный пример - для поиска/выборки полей, которые будут выбираться в репозитариях у entities)
4. Написаны маленькие, быстренькие test-ы, так как тесты в основном провожу лично руками через swagger/postman
