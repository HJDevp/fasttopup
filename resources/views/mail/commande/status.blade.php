<x-mail::message>
# Cher {{ ucfirst($orderItem->user['nom']) . ' '. $orderItem->user['prenom'] }}
**Statut de la commande**
<hr>
Information sur la commande
@php
$statusCommande = $orderItem->status;    
        if($statusCommande === 'en cours'){
            $color = "bleu";
            $statusCommande = 'votre commande de '.
            $orderItem->FreeFireCard->quantite_diamons.' diamants est en cours';
        }elseif($statusCommande === 'reussi'){
           $color = 'green';
           $statusCommande = 'votre commande de '.
           $orderItem->FreeFireCard->quantite_diamons.' diamants a reussi';
        }elseif($statusCommande === 'échoué'){
           $color = "red";
           $statusCommande = 'votre transaction de '.
           $orderItem->FreeFireCard->quantite_diamons.' diamants a échoué';
        }elseif($statusCommande === 'remboursé'){
           $color = "teal";
           $statusCommande = 'votre transaction de '.
           $orderItem->FreeFireCard->quantite_diamons.' diamants est remboursé';
        }else{
          $statusCommande = 'votre commande est invalide';
        } 
@endphp

<x-mail::panel>
- Nom de la carte   : {{ $orderItem->FreeFireCard['nom'] }}
- Qty diamant       : {{ $orderItem->FreeFireCard['quantite_diamons'] }}diamants
- Prix              : {{ $orderItem->FreeFireCard['prix'] }} HTG

*Message*: <br/>
{{ $statusCommande }}

*Description de la carte*: <br/>
{{$orderItem->FreeFireCard->descriptions['description']}}
</x-mail::panel>

<x-mail::button :url="$url" color="{{$color}}">
voir la commande
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
