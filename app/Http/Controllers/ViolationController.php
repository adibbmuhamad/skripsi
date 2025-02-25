<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use App\Models\Student;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    /**
     * Mencari pelanggaran berdasarkan NISN dengan pagination
     */
    public function getViolationByNisn(Request $request, $nisn)
    {
        // Mencari siswa berdasarkan NISN
        $student = Student::where('nisn', $nisn)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
            ], 404);
        }

        // Ambil data pelanggaran dengan pagination
        $violations = Violation::where('student_id', $student->id)
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal pelanggaran
            ->paginate(15); // Menggunakan paginate dengan jumlah 15 data per halaman

        // Mengembalikan response JSON dengan data pagination
        return response()->json([
            'success' => true,
            'data' => $violations->items(), // Data pelanggaran per halaman
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
            ]
        ]);
    }
}
