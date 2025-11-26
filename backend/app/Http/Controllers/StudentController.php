<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/student/reports",
     *     summary="Get student's reports",
     *     description="Retrieve all reports for the authenticated student",
     *     tags={"Student"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Reports retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/StudentReport")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden - user is not a student",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function getMyReports(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isStudent()) {
            return response()->json(['error' => 'Доступно только для студентов'], 403);
        }

        $student = $user->student;

        $reports = Report::with(['internship.teacher', 'grade.grade_type'])
            ->where('student_id', $student->id)
            ->join('internships', 'reports.internship_id', '=', 'internships.id')
            ->orderBy('internships.end_date', 'asc')
            ->select('reports.*')
            ->get();

        $result = $reports->map(function ($report) {
            $teacher = $report->internship->teacher;
            $teacherFullName = $teacher ? 
                $teacher->surname . ' ' . $teacher->name . ' ' . $teacher->patronymic 
                : null;

            return [
                'internship_title' => $report->internship->title,
                'teacher' => $teacherFullName,
                'file_url' => $report->file_url,
                'file_name' => $report->file_name,
                'grade' => $report->grade?->grade_type?->type,
                'comment' => $report->grade?->comment,
                'submitted_date' => $report->created_at ? $report->created_at->format('Y-m-d H:i:s') : null,
                'deadline' => $report->internship->end_date,
                'start_date' => $report->internship->start_date
            ];
        });

        return response()->json($result);
    }
}