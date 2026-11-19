<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New GIEC Admissions Lead Alert</title>
</head>
<body style="margin:0; padding:0; background-color:#F8FAFC; font-family:'Inter', Arial, Helvetica, sans-serif; color:#1E293B;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#F8FAFC; padding:28px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" border="0" style="max-width:620px; width:100%; background-color:#FFFFFF; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden;">
                    <tr>
                        <td style="background-color:#18134E; padding:22px 28px; border-bottom:4px solid #C5922A;">
                            <p style="margin:0 0 4px 0; font-size:11px; text-transform:uppercase; letter-spacing:1.4px; color:#DFBC6D; font-weight:700;">
                                GIEC ADMISSIONS LEAD ALERT
                            </p>
                            <h1 style="margin:0; font-size:20px; color:#FFFFFF; font-weight:700;">
                                New Student Inquiry Received (#{{ $inquiry->id }})
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:26px 28px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #E2E8F0; border-radius:8px; background-color:#F8FAFC; margin-bottom:20px;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:14px;">
                                            <tr>
                                                <td width="38%" style="padding:6px 0; color:#64748B; font-weight:600;">Applicant Name:</td>
                                                <td style="padding:6px 0; color:#0F172A; font-weight:700;">{{ $inquiry->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Email Address:</td>
                                                <td style="padding:6px 0;"><a href="mailto:{{ $inquiry->email }}" style="color:#B45309; text-decoration:none; font-weight:600;">{{ $inquiry->email }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Phone / WhatsApp:</td>
                                                <td style="padding:6px 0;"><a href="tel:{{ $inquiry->phone }}" style="color:#0F172A; text-decoration:none; font-weight:600;">{{ $inquiry->phone }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Program Selected:</td>
                                                <td style="padding:6px 0; color:#0F172A; font-weight:700;">{{ $program?->title ?? 'General Admissions Inquiry' }}</td>
                                            </tr>
                                            @if($inquiry->preferred_format)
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Study Format:</td>
                                                <td style="padding:6px 0; color:#0F172A;">{{ $inquiry->preferred_format }}</td>
                                            </tr>
                                            @endif
                                            @if($inquiry->selected_package)
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Student Package:</td>
                                                <td style="padding:6px 0; color:#B45309; font-weight:700;">
                                                    {{ $inquiry->selected_package }}
                                                    @if($packageDetails && !empty($packageDetails['fee']))
                                                        ({{ $packageDetails['fee'] }})
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="padding:6px 0; color:#64748B; font-weight:600;">Submitted At:</td>
                                                <td style="padding:6px 0; color:#475569;">{{ $inquiry->created_at?->timezone('Asia/Colombo')->format('d M Y, h:i A') }} (Colombo)</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            @if($inquiry->message)
                            <div style="margin-bottom:22px; padding:14px 18px; background-color:#FFFBEB; border:1px solid #FDE68A; border-radius:8px;">
                                <p style="margin:0 0 6px 0; font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#B45309; font-weight:700;">
                                    Applicant Notes / Questions
                                </p>
                                <p style="margin:0; font-size:14px; line-height:1.6; color:#334155;">
                                    {{ $inquiry->message }}
                                </p>
                            </div>
                            @endif

                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $inquiry->phone);
                            @endphp
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding-right:10px; padding-bottom:8px;">
                                        <a href="mailto:{{ $inquiry->email }}?subject={{ urlencode('GIEC Admissions: ' . ($program?->title ?? 'Your Inquiry')) }}"
                                           style="display:inline-block; background-color:#18134E; color:#FFFFFF; text-decoration:none; font-size:13px; font-weight:700; padding:10px 16px; border-radius:6px;">
                                            Email Applicant
                                        </a>
                                    </td>
                                    <td style="padding-right:10px; padding-bottom:8px;">
                                        <a href="tel:{{ $inquiry->phone }}"
                                           style="display:inline-block; background-color:#1E1861; color:#FFFFFF; text-decoration:none; font-size:13px; font-weight:700; padding:10px 16px; border-radius:6px;">
                                            Call {{ $inquiry->phone }}
                                        </a>
                                    </td>
                                    @if($cleanPhone)
                                    <td style="padding-bottom:8px;">
                                        <a href="https://wa.me/{{ $cleanPhone }}"
                                           style="display:inline-block; background-color:#C5922A; color:#FFFFFF; text-decoration:none; font-size:13px; font-weight:700; padding:10px 16px; border-radius:6px;">
                                            WhatsApp Lead
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
