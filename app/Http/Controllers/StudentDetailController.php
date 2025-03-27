<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentDetailController extends Controller
{
    public function getStudentDetail(Request $request, $id)
    {
        // Ambil data siswa berdasarkan ID
        $student = Student::with('classRoom')->find($id); // Mengambil relasi classRoom

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
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'parent_email' => $student->parent_email,
                'nisn' => $student->nisn,
                'address' => $student->address,
                'created_at' => $student->created_at,
                'updated_at' => $student->updated_at,
                'class_room_id' => $student->class_room_id,
                'class_room_name' => $student->classRoom ? $student->classRoom->name : null, // Menampilkan nama kelas
                'gender' => $student->gender,
                'parent_name' => $student->parent_name,
                'phone_number' => $student->phone_number,
            ],
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
