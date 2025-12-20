<x-mail::message>
# Nouvelle création envoyée pour analyse.

Votre nouvel article dont le titre est: {{ $blog->title }} vient d'être envoyé pour analyse.
Merci de bien vouloir patientez. Un mail vous serez envoyé pour vous notifier le statut de l'analyse.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
