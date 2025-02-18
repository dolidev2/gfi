<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $client->nom_complet }}</title>
    <link rel="stylesheet" href="{{ public_path('assets/css/gfi/paiement/print.css') }}">
</head>

<body>
<header class="clearfix">
    <div id="logo">
        <img src="public/image/logo/logo.jpeg">
    </div>
    <h1>MESURE</h1>
    <div id="company" class="clearfix">
        <div>{{ $agence->nom }}</div>
        <div>{{ $agence->adresse }}</div>
        <div>{{ $agence->contact }}</div>
        <div><a href="#">{{ $agence->email }}</a></div>
        <div>{{ $agence->ifu }}</div>
        <div>{{ $agence->rccm }}</div>
        <div>{{ $agence->regime_imposition }}</div>
        <div>{{ $agence->division_fiscale }}</div>
        <div>{{ $agence->boite_postale }}</div>
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
            <th colspan="2" class="desc">Désignation</th>
            <th>Mesure</th>
        </tr>
        </thead>
        <tbody>
        @if (!empty($mesure->epaule))
            <tr>
                <td colspan="2" class="desc">Epaule</td>
                <td class="unit-mesure">{{ $mesure->epaule }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_epaule))
            <tr>
                <td colspan="2" class="desc">Largeuer Epaule</td>
                <td class="unit-mesure">{{ $mesure->l_epaule }}</td>
            </tr>
        @endif
        @if(!empty($mesure->carrure))
            <tr>
                <td colspan="2" class="desc">Carrure</td>
                <td class="unit-mesure">{{ $mesure->carrure }}</td>
            </tr>
        @endif
        @if (!empty($mesure->poitrine))
            <tr>
                <td colspan="2" class="desc">Poitrine</td>
                <td class="unit-mesure">{{ $mesure->poitrine }}</td>
            </tr>
        @endif
        @if (!empty($mesure->t_taille))
            <tr>
                <td colspan="2" class="desc">Tour Taille</td>
                <td class="unit-mesure">{{ $mesure->t_taille }}</td>
            </tr>
        @endif
        @if (!empty($mesure->ceinture))
            <tr>
                <td colspan="2" class="desc">Ceinture</td>
                <td class="unit-mesure">{{ $mesure->ceinture }}</td>
            </tr>
        @endif
        @if (!empty($mesure->bassin))
            <tr>
                <td colspan="2" class="desc">Bassin</td>
                <td class="unit-mesure">{{ $mesure->bassin }}</td>
            </tr>
        @endif
        @if (!empty($mesure->cuisse))
            <tr>
                <td colspan="2" class="desc">Cuisse</td>
                <td class="unit-mesure">{{ $mesure->cuisse }}</td>
            </tr>
        @endif
        @if (!empty($mesure->t_genou))
            <tr>
                <td colspan="2" class="desc">Tour Genou</td>
                <td class="unit-mesure">{{ $mesure->t_genou }}</td>
            </tr>
        @endif
        @if (!empty($mesure->bas))
            <tr>
                <td colspan="2" class="desc">Bas</td>
                <td class="unit-mesure">{{ $mesure->bas }}</td>
            </tr>
        @endif
        @if (!empty($mesure->cole))
            <tr>
                <td colspan="2" class="desc">Cole</td>
                <td class="unit-mesure">{{ $mesure->cole }}</td>
            </tr>
        @endif
        @if(!empty($mesure->t_manche))
            <tr>
                <td colspan="2" class="desc">Tour Manche</td>
                <td class="unit-mesure">{{ $mesure->t_manche }}</td>
            </tr>
        @endif
        @if (!empty($mesure->poignet))
            <tr>
                <td colspan="2" class="desc">Poignet</td>
                <td class="unit-mesure">{{ $mesure->poignet }}</td>
            </tr>
        @endif
        @if (!empty($mesure->dos))
            <tr>
                <td colspan="2" class="desc">Dos</td>
                <td class="unit-mesure">{{ $mesure->dos }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_taille))
            <tr>
                <td colspan="2" class="desc">Longueur Taille</td>
                <td class="unit-mesure">{{ $mesure->l_taille }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_chemise))
            <tr>
                <td colspan="2" class="desc">Longueur Chemise</td>
                <td class="unit-mesure">{{ $mesure->l_chemise }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_chemise_a))
            <tr>
                <td colspan="2" class="desc">Longueur Chemise Arabe</td>
                <td class="unit-mesure">{{ $mesure->l_chemise_a }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_gilet))
            <tr>
                <td colspan="2" class="desc">Longueur Gilet</td>
                <td class="unit-mesure">{{ $mesure->l_gilet }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_veste))
            <tr>
                <td colspan="2" class="desc">Longueur Veste</td>
                <td class="unit-mesure">{{ $mesure->l_veste }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_genou))
            <tr>
                <td colspan="2" class="desc">Longueur Genou</td>
                <td class="unit-mesure">{{ $mesure->l_genou }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_pantalon))
            <tr>
                <td colspan="2" class="desc">Longueur Pantalon</td>
                <td class="unit-mesure">{{ $mesure->l_pantalon }}</td>
            </tr>
        @endif
        @if (!empty($mesure->pantacourt))
            <tr>
                <td colspan="2" class="desc">Longueur Pantacourt</td>
                <td class="unit-mesure">{{ $mesure->pantacourt }}</td>
            </tr>
        @endif
        @if (!empty($mesure->e_jambe))
            <tr>
                <td colspan="2" class="desc">Entre Jambe</td>
                <td class="unit-mesure">{{ $mesure->e_jambe }}</td>
            </tr>
        @endif
        @if (!empty($mesure->t_tete))
            <tr>
                <td colspan="2" class="desc">Tour de tête</td>
                <td class="unit-mesure">{{ $mesure->t_tete }}</td>
            </tr>
        @endif
        @if (!empty($mesure->e_p_poitrine))
            <tr>
                <td colspan="2" class="desc">Ecart Pince Poitrine</td>
                <td class="unit-mesure">{{ $mesure->e_p_poitrine }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_jupe))
            <tr>
                <td colspan="2" class="desc">Longueur Jupe</td>
                <td class="unit-mesure">{{ $mesure->l_jupe }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_robe))
            <tr>
                <td colspan="2" class="desc">Longueur Robe</td>
                <td class="unit-mesure">{{ $mesure->l_robe }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_poitrine))
            <tr>
                <td colspan="2" class="desc">Hauteur Poitrine</td>
                <td class="unit-mesure">{{ $mesure->l_poitrine }}</td>
            </tr>
        @endif
        @if (!empty($mesure->l_haut))
            <tr>
                <td colspan="2" class="desc">Longueur Haut</td>
                <td class="unit-mesure">{{ $mesure->l_haut }}</td>
            </tr>
        @endif
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
