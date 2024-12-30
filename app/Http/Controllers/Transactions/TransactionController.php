<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionsRequest;
use App\Models\OrderItems;
use App\Models\Transactions;
use App\Models\User;
use App\Notifications\OrderItemNotification;
use App\Notifications\TransactionNotification;
use App\Notifications\TransactionsNotification;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index(Transactions $transactions){
        return view('admin.transactions.index', [
           'transactions' => $transactions->refresh()->withTrashed()->recent()->paginate(6)
        ]);
    }

    public function pending(Transactions $transaction){
        $transaction->updateStatusToPending($transaction);
        $this->currentUser()->notify(new TransactionNotification($transaction, 'en attente'));
        return redirect()->back()
        ->with('warning', 'votre paiement est mise en attente');
    }

    public function successfully(Transactions $transaction){
        $transaction->updateStatusToSuccessfuly($transaction);
        $this->currentUser()->notify((new TransactionNotification($transaction, 'validé'))
         ->delay(now()->addMinutes(2))
        );
        return redirect()->back()
        ->with('success', 'votre paiement validé avec success');
    }

    public function failed(Transactions $transaction){
        $transaction->updateStatusToFailed($transaction);
        $this->currentUser()->notify((new TransactionNotification($transaction, 'echoué'))
         ->delay(now()->addMinutes(2))
        );
        return redirect()->back()
        ->with('error', 'votre paiement a été rejeté');
    }

    public function controlTransaction(Transactions $transaction, OrderItems $orderItem,  TransactionsRequest $request){
        $dataOrder = [
            'user_id'           => $request->user_id,
            'free_fire_card_id' => $request->free_fire_card_id
        ];

        $transaction = $transaction->create($this->ExtractData($transaction, $request));
        $transaction->save();
        $delay = now()->addSeconds(2);
        $this->currentUser()->notify((new TransactionNotification($transaction, 'en attente'))
        ->afterCommit()->delay($delay)
        );

        $orderItem = $orderItem->create($dataOrder);
        $orderItem->save();
        $this->currentUser()->notify((new OrderItemNotification( $orderItem, 'en cours'))
        ->afterCommit()->delay($delay)
        );
        return to_route('dashboard')->with('succes', 'votre achat est effectué avec success');
    }


    public function ExtractData(Transactions $transaction,  TransactionsRequest $request){
        $data = $request->validated();

        /** @var UploadedFile|null $image */
        $image = $request->validated('capture_du_paiement');

        if($image == null | $image->getError()){
          return $data;
        }

        if($request->hasFile('capture_du_paiement')){
            $paiement = $request->file('capture_du_paiement');
            $extension_image = $paiement->getClientOriginalExtension();
            $name = $paiement->getClientOriginalName();
            $image_name = $extension_image.'.'.time().'-'.date('d-m-y-').$name;

            if($transaction->exists){
               Storage::disk('public')->delete($transaction->capture_du_paiement);
            }
            $capture_du_paiement = $paiement->storeAs('Transactions', $image_name, 'public');
        }
        
        $data['capture_du_paiement'] = $capture_du_paiement;

        return $data;
    }

    public function currentUser(){
        $utilisateur_id = Auth::user()->id;
        $utilisateur    = User::findOrFail($utilisateur_id);
        return $utilisateur;
    }

    public function destroy(Transactions $transaction){
        if($transaction->exists){
           Storage::disk('public')->delete($transaction->capture_du_paiement);
        }
        $transaction->delete();
        return redirect()->back()->with('success', 'Transaction supprimé avec success');
    }
}
