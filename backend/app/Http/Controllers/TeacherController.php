<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TeacherReportsRequest;

class TeacherController extends Controller
{
    /**
     * @OA\Get(
     *     path="/teacher/students-reports",
     *     summary="Get students reports for teacher",
     *     description="Retrieve all student reports for the authenticated teacher with filtering options",
     *     tags={"Teacher"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="course",
     *         in="query",
     *         description="Filter by course number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="group_id",
     *         in="query",
     *         description="Filter by group ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Reports retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="reports",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/TeacherReport")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden - user is not a teacher",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function getStudentsReports(TeacherReportsRequest $request)
    {
        $user = Auth::user();
        

        $teacher = $user->teacher;

        $query = Report::with([
                'student.user',
                'student.group',
                'internship',
                'grade.grade_type'
            ])
            ->whereHas('internship', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            })
            ->select('reports.*')
            ->join('students', 'reports.student_id', '=', 'students.id')
            ->join('groups', 'students.group_id', '=', 'groups.id')
            ->join('internships', 'reports.internship_id', '=', 'internships.id')
            ->orderBy('internships.end_date', 'asc')
            ->orderBy('students.surname', 'asc')
            ->orderBy('students.name', 'asc')
            ->orderBy('students.patronymic', 'asc');

        if ($request->filled('course')) {
            $query->where('groups.course', $request->course);
        }

        if ($request->filled('group_id')) {
            $query->where('students.group_id', $request->group_id);
        }

        $reports = $query->get();

        $result = $reports->map(function ($report) {
            return [
                'report_id' => $report->id,
                'student_fio' => trim($report->student->surname . ' ' . 
                                    $report->student->name . ' ' . 
                                    $report->student->patronymic),
                'group' => $report->student->group->name,
                'file_url' => $report->file_url,
                'file_name' => $report->file_name,
                'grade' => $report->grade?->grade_type?->type,
                'grade_comment' => $report->grade?->comment,
                'submitted_date' => $report->created_at?->format('Y-m-d H:i:s'),
                'deadline' => $report->internship->end_date,
                'internship_title' => $report->internship->title
            ];
        });

        return response()->json([
            'reports' => $result,
        ]);
    }
}