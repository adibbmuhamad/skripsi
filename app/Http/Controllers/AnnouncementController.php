<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Menampilkan daftar pengumuman
     */
    public function getAnnouncements(Request $request)
    {
        $announcements = Announcement::orderBy('published_at', 'desc')->paginate(10); // Paginate 10 per halaman

        return response()->json([
            'success' => true,
            'data' => $announcements->items(),
            'meta' => [
                'current_page' => $announcements->currentPage(),
                'total' => $announcements->total(),
                'per_page' => $announcements->perPage(),
                'last_page' => $announcements->lastPage(),
            ],
            'links' => [
                'prev' => $announcements->previousPageUrl(),
                'next' => $announcements->nextPageUrl(),
            ]
        ]);
    }

    /**
     * Menambah pengumuman baru
     */
    public function createAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|in:important,info,event',
            'description' => 'required',
            'published_at' => 'nullable|date',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'published_at' => $request->published_at,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Announcement created successfully',
            'data' => $announcement
        ]);
    }
}
