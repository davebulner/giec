<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        $inquiries = $this->filteredQuery($request)
            ->with('program')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.inquiries.index', [
            'inquiries' => $inquiries,
            'programs' => Program::orderBy('title')->get(['id', 'title']),
            'statuses' => Inquiry::STATUSES,
            'filters' => [
                'program_id' => $request->query('program_id', ''),
                'status' => $request->query('status', ''),
                'search' => $request->query('search', ''),
            ],
        ]);
    }

    public function updateStatus(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in(array_keys(Inquiry::STATUSES))],
        ]);

        $inquiry->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', "Status updated to " . Inquiry::STATUSES[$validated['status']] . " for {$inquiry->full_name}.");
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $inquiries = $this->filteredQuery($request)
            ->with('program')
            ->latest()
            ->get();

        $filename = 'giec-inquiries-' . now('Asia/Colombo')->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($inquiries) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID',
                'Submitted At (Colombo)',
                'Full Name',
                'Email',
                'Phone / WhatsApp',
                'Program',
                'Preferred Format',
                'Selected Package',
                'Status',
                'Message',
            ]);

            foreach ($inquiries as $inquiry) {
                fputcsv($handle, [
                    $inquiry->id,
                    $inquiry->created_at?->timezone('Asia/Colombo')->format('Y-m-d H:i:s'),
                    $inquiry->full_name,
                    $inquiry->email,
                    $inquiry->phone,
                    $inquiry->program?->title ?? 'General Inquiry',
                    $inquiry->preferred_format ?? '',
                    $inquiry->selected_package ?? '',
                    Inquiry::STATUSES[$inquiry->status] ?? $inquiry->status,
                    $inquiry->message ?? '',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $name = $inquiry->full_name;
        $inquiry->delete();

        return back()->with('success', "Inquiry from {$name} deleted.");
    }

    protected function filteredQuery(Request $request): Builder
    {
        return Inquiry::query()
            ->when($request->filled('program_id'), function (Builder $query) use ($request) {
                if ($request->query('program_id') === 'general') {
                    $query->whereNull('program_id');
                } else {
                    $query->where('program_id', $request->query('program_id'));
                }
            })
            ->when($request->filled('status'), function (Builder $query) use ($request) {
                $query->where('status', $request->query('status'));
            })
            ->when($request->filled('search'), function (Builder $query) use ($request) {
                $term = '%' . trim((string) $request->query('search')) . '%';
                $query->where(function (Builder $sub) use ($term) {
                    $sub->where('full_name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('phone', 'like', $term)
                        ->orWhere('selected_package', 'like', $term);
                });
            });
    }
}
