<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Mencari achievement siswa berdasarkan NISN dengan pagination
     */
    public function getAchievementByNisn(Request $request, $nisn)
    {
        // Mencari siswa berdasarkan NISN
        $student = \App\Models\Student::where('nisn', $nisn)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
            ], 404);
        }

        // Ambil data achievement dengan pagination
        $achievements = Achievement::where('student_id', $student->id)
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal pembuatan achievement
            ->paginate(15); // Menggunakan paginate dengan jumlah 15 data per halaman

        // Mengembalikan response JSON dengan data pagination
        return response()->json([
            'success' => true,
            'data' => $achievements->items(), // Data achievement per halaman
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
            ]
        ]);
    }
}
