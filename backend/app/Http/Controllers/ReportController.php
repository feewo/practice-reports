<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadReportRequest;

class ReportController extends Controller
{
    /**
     * @OA\Post(
     *     path="/reports/upload",
     *     summary="Upload student report",
     *     description="Upload or update internship report file",
     *     tags={"Student"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"internship_id", "file"},
     *                 @OA\Property(
     *                     property="internship_id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Report updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Отчет успешно обновлен"),
     *             @OA\Property(
     *                 property="report",
     *                 type="object",
     *                 @OA\Property(property="id", example=12, type="integer"),
     *                 @OA\Property(property="student_id", example=3, type="integer"),
     *                 @OA\Property(property="internship_id", example=13, type="integer"),
     *                 @OA\Property(property="file_name", example="report.pdf", type="string"),
     *                 @OA\Property(property="file_path", example="https://localhost/storage/report.pdf", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Report created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Отчет успешно загружен"),
     *             @OA\Property(
     *                 property="report",
     *                 type="object",
     *                 @OA\Property(property="id", example=63, type="integer"),
     *                 @OA\Property(property="student_id", example=4, type="integer"),
     *                 @OA\Property(property="internship_id", example=2, type="integer"),
     *                 @OA\Property(property="file_name", example="report.pdf", type="string"),
     *                 @OA\Property(property="file_path", example="https://localhost/storage/report.pdf", type="string")
     *             )
     *         )
     *     )
     * )
     */
    public function uploadReport(UploadReportRequest $request)
    {
        $student = Auth::user()->student;
        $internship = Internship::find($request->internship_id);

        $existingReport = Report::where('student_id', $student->id)
            ->where('internship_id', $request->internship_id)
            ->first();

        $file = $request->file('file');
        $filePath = $file->store('reports', 'public');

        // Обновляем существующий отчет
        if ($existingReport) {
            if ($existingReport->file_exists) {
                Storage::disk('public')->delete($existingReport->file_path);
            }
            
            $existingReport->update([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => '/storage/' . $filePath
            ]);
            
            return response()->json([
                'message' => 'Отчет успешно обновлен',
                'report' => $existingReport
            ]);
        }

        // Создаем новый отчет
        $report = Report::create([
            'student_id' => $student->id,
            'internship_id' => $request->internship_id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath
        ]);

        return response()->json([
            'message' => 'Отчет успешно загружен',
            'report' => $report
        ], 201);
    }
}