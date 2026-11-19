<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Inquiry;
use App\Models\Program;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'total_programs' => Program::count(),
                'published_programs' => Program::published()->count(),
                'departments' => Department::count(),
                'total_inquiries' => Inquiry::count(),
                'new_inquiries' => Inquiry::where('status', 'new')->count(),
                'enrolled_inquiries' => Inquiry::where('status', 'enrolled')->count(),
            ],
            'recentInquiries' => Inquiry::query()
                ->with('program')
                ->latest()
                ->take(8)
                ->get(),
        ]);
    }
}
