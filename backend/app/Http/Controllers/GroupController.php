<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Groups",
 *     description="Управление учебными группами"
 * )
 * 
 * @OA\Schema(
 *     schema="Group",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="ПИ-101"),
 *     @OA\Property(property="course", type="integer", example=1),
 * )
 * 
 * @OA\Schema(
 *     schema="GroupsListResponse",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Group")
 *     )
 * )
 */
class GroupController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/groups",
     *     summary="Get a list of groups",
     *     description="Returns a list of all study groups with the ability to filter by course",
     *     tags={"Groups"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="course",
     *         in="query",
     *         description="Filter by course number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             minimum=1,
     *             maximum=6,
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The list of groups was successfully received.",
     *         @OA\JsonContent(ref="#/components/schemas/GroupsListResponse")
     *     ),
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Group::query()
            ->select(['id', 'name', 'course']);

        if ($request->filled('course') && ctype_digit($request->course)) {
            $course = (int) $request->course;
            $query->where('course', $course);
        }

        $groups = $query->get();

        return response()->json([
            'data' => $groups
        ]);
    }
}