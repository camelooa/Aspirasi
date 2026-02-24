<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Aspirasi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .info-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #48bb78;
            border-radius: 4px;
        }
        .info-label {
            font-weight: bold;
            color: #38a169;
            margin-bottom: 5px;
        }
        .info-value {
            color: #333;
            margin-bottom: 15px;
        }
        .details-box {
            background-color: #f0fff4;
            border: 1px solid #c6f6d5;
            border-radius: 4px;
            padding: 15px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #48bb78;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Aspirasi Telah Ditanggapi</h1>
        </div>

        <p>Halo {{ $student->full_name }},</p>
        <p>Aspirasi Anda mengenai <strong>{{ $aspirasi->feedback_title }}</strong> telah ditanggapi oleh Admin.</p>

        <div class="info-section">
            <div class="info-label">📌 Judul Aspirasi:</div>
            <div class="info-value">{{ $aspirasi->feedback_title }}</div>

            <div class="info-label">📂 Kategori:</div>
            <div class="info-value"><span class="badge">{{ $aspirasi->kategori->name }}</span></div>
            
            <div class="info-label">📅 Tanggal Ditanggapi:</div>
            <div class="info-value">{{ now()->format('d F Y, H:i') }} WIB</div>
        </div>

        <div class="info-label">💬 Tanggapan Admin:</div>
        <div class="details-box">
            {{ $aspirasi->admin_response }}
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis dari Sistem Aspirasi KKA.</p>
            <p>Terima kasih atas partisipasi Anda.</p>
        </div>
    </div>
</body>
</html>
