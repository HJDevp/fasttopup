<?php

namespace App\Http\Controllers\OrderItems;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use App\Models\User;
use App\Notifications\OrderItemNotification;
use App\Notifications\OrderItemsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemsController extends Controller
{
    public function index(OrderItems $orderItems){
        return view('admin.commandes.index', [
           'orderItems' => $orderItems->refresh()->withTrashed()->recent()->paginate(6)
        ]);
    }

    public function pending(OrderItems $orderItem){
        $orderItem->upadateStatusToPending($orderItem);
        $this->currentUser()->notify((new OrderItemNotification($orderItem, 'en cours'))
         ->delay(now()->addMinutes())
        );
        return redirect()->back()
        ->with('warning', 'votre commande est en cours');
    }

    public function successfully(OrderItems $orderItem){
        $orderItem->updateStatusToSuccessfully($orderItem);
        $this->currentUser()->notify((new OrderItemNotification($orderItem, 'reussi'))
         ->delay(now()->addMinutes())
        );
       return redirect()->back()
       ->with('success', 'votre commande a bien reussi');
    }

    public function failed(OrderItems $orderItem){
        $orderItem->updateStatusToFailed($orderItem);
       $this->currentUser()->notify((new OrderItemNotification($orderItem, 'échoué'))
         ->delay(now()->addMinutes())
        );
        return redirect()->back()
      ->with('error', 'votre commande a été rejeté');
    }

    public function refund(OrderItems $orderItem){
        $orderItem->updateStatusToRefund($orderItem);
        
        $this->currentUser()->notify((new OrderItemNotification($orderItem, 'remboursé'))
         ->delay(now()->addMinutes())
        );
        return redirect()->back()
       ->with('info', 'votre commande a été remboursé');
    }

    public function currentUser(){
        $utilisateur_id = Auth::user()->id;
        $utilisateur = User::findOrFail($utilisateur_id);
        return $utilisateur;
    }

    public function destroy(OrderItems $orderItem){
       $orderItem->delete();
       return redirect()->back()->with('success', 'La commande a été bien supprimé');
    }
}
