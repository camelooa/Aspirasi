<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Baru</title>
</head>
<body style="margin:0; padding:0; background:#F4F1EB;">
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        Aspirasi baru dibuat untuk kategori {{ $category->name }}.
    </div>

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#F4F1EB; padding: 24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" style="width:600px; max-width:600px;">
                    <tr>
                        <td style="background:#0C2240; padding:18px 22px; border-radius:16px 16px 0 0;">
                            <p style="margin:0; font-family: Arial, Helvetica, sans-serif; font-size:12px; letter-spacing:2.2px; text-transform:uppercase; color: rgba(255,255,255,0.75); font-weight:700;">Merdeka Aspirasi</p>
                            <p style="margin:6px 0 0; font-family: Arial, Helvetica, sans-serif; font-size:20px; color:#FFFFFF; font-weight:900;">Aspirasi Baru Diterima</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#FFFFFF; border:1px solid #E2DDD5; border-top:0; padding:22px; border-radius:0 0 16px 16px;">
                            <p style="margin:0 0 10px; font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#0F172A;">Halo <strong>Tim {{ $category->name }}</strong>,</p>
                            <p style="margin:0 0 16px; font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#334155;">Sebuah aspirasi baru telah dibuat oleh siswa untuk kategori <strong>{{ $category->name }}</strong>.</p>

                            <div style="border:1px solid #E2DDD5; border-left:4px solid #E5A411; border-radius:14px; padding:16px; background:#FFFFFF;">
                                <p style="margin:0 0 10px; font-family: Arial, Helvetica, sans-serif; font-size:11px; letter-spacing:2.2px; text-transform:uppercase; color:#64748B; font-weight:900;">Ringkasan</p>

                                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse;">
                                    <tr>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#64748B; font-weight:800; text-transform:uppercase; letter-spacing:1.6px;">Nama Siswa</td>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:13px; color:#0F172A; font-weight:700;" align="right">{{ $student->full_name }} ({{ $student->username }})</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#64748B; font-weight:800; text-transform:uppercase; letter-spacing:1.6px;">Kategori</td>
                                        <td style="padding:6px 0;" align="right">
                                            <span style="display:inline-block; padding:6px 10px; border-radius:999px; background:#0C2240; color:#FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:800;">{{ $category->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#64748B; font-weight:800; text-transform:uppercase; letter-spacing:1.6px;">Judul</td>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:13px; color:#0F172A; font-weight:700;" align="right">{{ $aspirasi->feedback_title }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#64748B; font-weight:800; text-transform:uppercase; letter-spacing:1.6px;">Tanggal</td>
                                        <td style="padding:6px 0; font-family: Arial, Helvetica, sans-serif; font-size:13px; color:#0F172A; font-weight:700;" align="right">{{ $aspirasi->created_at->format('d F Y, H:i') }} WIB</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="margin-top:16px;">
                                <p style="margin:0 0 8px; font-family: Arial, Helvetica, sans-serif; font-size:11px; letter-spacing:2.2px; text-transform:uppercase; color:#64748B; font-weight:900;">Detail Aspirasi</p>
                                <div style="border:1px solid #E2DDD5; border-radius:14px; padding:14px; background:#FFFFFF;">
                                    <p style="margin:0; font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#334155; line-height:1.6; white-space:pre-line;">{{ $aspirasi->details }}</p>
                                </div>
                            </div>

                            @if($aspirasi->image)
                                <div style="margin-top:16px;">
                                    <p style="margin:0 0 8px; font-family: Arial, Helvetica, sans-serif; font-size:11px; letter-spacing:2.2px; text-transform:uppercase; color:#64748B; font-weight:900;">Gambar Terlampir</p>
                                    <div style="border:1px solid #E2DDD5; border-radius:14px; padding:12px; background:#FFFFFF; text-align:center;">
                                        <img src="{{ $message->embed(storage_path('app/public/' . $aspirasi->image)) }}" alt="Aspirasi Image" style="max-width: 100%; height: auto; border-radius: 10px; display:block; margin:0 auto;">
                                    </div>
                                </div>
                            @endif

                            <div style="margin-top:18px; padding-top:14px; border-top:1px solid #E2DDD5;">
                                <p style="margin:0; text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#94A3B8;">Email ini dikirim otomatis dari sistem. Silakan login untuk memberikan tanggapan.</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:12px 4px;">
                            <p style="margin:0; text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#94A3B8;">&copy; {{ date('Y') }} Merdeka Aspirasi</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
