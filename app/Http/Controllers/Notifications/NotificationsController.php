<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(notifications $notifications){
        return view('admin.notifications.allnotification', [
            'allnotifications' => $this->currentUser()->notifications()->paginate(8)
            // orderBy('created_at', 'desc')->paginate(10) 
        ]);
    }

    public function userIndex(notifications $notifications){
        return view('user.notifications.allnotification', [
            'allnotifications' => $this->currentUser()->notifications()->paginate(8)
            // orderBy('created_at', 'desc')->paginate(10) 
        ]);
    }

    public function currentUser(){
        $utilisateur_id = Auth::user()->id;
        $utilisateur = User::findOrFail($utilisateur_id);
        return $utilisateur;
    }

    public function orderItemsNotifications(notifications $orderItemsNotification){
        return view('admin.notifications.orderItemsNotifications', [
          'orderItemsNotifications' => $this->currentUser()->notifications()
          ->where('type', 'App\Notifications\OrderItemNotification')
          ->orderBy('created_at', 'desc')->paginate(8)
        ]);  
    }

    public function userOrderItemsNotifications(notifications $orderItemsNotification){
        return view('user.notifications.orderItemsNotifications', [
          'orderItemsNotifications' => $this->currentUser()->notifications()
          ->where('type', 'App\Notifications\OrderItemNotification')
          ->orderBy('created_at', 'desc')->paginate(8)
        ]);  
    }

    public function transactionsNotifications(notifications $transactionNotification){
        return view('admin.notifications.transactionsNotifications', [
            'transactionsNotifications' =>  $this->currentUser()->notifications()
            ->where('type', 'App\Notifications\TransactionNotification')
            ->orderBy('created_at', 'desc')->paginate(8)
        ]);
    }

    public function userTransactionsNotifications(notifications $transactionNotification){
        return view('user.notifications.transactionsNotifications', [
            'transactionsNotifications' =>  $this->currentUser()->notifications()
            ->where('type', 'App\Notifications\TransactionNotification')
            ->orderBy('created_at', 'desc')->paginate(8)
        ]);
    }

    public function markAsRead(notifications $notifications, Request $request){
        if($request->allnotis && $request->lus){
            $this->searchNotificationToUpdate($notifications, $request);
            return redirect()->back()->
            with('success', 'notification marqué comme lus avec success');
        }elseif($request->allnotis && $request->non_lus){
           $this->searchNotificationToUpdate($notifications, $request);
           return redirect()->back()->
           with('success', 'notification marqué comme non lus avec success');
        }elseif($request->allnotis && $request->supprimer){
            $this->searchNotificationToUpdate($notifications, $request);
            return redirect()->back()->
            with('success', 'notification supprimé avec success');
        }
        
        if($request->markAsRead){
            $this->currentUser()->unreadNotifications->markAsRead();
            return redirect()->back()->
            with('success', 'Toutes les notifications sont marqué comme non lus avec success');
        }elseif($request->tout_supprimer){
            $this->currentUser()->notifications()->delete();
            return redirect()->back()->
            with('success', 'Toutes les notifications ont été supprimé avec success');
        }    
    }

    public function searchNotificationToUpdate(notifications $notifications, $request){
        $notification = $notifications->findOrFail($request->allnotis); 
        if($request->allnotis && $request->lus){
            $notification->update([
                'read_at' => now()
            ]);
        }elseif($request->allnotis && $request->non_lus){
            $notification->update([
                'read_at' => null
            ]);
        }elseif($request->allnotis && $request->supprimer){ 
            $notification->delete();
        }

        return $notification;
    }
    
}
