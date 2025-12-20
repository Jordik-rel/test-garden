<x-mail::message>
    <h2 style="text-align: center;color:forestgreen">Information de connexion suite à la demande création de compte</h2>

<x-mail::panel>
    <h4 style="font-weight: 500; color: #4a4a4a; margin-bottom: 15px;">
        Voici ci-dessous vos informations de connexion suite à votre demande de création de compte particulier sur Green Connect
    </h4>
    <div style="text-align: center; padding: 10px;margin-bottom: 15px;">
        <div style="display: flex;align-items: center;margin-bottom: 10px; justify-items: center;">
            <p style="color: #6b7280;">Username: <span style="text-align: center;font-size: 17px;margin-left: 5px;color:#111827">{{ $user->username }}</span></p>
        </div>
        <div style="display: flex; align-items: center;">
             <p style="color: #6b7280;">Password: <span style="text-align: center;font-size: 17px;margin-left: 5px;color:#111827">{{ $password }}</span></p>
        </div>
    </div>
</x-mail::panel>



<x-mail::button :url="route('login')">
Se connecter
</x-mail::button>

<p style="font-size: 12px;color: #6b6b6b;text-align: center">
    Si vous n’êtes pas à l’origine de cette demande, veuillez immédiatement contactez le support.
</p>

Merci,<br>
{{ config('app.name') }}

</x-mail::message>
