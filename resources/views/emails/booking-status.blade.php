<!-- Location: resources/views/emails/booking-status.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f3f4f6; padding: 40px 20px; margin: 0;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
        
        <!-- Header Design -->
        <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 30px; text-align: center;">
            <div style="display: inline-block; background: rgba(255,255,255,0.2); padding: 10px; border-radius: 12px; margin-bottom: 15px;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
                    <path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.025em;">AutoCare</h1>
            <p style="color: #bfdbfe; margin-top: 5px; font-size: 14px;">Service Status Update</p>
        </div>

        <!-- Main Content -->
        <div style="padding: 40px; color: #1f2937; line-height: 1.6;">
            <h2 style="margin-top: 0; font-size: 20px; font-weight: 700;">Hello {{ $booking->user->name }},</h2>
            <p style="font-size: 16px; color: #4b5563;">Good news! We have an update regarding your vehicle's service progress at our center.</p>
            
            <div style="margin: 30px 0; padding: 25px; background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                <h3 style="margin-top: 0; font-size: 14px; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; margin-bottom: 15px;">Booking Details</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; font-size: 14px; width: 120px;">Vehicle:</td>
                        <td style="padding: 8px 0; color: #1e293b; font-size: 14px; font-weight: 600;">{{ $booking->vehicle->license_plate }} ({{ $booking->vehicle->make }} {{ $booking->vehicle->model }})</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; font-size: 14px;">Service Type:</td>
                        <td style="padding: 8px 0; color: #1e293b; font-size: 14px; font-weight: 600;">{{ $booking->service->service_name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; font-size: 14px;">Appt. Date:</td>
                        <td style="padding: 8px 0; color: #1e293b; font-size: 14px; font-weight: 600;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px 0 8px 0; color: #64748b; font-size: 14px;">Current Status:</td>
                        <td style="padding: 15px 0 8px 0;">
                            <span style="background-color: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 800; text-transform: uppercase;">
                                {{ $booking->status }}
                            </span>
                        </td>
                    </tr>
                </table>

                @if($booking->notes)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px dashed #cbd5e1;">
                    <p style="margin: 0; color: #64748b; font-size: 13px; font-style: italic;">"{{ $booking->notes }}"</p>
                </div>
                @endif
            </div>

            <div style="text-align: center; margin-top: 35px;">
                <a href="http://localhost:8000/dashboard" style="background-color: #2563eb; color: #ffffff; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 15px; display: inline-block; transition: background 0.2s;">
                    View My Dashboard
                </a>
            </div>

            <p style="margin-top: 40px; font-size: 14px; color: #9ca3af; text-align: center;">
                If you have any questions, feel free to reply to this email or visit our center.<br>
                <strong>AutoCare Service Center</strong>
            </p>
        </div>
        
        <!-- Footer Color Strip -->
        <div style="height: 6px; background: linear-gradient(90deg, #2563eb 0%, #60a5fa 100%);"></div>
    </div>
</body>
</html>