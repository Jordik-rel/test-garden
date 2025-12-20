<x-mail::message>
# Achevement de la mission

La mission ayant pour titre: {{ $mission->projet->titre }} vient d'etre achevé par le jardinier {{ $mission->jardinier->user->prenom }} {{ $mission->jardinier->user->nom }}.

Veuillez-bien vouloir vous connectez et procéder au paiement des fonds qui doivent lui etre reversé.

Ces fonds s'èleve à {{ $mission->montant * 0.9 }} Franc CFA.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
