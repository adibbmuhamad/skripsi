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

        // Ambil data relasi tanpa pagination
        $achievements = $student->achievements()->get();
        $attendances = $student->attendances()->get();
        $healthReports = $student->healthReports()->get();
        $violations = $student->violations()->get();

        // Kembalikan data siswa dan relasi dalam bentuk JSON
        return response()->json([
            'student' => $student,
            'achievements' => [
                'data' => $achievements,
            ],
            'attendances' => [
                'data' => $attendances,
            ],
            'healthReports' => [
                'data' => $healthReports,
            ],
            'violations' => [
                'data' => $violations,
            ],
        ]);
    }
}
