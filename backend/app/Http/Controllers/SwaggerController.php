<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Аутентификация и управление токенами"
 * )
 * @OA\Tag(
 *     name="Teacher",
 *     description="Функционал преподавателя"
 * )
 * @OA\Tag(
 *     name="Student", 
 *     description="Функционал студента"
 * )
 * @OA\Tag(
 *     name="Reports",
 *     description="Управление отчетами"
 * )
 * @OA\Info(
 *     title="Internship Management API",
 *     description="API for managing student internships and reports",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="admin@example.com",
 *         name="API Support"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="Local server"
 * )
 * @OA\Server(
 *     url="https://yourdomain.com/api",
 *     description="Production server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * 
 * @OA\Schema(
 *     schema="LoginRequest",
 *     required={"login", "password"},
 *     @OA\Property(property="login", type="string", example="teacher@example.com"),
 *     @OA\Property(property="password", type="string", example="password123")
 * )
 * 
 * @OA\Schema(
 *     schema="LoginResponse",
 *     @OA\Property(property="token", type="string", example="1|abc123..."),
 *     @OA\Property(
 *         property="user",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="login", type="string", example="teacher@example.com"),
 *         @OA\Property(property="role", type="string", example="teacher")
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="UserResponse",
 *     @OA\Property(
 *         property="user",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="login", type="string", example="teacher@example.com"),
 *         @OA\Property(property="role", type="string", example="teacher")
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="SetGradeRequest",
 *     required={"report_id", "grade"},
 *     @OA\Property(property="report_id", type="integer", example=1),
 *     @OA\Property(property="grade_type_id", type="integer", example=3),
 *     @OA\Property(property="comment", type="string", example="Отличная работа!")
 * )
 * 
 * @OA\Schema(
 *     schema="GradeResponse",
 *     @OA\Property(property="message", type="string", example="Оценка успешно выставлена"),
 *     @OA\Property(
 *         property="grade",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="report_id", type="integer", example=1),
 *         @OA\Property(property="grade", type="string", example="Зачет"),
 *         @OA\Property(property="comment", type="string", example="Отличная работа!")
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="StudentReport",
 *     @OA\Property(property="internship_title", type="string", example="Летняя практика"),
 *     @OA\Property(property="teacher", type="string", example="Иванов Иван Иванович"),
 *     @OA\Property(property="file_url", type="string", nullable=true, example="http://example.com/storage/reports/file.pdf"),
 *     @OA\Property(property="file_name", type="string", example="report.pdf"),
 *     @OA\Property(property="grade", type="integer", nullable=true, example=5),
 *     @OA\Property(property="comment", type="string", nullable=true, example="Хорошая работа"),
 *     @OA\Property(property="submitted_date", type="string", format="date-time", example="2023-06-15 10:30:00"),
 *     @OA\Property(property="deadline", type="string", format="date", example="2023-06-30"),
 *     @OA\Property(property="start_date", type="string", format="date", example="2023-06-01")
 * )
 * 
 * @OA\Schema(
 *     schema="TeacherReport",
 *     @OA\Property(property="report_id", type="integer", example=1),
 *     @OA\Property(property="student_fio", type="string", example="Иванов Иван Иванович"),
 *     @OA\Property(property="group", type="string", example="ПИ-201"),
 *     @OA\Property(property="file_url", type="string", example="https://localhost/storage/rewtf.pdf", nullable=true),
 *     @OA\Property(property="file_name", type="string", example="report.pdf"),
 *     @OA\Property(property="grade", type="string", example="4", nullable=true),
 *     @OA\Property(property="comment", type="string", nullable=true),
 *     @OA\Property(property="submitted_date", type="string", format="date-time"),
 *     @OA\Property(property="deadline", type="string", format="date"),
 *     @OA\Property(property="internship_title", type="string", example="Летняя практика")
 * )
 * 
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     @OA\Property(property="error", type="string", example="Доступно только для студентов"),
 *     @OA\Property(property="message", type="string", example="The provided credentials are incorrect.")
 * )
 * 
 * @OA\Tag(
 *     name="Groups",
 *     description="Управление учебными группами"
 * )
 */
class SwaggerController extends Controller
{
    // Этот контроллер служит только для документации Swagger
    // Реальная логика находится в соответствующих контроллерах
}