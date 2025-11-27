# Запуск 🚀
Бэк:
```bash
docker-compose -f docker-compose.backend.yml up --build
```
Фронт: 
```bash
cd frontend
npm i
npm run start
```
Создать .env файл в frontend/src и указать ```REACT_APP_API_URL="http://localhost:8000"```

# Маленькие фишки
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