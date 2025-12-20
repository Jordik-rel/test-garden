<x-mail::message>
# Fin du projet

Le projet ayant pour titre: {{ $mission->projet->titre }} vient d'etre achevé par le jardinier {{ $mission->jardinier->user->prenom }} {{ $mission->jardinier->user->nom }}.

Veuillez-bien vouloir vous connectez et confirmer la fin de sa mission afin que ses fonds lui soit reversé.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
