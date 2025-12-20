<x-mail::message>
# Demande de validation de création de post

Une nouvel article vient d'être créer merci de bien vouloir vous connectez pour vérifier les informations avant de procéder à la validation.

<x-mail::button :url="route('login')">
Se Connecter
</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
