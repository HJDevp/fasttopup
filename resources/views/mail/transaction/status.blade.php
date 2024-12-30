<x-mail::message>
# Cher {{ ucfirst($transaction['nom']). ' '. $transaction['prenom'] }} 
**Status de la transaction**
<hr>
Information de la transaction
@php
$statusTransaction = $transaction->status;

if($statusTransaction === 'en attente'){
   $color = 'bleu';
   $statusTransaction = 'votre transaction de '.$transaction->montant.' HTG  est mise en attente';
}elseif($statusTransaction === 'validé'){
   $color = 'green';
   $statusTransaction = 'votre transaction de '.$transaction->montant.' HTG  a reussi';
}elseif($statusTransaction === 'echoué'){
   $color = "red";
   $statusTransaction = 'votre transaction de '.$transaction->montant.' HTG  a echoué';
}else{
  $statusTransaction = 'votre transaction est invalide';
}  
@endphp

<x-mail::panel>

- Nom : {{ $transaction['nom']}} <br/>
- Prenom : {{ $transaction['prenom'] }} <br/>
- Telephone : +509 {{ $transaction['telephone'] }} <br/>
- Montant : {{ $transaction['montant'] }} HTG<br/>
- Methode de paiement : {{ $transaction['methode_de_paiement'] }} <br/>
- Achat de : {{ $transaction->FreeFireCard['nom'] }}

*Message* : <br/>
{{ $statusTransaction }}

</x-mail::panel>



<x-mail::button :url="$url" color="{{$color ?? ''}}">
voir la transaction
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
