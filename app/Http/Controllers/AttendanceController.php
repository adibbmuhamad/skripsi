<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Menampilkan riwayat absensi siswa berdasarkan NISN dengan pagination
     */
    public function getAttendanceHistory(Request $request, $nisn)
    {
        // Mencari siswa berdasarkan NISN
        $student = \App\Models\Student::where('nisn', $nisn)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
            ], 404);
        }

        // Ambil data absensi dengan pagination
        $attendances = Attendance::where('student_id', $student->id)
            ->orderBy('date', 'desc') // Mengurutkan berdasarkan tanggal absensi
            ->paginate(15); // Menggunakan paginate dengan jumlah 15 data per halaman

        // Mengembalikan response JSON dengan data pagination
        return response()->json([
            'success' => true,
            'data' => $attendances->items(), // Data absensi per halaman
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
            ]
        ]);
    }
}
