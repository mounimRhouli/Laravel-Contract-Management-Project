
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 30px;
        }

        h1 {
            font-size: 50px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 145px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: px;
        }

        .company-name {
            font-size: 32px;
            color: #5e3f6b;
            margin-bottom: 10px;
        }

        .typecontrat {
            margin-bottom: 10px;
            text-align: center;
            font-size: 23px;
        }

        .company-info p {
            margin: 5px 0;
            font-size: 13px;
        }

        .contract-details {
            border: 2px solid #5e3f6b;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f8f8f8;
        }

        .contract-details p {
            margin: 10px 0;
        }

        .contract-details strong {
            font-weight: bold;
        }

        .contract-terms {
            margin-bottom: 30px;
        }

        .contract-terms ul {
            padding-left: 20px;
            list-style-type: disc;
        }

        .contract-terms li {
            margin: 10px 0;
        }

        .contract-signature {
            margin-top: 50px;
            text-align: center;
        }

        .contract-signature p {
            margin: 0;
            margin-bottom: 10px;
        }

        .signature-line {
            border-bottom: 2px solid #333;
            width: 200px;
            margin: 0 auto;
        }

        .footer {
            margin-top: 12px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="header">
    <!-- Company name -->
    <div>
        <h1 class="company-name">SEHI</h1>
        <div class="typecontrat">
            <p><strong>Contrat de </strong> {{ $contrats->typecontrat->designation  }} </p>
        </div>
    </div>

    <!-- Contact details -->
    <div class="company-info">
        <p><strong>Date:</strong> {{ date('d/m/Y') }}</p>
        <p><strong>Email:</strong> sehi@menara.ma</p>
        <p><strong>Tél:</strong> 05-22-24-89-77</p>

    </div>
</div>

<div class="contract-details">
    <h2>Détails du contrat</h2>

    <p><strong>Date de début:</strong> {{ $contrats->debut }}</p>
    <p><strong>Date de fin:</strong> {{ $contrats->fin }}</p>
    <p><strong>Tiers:</strong> {{ $contrats->tiers }}</p>
    <p><strong>Département:</strong> {{ $contrats->departement->name }}</p>
    <p><strong>Responsable:</strong> {{ $contrats->responsable->name }}</p>
    <p><strong>Montant (DH):</strong> {{ $contrats->montant }}</p>

</div>

<div class="contract-terms">
    <h2>Termes et conditions du contrat</h2>
    <ul>

        <li>Le contrat entre en vigueur à partir de la date de début et reste valide jusqu'à la date de fin.</li>
        <li>Toute résiliation du contrat doit être notifiée par écrit au moins 30 jours à l'avance.</li>
        <li>Le montant du contrat doit être payé en totalité à la date de début.</li>

        <!-- Add more terms and conditions as needed -->
    </ul>

</div>
<p class="footer ">SEHI - Contrat {{ $contrats->typecontrat->designation }} - {{ date('Y') }}</p>


</body>
</html>



