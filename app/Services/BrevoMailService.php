<?php

namespace App\Services;

use App\Models\Inquiry;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrevoMailService
{
    public function sendInquiryNotifications(Inquiry $inquiry): array
    {
        $inquiry->loadMissing('program.department');

        $selectedPackageDetails = $this->resolvePackageDetails($inquiry);

        $studentHtml = view('emails.student-package-confirmation', [
            'inquiry' => $inquiry,
            'program' => $inquiry->program,
            'packageDetails' => $selectedPackageDetails,
        ])->render();

        $adminHtml = view('emails.admin-inquiry-alert', [
            'inquiry' => $inquiry,
            'program' => $inquiry->program,
            'packageDetails' => $selectedPackageDetails,
        ])->render();

        $apiKey = (string) config('services.brevo.key');
        $senderEmail = (string) config('services.brevo.sender_email', 'admissions@giecollege.com');
        $senderName = (string) config('services.brevo.sender_name', 'Gordon International Eduventures College (GIEC)');
        $notifyEmail = (string) config('services.brevo.admissions_notify_email', 'admissions@giecollege.com');

        if ($apiKey === '') {
            Log::info('Brevo API key not configured; skipping live HTTP dispatch for inquiry.', [
                'inquiry_id' => $inquiry->id,
                'student_email' => $inquiry->email,
                'notify_email' => $notifyEmail,
            ]);

            return [
                'dispatched' => false,
                'reason' => 'missing_api_key',
                'student_sent' => false,
                'admin_sent' => false,
            ];
        }

        $studentSubject = $inquiry->program
            ? "GIEC Package & Application Confirmation: {$inquiry->program->title}"
            : 'GIEC Admissions Inquiry Confirmation — Colombo 03';

        $adminSubject = $inquiry->program
            ? "New GIEC Course Package Lead: {$inquiry->full_name} ({$inquiry->program->title})"
            : "New GIEC General Inquiry: {$inquiry->full_name}";

        $studentSent = $this->postEmail(
            $apiKey,
            $senderEmail,
            $senderName,
            [['email' => $inquiry->email, 'name' => $inquiry->full_name]],
            $studentSubject,
            $studentHtml,
            $notifyEmail
        );

        $adminSent = $this->postEmail(
            $apiKey,
            $senderEmail,
            $senderName,
            [['email' => $notifyEmail, 'name' => 'GIEC Admissions Office']],
            $adminSubject,
            $adminHtml,
            $inquiry->email
        );

        return [
            'dispatched' => true,
            'student_sent' => $studentSent,
            'admin_sent' => $adminSent,
        ];
    }

    protected function resolvePackageDetails(Inquiry $inquiry): ?array
    {
        if (! $inquiry->program || ! $inquiry->selected_package) {
            return null;
        }

        $packages = $inquiry->program->student_packages ?? [];
        foreach ($packages as $package) {
            if (($package['name'] ?? null) === $inquiry->selected_package) {
                return $package;
            }
        }

        return null;
    }

    protected function postEmail(
        string $apiKey,
        string $senderEmail,
        string $senderName,
        array $to,
        string $subject,
        string $htmlContent,
        ?string $replyToEmail = null
    ): bool {
        try {
            $payload = [
                'sender' => [
                    'email' => $senderEmail,
                    'name' => $senderName,
                ],
                'to' => $to,
                'subject' => $subject,
                'htmlContent' => $htmlContent,
            ];

            if ($replyToEmail) {
                $payload['replyTo'] = ['email' => $replyToEmail];
            }

            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])->timeout(10)->post('https://api.brevo.com/v3/smtp/email', $payload);

            if ($response->failed()) {
                Log::warning('Brevo transactional email API returned non-2xx response.', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'subject' => $subject,
                ]);

                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('Brevo transactional email dispatch failed.', [
                'message' => $e->getMessage(),
                'subject' => $subject,
            ]);

            return false;
        }
    }
}
