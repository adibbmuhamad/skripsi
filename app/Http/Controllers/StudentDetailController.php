<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentDetailController extends Controller
{
    public function getStudentDetail(Request $request, $id)
    {
        // Ambil data siswa berdasarkan ID
        $student = Student::find($id);

        // Periksa apakah siswa ditemukan
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Ambil data relasi dengan pagination
        $achievements = $student->achievements()->paginate(10);
        $attendances = $student->attendances()->paginate(10);
        $healthReports = $student->healthReports()->paginate(10);
        $violations = $student->violations()->paginate(10);

        // Kembalikan data siswa dan relasi dalam bentuk JSON
        return response()->json([
            'student' => $student,
            'achievements' => [
                'data' => $achievements->items(),
                'meta' => [
                    'current_page' => $achievements->currentPage(),
                    'from' => $achievements->firstItem(),
                    'last_page' => $achievements->lastPage(),
                    'per_page' => $achievements->perPage(),
                    'to' => $achievements->lastItem(),
                    'total' => $achievements->total(),
                ],
                'links' => [
                    'prev' => $achievements->previousPageUrl(),
                    'next' => $achievements->nextPageUrl(),
                ],
            ],
            'attendances' => [
                'data' => $attendances->items(),
                'meta' => [
                    'current_page' => $attendances->currentPage(),
                    'from' => $attendances->firstItem(),
                    'last_page' => $attendances->lastPage(),
                    'per_page' => $attendances->perPage(),
                    'to' => $attendances->lastItem(),
                    'total' => $attendances->total(),
                ],
                'links' => [
                    'prev' => $attendances->previousPageUrl(),
                    'next' => $attendances->nextPageUrl(),
                ],
            ],
            'healthReports' => [
                'data' => $healthReports->items(),
                'meta' => [
                    'current_page' => $healthReports->currentPage(),
                    'from' => $healthReports->firstItem(),
                    'last_page' => $healthReports->lastPage(),
                    'per_page' => $healthReports->perPage(),
                    'to' => $healthReports->lastItem(),
                    'total' => $healthReports->total(),
                ],
                'links' => [
                    'prev' => $healthReports->previousPageUrl(),
                    'next' => $healthReports->nextPageUrl(),
                ],
            ],
            'violations' => [
                'data' => $violations->items(),
                'meta' => [
                    'current_page' => $violations->currentPage(),
                    'from' => $violations->firstItem(),
                    'last_page' => $violations->lastPage(),
                    'per_page' => $violations->perPage(),
                    'to' => $violations->lastItem(),
                    'total' => $violations->total(),
                ],
                'links' => [
                    'prev' => $violations->previousPageUrl(),
                    'next' => $violations->nextPageUrl(),
                ],
            ],
        ]);
    }
}
