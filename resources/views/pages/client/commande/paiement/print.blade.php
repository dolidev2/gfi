<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>{{ $client->nom_complet }}</title>
    <link rel="stylesheet" href="{{ public_path('assets/css/gfi/paiement/print.css') }}">
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="">
    </div>
    <h1>PAIEMENT DE COMMANDE {{ $commande->numero_commande }}</h1>
    <div id="company" class="clearfix">
        <div>{{ $agence->nom }}</div>
        <div>{{ $agence->adresse }}</div>
        <div>{{ $agence->contact }}</div>
        <div>{{ $agence->ifu }}</div>
        <div>{{ $agence->rccm }}</div>
        <div>{{ $agence->regime_imposition }}</div>
        <div>{{ $agence->division_fiscale }}</div>
        <div>{{ $agence->boite_postale }}</div>
        <div><a href="#">{{ $agence->email }}</a></div>
    </div>
    <div id="project">
        @if($client->statut_juridique == env('STATUS_JURIDIQUE_PARTICULIER'))
            <div> {{ $client->nom_complet }}</div>
            <div>{{ $client->adresse }}</div>
            <div>{{ $client->contact }}</div>
            <div>{{ $client->matricule }}</div>
        @elseif($client->statut_juridique == env('STATUS_JURIDIQUE_MORAL'))
            <div> {{ $client->nom_complet }}</div>
            <div>{{ $client->adresse }}</div>
            <div>{{ $client->contact }}</div>
            <div>{{ $client->matricule }}</div>
            <div>{{ $client->ifu }}</div>
            <div>{{ $client->rccm }}</div>
            <div>{{ $client->division_fiscale }}</div>
            <div>{{ $client->regime_imposition }}</div>
        @endif
            <div>{{ date("d-m-Y") }}</div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th colspan="2" class="desc">DESCRIPTION</th>
            <th>SOMME</th>
            <th>MODE DE PAIEMENT</th>
            <th>REFERENCE</th>
            <th>DATE</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="desc">{{ $paiement->description }}</td>
                <td class="unit">{{ $paiement->montant }}</td>
                <td class="qty">{{ $paiement->mode_paiement }}</td>
                <td class="total">{{ $paiement->numero_paiement }}</td>
                <td class="total">{{ date("d-m-Y", strtotime($paiement->created_at)) }}</td>
            </tr>
            <tr>
                <td colspan="4">Reliquat</td>
                <td class="total">{{ ($paiement->totalCommande - $paiement->totalVersement) }}</td>
            </tr>
        </tbody>
    </table>
    <div id="notices">
        <div>DIRECTION</div>
    </div>
</main>
<footer>
    Imprimé le {{ date("d-m-Y H:i:s") }} par {{ $user->nom_complet }} / {{ $agence->nom }}
</footer>
</body>
</html>
