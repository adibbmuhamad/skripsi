<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\HealthReport;
use Illuminate\Http\Request;
use App\Http\Controllers\HealthReportController;

class HealthReportController extends Controller
{
    /**
     * Mencari laporan kesehatan berdasarkan NISN dengan pagination
     */
    public function getHealthReportByNisn(Request $request, $nisn)
    {
        // Mencari siswa berdasarkan NISN
        $student = Student::where('nisn', $nisn)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
            ], 404);
        }

        // Ambil data laporan kesehatan dengan pagination
        $healthReports = HealthReport::where('student_id', $student->id)
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal laporan
            ->paginate(15); // Menggunakan paginate dengan jumlah 15 data per halaman

        // Mengembalikan response JSON dengan data pagination
        return response()->json([
            'success' => true,
            'data' => $healthReports->items(), // Data laporan kesehatan per halaman
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
            ]
        ]);
    }
}
