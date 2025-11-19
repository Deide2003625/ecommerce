<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification de votre adresse e-mail</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; color: #333; }
        .mail-container { max-width: 480px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 32px; }
        .btn { display: inline-block; background: #3b82f6; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold; margin: 24px 0; }
        .footer { margin-top: 32px; font-size: 14px; color: #888; }
        .break-all { word-break: break-all; }
    </style>
</head>
<body>
    <div class="mail-container">
        <h2>Vérification de votre adresse e-mail</h2>
        <p>Bonjour,</p>
        <p>Merci de vous être inscrit. Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail :</p>
        <p style="text-align:center;">
            <a href="{{ $actionUrl }}" class="btn">{{ $actionText ?? 'Vérifier mon adresse e-mail' }}</a>
        </p>
        <p>Si vous n'avez pas créé de compte, ignorez simplement cet e-mail.</p>
        <div class="footer">
            <p>Cordialement,<br>{{ config('app.name') }}</p>
            <p>
                Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :<br>
                <span class="break-all">{{ $actionUrl }}</span>
            </p>
        </div>
    </div>
</body>
</html>
