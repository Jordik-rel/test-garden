<x-mail::message>
# Status etude de la demande de création de l'article {{$blog->title}} envoyée.

Suite à votre demande de publication d'article, une étude approfondi a été faite le document que vous souhaitez publié.

Après cette étude nous avons retenue un avis {{ $blog->status ? 'favorable': 'defavorable' }} pour la publication de votre article.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
