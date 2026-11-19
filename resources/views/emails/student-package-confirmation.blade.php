<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIEC Student Package & Application Confirmation</title>
</head>
<body style="margin:0; padding:0; background-color:#F8FAFC; font-family:'Inter', Arial, Helvetica, sans-serif; color:#1E293B; -webkit-font-smoothing:antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#F8FAFC; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" border="0" style="max-width:640px; width:100%; background-color:#FFFFFF; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden;">
                    <!-- Top Header Banner -->
                    <tr>
                        <td style="background-color:#18134E; padding:28px 32px; border-bottom:4px solid #C5922A;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td valign="middle">
                                        <p style="margin:0 0 6px 0; font-size:11px; letter-spacing:1.6px; text-transform:uppercase; color:#DFBC6D; font-weight:700;">
                                            GORDON INTERNATIONAL EDUVENTURES COLLEGE
                                        </p>
                                        <h1 style="margin:0; font-size:22px; line-height:1.3; color:#FFFFFF; font-weight:700;">
                                            Student Package &amp; Admissions Summary
                                        </h1>
                                    </td>
                                    <td align="right" valign="middle" style="padding-left:12px;">
                                        <span style="display:inline-block; background-color:#C5922A; color:#FFFFFF; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; padding:6px 12px; border-radius:999px;">
                                            Confirmed
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 16px 0; font-size:16px; line-height:1.6; color:#0F172A; font-weight:600;">
                                Dear {{ $inquiry->full_name }},
                            </p>
                            <p style="margin:0 0 24px 0; font-size:15px; line-height:1.65; color:#475569;">
                                Thank you for connecting with <strong>Gordon International Eduventures College (GIEC)</strong>, Colombo 03. We have received your inquiry and prepared your official program and student package summary below. An Academic Admissions Advisor will reach out to you within 24 hours.
                            </p>

                            @if($program)
                            <!-- Selected Program & Student Package Summary Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#F8FAFC; border:1px solid #CBD5E1; border-left:4px solid #C5922A; border-radius:8px; margin-bottom:24px;">
                                <tr>
                                    <td style="padding:20px 24px;">
                                        <p style="margin:0 0 4px 0; font-size:11px; text-transform:uppercase; letter-spacing:1.2px; color:#8F6315; font-weight:700;">
                                            Selected Academic Program
                                        </p>
                                        <h2 style="margin:0 0 14px 0; font-size:19px; line-height:1.35; color:#18134E; font-weight:700;">
                                            {{ $program->title }}
                                        </h2>

                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:14px; color:#334155; border-top:1px solid #E2E8F0; padding-top:12px;">
                                            <tr>
                                                <td width="42%" style="padding:6px 0; color:#64748B; font-weight:600;">Accreditation:</td>
                                                <td style="padding:6px 0; color:#0F172A; font-weight:600;">{{ $program->accreditation }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Program Level:</td>
                                                <td style="padding:6px 0; color:#0F172A;">{{ $program->level }} &middot; {{ $program->department?->name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Preferred Format:</td>
                                                <td style="padding:6px 0; color:#0F172A;">{{ $inquiry->preferred_format ?? implode(', ', $program->formats ?? []) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Duration &amp; Intake:</td>
                                                <td style="padding:6px 0; color:#0F172A;">{{ $program->duration }} ({{ $program->next_intake }})</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Selected Package:</td>
                                                <td style="padding:6px 0; color:#B45309; font-weight:700;">
                                                    {{ $inquiry->selected_package ?? 'Standard Track' }}
                                                    @if($packageDetails && !empty($packageDetails['fee']))
                                                        &mdash; {{ $packageDetails['fee'] }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>

                                        @if($packageDetails && !empty($packageDetails['features']))
                                        <div style="margin-top:16px; padding-top:14px; border-top:1px solid #E2E8F0;">
                                            <p style="margin:0 0 8px 0; font-size:12px; text-transform:uppercase; letter-spacing:0.8px; color:#0F172A; font-weight:700;">
                                                Included Student Package Benefits
                                            </p>
                                            <ul style="margin:0; padding-left:18px; font-size:13px; line-height:1.65; color:#334155;">
                                                @foreach($packageDetails['features'] as $feature)
                                                <li style="margin-bottom:4px;">{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            @else
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#F8FAFC; border:1px solid #CBD5E1; border-left:4px solid #D97706; border-radius:8px; margin-bottom:24px;">
                                <tr>
                                    <td style="padding:18px 22px;">
                                        <p style="margin:0 0 6px 0; font-size:12px; text-transform:uppercase; letter-spacing:1px; color:#B45309; font-weight:700;">
                                            Your Submitted Message
                                        </p>
                                        <p style="margin:0; font-size:14px; line-height:1.6; color:#334155;">
                                            {{ $inquiry->message ?: 'General Admissions & Program Guidance Request' }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <!-- Enrollment Next Steps Checklist -->
                            <h3 style="margin:0 0 12px 0; font-size:16px; color:#0F172A; font-weight:700;">
                                Enrollment Next Steps Checklist
                            </h3>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:24px;">
                                <tr>
                                    <td style="padding:8px 0; font-size:14px; line-height:1.55; color:#334155;">
                                        <strong style="color:#D97706;">1. Academic Advisor Consultation:</strong> We will contact you on <strong>{{ $inquiry->phone }}</strong> to confirm batch schedules and scholarship/installment eligibility.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-size:14px; line-height:1.55; color:#334155;">
                                        <strong style="color:#D97706;">2. Placement &amp; Document Review:</strong> Prepare your NIC/Passport copy and highest academic transcripts (O/L, A/L, or Diploma).
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-size:14px; line-height:1.55; color:#334155;">
                                        <strong style="color:#D97706;">3. Seat Reservation &amp; Orientation:</strong> Lock in your intake seat via our Colombo 03 Galle Road campus or online portal.
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Buttons -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin-top:8px;">
                                <tr>
                                    <td style="padding-right:12px; padding-bottom:10px;">
                                        <a href="https://wa.me/94761561870?text={{ urlencode('Hello GIEC Admissions, I submitted an inquiry for ' . ($program?->title ?? 'GIEC Programs') . ' under ' . $inquiry->full_name) }}"
                                           style="display:inline-block; background-color:#C5922A; color:#FFFFFF; text-decoration:none; font-size:14px; font-weight:700; padding:12px 20px; border-radius:8px;">
                                            Chat on WhatsApp (+94 76 156 1870)
                                        </a>
                                    </td>
                                    <td style="padding-bottom:10px;">
                                        <a href="tel:+94761561870"
                                           style="display:inline-block; background-color:#18134E; color:#FFFFFF; text-decoration:none; font-size:14px; font-weight:700; padding:12px 20px; border-radius:8px;">
                                            Call Admissions Hotline
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#F1F5F9; padding:20px 32px; border-top:1px solid #E2E8F0; font-size:12px; line-height:1.6; color:#64748B;">
                            <strong style="color:#0F172A;">Gordon International Eduventures College (GIEC)</strong><br>
                            No. 408, 3rd Floor, Galle Road, Colombo 03, Sri Lanka<br>
                            Tel / WhatsApp: +94 76 156 1870 &middot; Web: <a href="{{ config('app.url') }}" style="color:#B45309; text-decoration:none;">giecollege.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
