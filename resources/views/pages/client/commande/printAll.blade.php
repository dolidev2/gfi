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
    <h1>CLIENT {{ $client->nom_complet.' - '.$client->matricule }}</h1>
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
            <th colspan="2" class="desc">Numéro de commande</th>
            <th class="desc">Date de création</th>
            <th class="desc">Date de RDV</th>
            <th colspan="2" class="desc">Statut</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commandes as $commande)
            <tr>
                <td colspan="2" class="desc">{{ $commande->numero_commande }}</td>
                <td class="desc">{{ date("d-m-Y", strtotime($commande->created_at)) }}</td>
                <td class="desc">{{ date("d-m-Y", strtotime($commande->date_rdv)) }}</td>
                <td colspan="2" class="desc">
                    @if($commande->statut == env('STATUS_SUCCESS'))
                        <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Terminé</span>
                    @elseif($commande->statut == env('STATUS_FAILED'))
                        <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">En cours</span>
                    @endif
                </td>
            </tr>
            <tr></tr>
            <thead>
                <tr>
                    <th class="desc">Nom modèle</th>
                    <th class="desc">Prix modèle</th>
                    <th class="desc">Tissu</th>
                    <th class="desc">Quantité</th>
                    <th class="desc">Remise</th>
                    <th class="desc">Total</th>
                </tr>
            </thead>
            @if(isset($commande->composition) && count($commande->composition) > 0 )
                @foreach($commande->composition as $composition)
                    <tr>
                        <td class="desc">{{ $composition->modele->nom }}</td>
                        <td class="desc">{{ $composition->modele->prix }}</td>
                        @if(isset($composition->tissu ))
                            <td class="desc">{{ $composition->tissu->nom }}</td>
                        @else
                            <td class="desc">Auncun tissu</td>
                        @endif
                        <td class="desc">{{ $composition->quantite }}</td>
                        <td class="desc">{{ $composition->remise }}</td>
                        <td class="desc">{{ $composition->prix }}</td>
                    </tr>
                @endforeach
            @endif
            <tr></tr>
            <tr>
                <td colspan="2" class="unit">Montant total</td>
                <td colspan="2" class="unit">Montant versé</td>
                <td colspan="2" class="unit">Reliquat </td>
            </tr>
            <tr>
                <td colspan="2" class="total">{{ $commande->totalCommande }}</td>
                <td colspan="2" class="total">{{ $commande->totalVersement }}</td>
                <td colspan="2" class="total">{{ ($commande->totalCommande - $commande->totalVersement) }}</td>
            </tr>

        @endforeach
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
