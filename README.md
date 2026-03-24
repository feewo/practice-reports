# Управление отчетами по практикам и оценками
Проект представляет собой информационную систему для автоматизации процесса сдачи отчетов студентами по учебным практикам и выставления оценок преподавателями. Основные роли: студент и преподаватель.

# Стек технологий
- **Laravel** – PHP-фреймворк для построения REST API и бизнес-логики.
- **React** – библиотека для создания интерактивного пользовательского интерфейса.
- **Docker** – контейнеризация приложения для унификации окружения и упрощения развертывания.
- **Swagger (OpenAPI)** – автоматическая документация API, доступная через UI для тестирования и интеграции.

# Запуск 🚀
Бэк: создаем файл .env (пример в env.example) и заполняем данными удаленной базы данных. Далее:
```bash
docker-compose -f docker-compose.backend.yml up --build
```
Фронт: 
```bash
cd frontend
npm i
npm run start
```
Создать .env файл в /frontend и указать ```REACT_APP_API_URL="http://localhost:8000"```

# Маленькие фишки
Все маршруты api с примерами запросов, ответов и ошибок располагаются по адресу 
[**http://localhost:8000/api/documentation**](http://localhost:8000/api/documentation)

- Студент логин: student, пароль: 123
- Преподаватель логин: teacher, пароль: 123
- У всех пользователь пароль 123

# Создание пользователей через консоль

## Создание студента
```bash
php artisan user:create-student {login} {password} {surname} {name} {patronymic} {group_id}
```

**Пример:**
```bash
php artisan user:create-student ivanov pass123 Иванов Иван Иванович 1
```

## Создание преподавателя
```bash
php artisan user:create-teacher {login} {password} {surname} {name} {patronymic}
```

**Пример:**
```bash
php artisan user:create-teacher petrov pass456 Петров Петр Петрович
```