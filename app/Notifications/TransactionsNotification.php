<?php

namespace App\Notifications;

use App\Models\Transactions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Transactions $transaction, private $status)
    {
        $this->afterCommit();
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
        $statusTransaction = $this->transaction->status;

        if($statusTransaction === 'en attente'){
           $statusTransaction = 'Votre transaction de '.$this->transaction->montant.' HTG  est mise en attente';
        }elseif($statusTransaction === 'validé'){
           $statusTransaction = 'Votre transaction de '.$this->transaction->montant.' HTG  a reussi';
        }elseif($statusTransaction === 'echoué'){
           $statusTransaction = 'Votre transaction de '.$this->transaction->montant.' HTG  a echoué';
        }else{
          $statusTransaction = 'Votre transaction est invalide';
        }  

        return (new MailMessage)
                    ->line('Status du paiement')
                    ->line('votre transaction est mise en attente')
                    ->greeting('Chers '.$this->transaction->nom.' '.
                    $this->transaction->prenom)
                    ->lineIf($this->transaction->montant > 0, $statusTransaction)
                    ->action('Notification Action', url('/'))
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
            'id_transaction'        => $this->transaction->id,
            'status'                => $this->transaction->status
        ];
    }
}
