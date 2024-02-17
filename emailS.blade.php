

 <!DOCTYPE html>
<html>
<head>
    <title>Rappel d'expiration des contrats</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-logo {
            width: 150px;
            height: auto;
        }

        .title {
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .contract-list {
            list-style-type: disc;
            padding-left: 20px;
        }

        .contract-item {
            margin-bottom: 10px;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
        }

        .footer-text {
            font-size: 12px;
        }

        .company-name {
            font-size: 64px;
            font-weight: bold;
            color: #007BFF;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 10px;
        }

        .company-subtitle {
            font-size: 18px;
            color: #f3c623;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="company-name">SEHI</div>
            <div class="company-subtitle">Rappel d'expiration des contrats</div>
            <div class="subtitle">Bonjour, {{ $dietels['responsibleName'] }}</div>
        </div>

        <div class="contract-list">
            <p>Les contrats suivants arrivent à expiration prochainement :</p>
            <ul>
                @foreach ($dietels['contracts'] as $contract)
                    <li class="contract-item">
                        <strong>Id du contrat:</strong> {{ $contract->id }}<br>
                        <strong>Type de contrat:</strong> {{ $contract->typecontrat->designation }}<br>
                        <strong>Département:</strong> {{ $contract->departement->name }}<br>
                        <strong>Tiers:</strong> {{ $contract->tiers }}<br>
                        <strong>Date de début :</strong> {{ $contract->debut }}<br>
                        <strong>Date d'expiration:</strong> {{ $contract->fin }}
                    </li>
                @endforeach
            </ul>
        </div>

        <p>Veuillez prendre les mesures appropriées pour renouveler ou prolonger ces contrats.</p>
        <p>Je vous remercie !</p>

        <a href="http://localhost/ged/public/admin/contrats/edit-contrat/{{ $contract->id }}" class="cta-button">Renouveler les contrats</a>


        <div class="footer">
            <p class="footer-text">Cet e-mail a été envoyé automatiquement. Veuillez ne pas répondre.</p>
        </div>
    </div>
</body>
</html>



