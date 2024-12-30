<x-mail::message>
# Bienvenue chers {{ $user['nom'] }} {{ $user['prenom'] }}

<x-mail::panel>
    L'equipe de fast topup est ravie de vous compter parmis nous !
    Bienvenue dans cette nouvelle famille nous sommes disponible pour 
    tous vos besoins aprospos de nos services

    Avant de commencer de jouir de nos services, il est obligatoire de verifier
    ton email pour pouvoir acceder a votre espace d'utilisateur 
</x-mail::panel>

<x-mail::button :url="$url" color="green">
verify now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
