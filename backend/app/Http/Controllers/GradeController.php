<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SetGradeRequest;

class GradeController extends Controller
{
    /**
     * Проверить, что отчёт принадлежит практике текущего учителя.
     *
     * @param int $reportId
     * @return \App\Models\Report|null
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    private function checkReportOwnership($reportId)
    {
        $teacher = Auth::user()->teacher;
        $report = Report::with('internship')->find($reportId);

        if (!$report || $report->internship->teacher_id !== $teacher->id) {
            abort(403, 'У вас нет прав для работы с этим отчётом.');
        }

        return $report;
    }
    
    /**
     * @OA\Post(
     *     path="/grades/set",
     *     summary="Set grade for report",
     *     description="Set or update grade for student report",
     *     tags={"Teacher"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SetGradeRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Grade set successfully",
     *         @OA\JsonContent(ref="#/components/schemas/GradeResponse")
     *     )
     * )
     */
    public function setGrade(SetGradeRequest $request)
    {
        $teacher = Auth::user()->teacher;

        // Проверяем, что отчет принадлежит практике этого учителя
        $report = Report::with('internship')->find($request->report_id);
        
        if (!$report || $report->internship->teacher_id !== $teacher->id) {
            return response()->json([
                'error' => 'У вас нет прав выставлять оценку за этот отчет'
            ], 403);
        }

        $grade = Grade::updateOrCreate(
            [
                'report_id' => $request->report_id,
            ],
            [
                'grade_type_id' => $request->grade_type_id,
                'comment' => $request->comment
            ]
        );

        // Загружаем связь с типом оценки
        $grade->load('grade_type');

        return response()->json([
            'message' => 'Оценка успешно выставлена',
            'grade' => [
                'id' => $grade->id,
                'report_id' => $grade->report_id,
                'grade_type' => $grade->grade_type->type,
                'comment' => $grade->comment,
                'created_at' => $grade->created_at,
                'updated_at' => $grade->updated_at
            ]
        ]);
    }

    /**
     * @OA\Put(
     *     path="/grades/{id}",
     *     summary="Update grade",
     *     description="Update an existing grade (reward) by its ID",
     *     tags={"Teacher"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Grade ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SetGradeRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Grade updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/GradeResponse")
     *     )
     * )
     */
    public function updateGrade(SetGradeRequest $request, $id)
    {
        $grade = Grade::findOrFail($id);
        // Проверяем, что отчёт, к которому привязана оценка, принадлежит учителю
        $this->checkReportOwnership($grade->report_id);

        $grade->update([
            'grade_type_id' => $request->grade_type_id,
            'comment'       => $request->comment,
        ]);

        $grade->load('grade_type');

        return response()->json([
            'message' => 'Оценка успешно обновлена',
            'grade'   => [
                'id'         => $grade->id,
                'report_id'  => $grade->report_id,
                'grade_type' => $grade->grade_type->type,
                'comment'    => $grade->comment,
                'created_at' => $grade->created_at,
                'updated_at' => $grade->updated_at,
            ],
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/grades/{id}",
     *     summary="Delete grade",
     *     description="Delete an existing grade (reward) by its ID",
     *     tags={"Teacher"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Grade ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Grade deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Оценка успешно удалена")
     *         )
     *     )
     * )
     */
    public function deleteGrade($id)
    {
        $grade = Grade::findOrFail($id);
        $this->checkReportOwnership($grade->report_id);

        $grade->delete();

        return response()->json(['message' => 'Оценка успешно удалена']);
    }
}