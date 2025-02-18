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
    <h1>Merci pour vos précieux retours sur la commande</h1>
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
        Nous tenons à vous remercier chaleureusement pour vos remarques et commentaires suivants <strong>n° {{ $commande->numero_commande }}</strong><br>

        Remarques; : {{ $remarque->commentaire }}<br>

        Votre avis est essentiel pour nous, et nous prenons très au sérieux vos observations afin d'améliorer continuellement la qualité de notre service.<br>

        Chaque retour client nous permet de progresser et de mieux répondre à vos attentes. <br>Soyez assuré(e) que vos suggestions ont été transmises à notre équipe et seront prises en compte dans nos prochaines actions.<br>

        Nous vous remercions pour la confiance que vous nous accordez et restons à votre disposition pour toute question ou besoin supplémentaire.

        <br>Cordialement,<br>
        L'équipe {{ $agence->nom }}
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
