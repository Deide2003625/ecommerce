<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #222;
        }
        .mail-container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(60, 80, 120, 0.12);
            padding: 40px 32px 32px 32px;
        }
        h2 {
            color: #2563eb;
            font-size: 1.7rem;
            margin-bottom: 18px;
            font-weight: 700;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(60, 80, 120, 0.08);
            margin: 24px 0;
            transition: background 0.2s;
        }
        .btn:hover {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
        }
        .footer {
            margin-top: 32px;
            font-size: 14px;
            color: #888;
            border-top: 1px solid #f0f0f0;
            padding-top: 18px;
        }
        .break-all {
            word-break: break-all;
            color: #2563eb;
            font-size: 13px;
        }
        p {
            margin-bottom: 14px;
        }
    </style>
</head>
<body>
    <div class="mail-container">
        <h2>🔒 Réinitialisation de votre mot de passe</h2>
        <p>Bonjour,</p>
        <p>Vous avez demandé la réinitialisation de votre mot de passe.<br>
        Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe :</p>
        <p style="text-align:center;">
            <a href="{{ $actionUrl }}" style="color:#fff !important;" class="btn">{{ $actionText ?? 'Changer mon mot de passe' }}</a>
        </p>
        <p style="color:#555;">Si vous n'avez pas demandé cette réinitialisation, ignorez simplement cet e-mail.</p>
        <p>Cordialement,<br><strong>{{ config('app.name') }}</strong></p>
        <div class="footer">
            <p>Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :</p>
            <p class="break-all">{{ $actionUrl }}</p>
        </div>
    </div>
</body>
</html>
