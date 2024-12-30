<?php

namespace App\Notifications;

use App\Models\OrderItems;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;


class OrderItemsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private OrderItems $orderItem, private $status)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {   
        $statusCommande = $this->orderItem->status;
      
        if($statusCommande === 'en cours'){
           $statusCommande = 'Votre commande de '
           .$this->orderItem->FreeFireCard->quantite_diamons.' diamants est en cours';
        }elseif($statusCommande === 'reussi'){
           $statusCommande = 'Votre commande de '.
           $this->orderItem->FreeFireCard->quantite_diamons.' diamants a reussi';
        }elseif($statusCommande === 'échoué'){
           $statusCommande = 'Votre transaction de '.
           $this->orderItem->FreeFireCard->quantite_diamons.' diamants a échoué';
        }elseif($statusCommande === 'remboursé'){
           $statusCommande = 'Votre transaction de '.
           $this->orderItem->FreeFireCard->quantite_diamons.' diamants est remboursé';
        }else{
          $statusCommande = 'Votre commande est invalide';
        } 
        return (new MailMessage)
                    ->subject('Status de votre commande ')
                    ->line('Achat de : '.$this->orderItem->FreeFireCard->nom)
                    ->lineIf($this->orderItem->FreeFireCard->quantite_diamons > 0, 
                    $statusCommande)
                    ->greeting('chers '.ucfirst($this->orderItem->user->nom))
                    ->action('Notification Action', url(route('dashboard')))
                    ->line('Thank you for using FastTopUp !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id_commande' => $this->orderItem->id,
            'status'      => $this->orderItem->status
        ];
    }
}
