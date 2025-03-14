<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentDetailController extends Controller
{
    public function getStudentDetail($id)
    {
        // Ambil data siswa berdasarkan ID
        $student = Student::with([
            'achievements',
            'attendances',
            'classRoom',
            'healthReports',
            'violations'
        ])->find($id);

        // Periksa apakah siswa ditemukan
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Kembalikan data siswa dalam bentuk JSON
        return response()->json($student);
    }
}
