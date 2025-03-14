<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;

class ClassRoomController extends Controller
{
    /**
     * Mendapatkan daftar kelas dengan pagination
     */
    public function getClassRooms(Request $request)
    {
        // Ambil data kelas dengan pagination
        $classRooms = ClassRoom::orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal pembuatan
            ->paginate(15); // Menggunakan paginate dengan jumlah 15 data per halaman

        // Mengembalikan response JSON dengan data pagination
        return response()->json([
            'success' => true,
            'data' => $classRooms->items(), // Data kelas per halaman
            'meta' => [
                'current_page' => $classRooms->currentPage(),
                'from' => $classRooms->firstItem(),
                'last_page' => $classRooms->lastPage(),
                'per_page' => $classRooms->perPage(),
                'to' => $classRooms->lastItem(),
                'total' => $classRooms->total(),
            ],
            'links' => [
                'prev' => $classRooms->previousPageUrl(),
                'next' => $classRooms->nextPageUrl(),
            ]
        ]);
    }
}
