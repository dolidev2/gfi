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
    <h1>Report de RDV de la commande {{ $commande->numero_commande }}</h1>
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
    <p>
        Cher client,<br><br>
        Nous souhaitons vous informer que le rendez-vous pour la commande <strong>n° {{ $commande->numero_commande }}</strong>, initialement prévu à la date du <strong>{{ date("d/m/Y", strtotime($commande->date_rdv)) }}</strong>, a été reporté à la nouvelle date du <strong>{{ date("d/m/Y", strtotime($report->date_rdv)) }}</strong>.<br><br>

        Motif du report : {{ $report->motif }}<br><br>

        Nous vous prions de bien vouloir nous excuser pour ce changement et restons à votre disposition pour toute information complémentaire.<br><br>
        Cordialement,<br>
    </p>
    <div id="notices">
        <div>DIRECTION</div>
    </div>
</main>
<footer>
    Imprimé le {{ date("d-m-Y H:i:s") }} par {{ $user->nom_complet }} / {{ $agence->nom }}
</footer>
</body>
</html>
