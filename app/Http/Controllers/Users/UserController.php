<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessRequest;
use App\Http\Requests\SearchTransactionByMonthRequest;
use App\Models\FreeFireCard;
use App\Models\OrderItems;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orderItems(OrderItems $orderItems, Request $request){
        return view('user.dashboard.commandes', [
           'orderItems' => $orderItems->VerifieTrueUser($request)
           ->withFreeFireCard()->recent()->paginate(6),
           'request' => $request,
        ]);
    }

    public function transactions(Transactions $transactions, Request $request){
        return view('user.dashboard.transactions', [
            'transactions' => $transactions->verifieTrueUser($request)
            ->withFreeFireCard()->recent()->paginate(6)
        ]);
    }

    public function searchTransactionsByMonth(Transactions $transactions, SearchTransactionByMonthRequest $request){

        $searchByMonth = $transactions->verifieTrueUser($request)
        ->withFreeFireCard()->recent()
        ->whereMonth('created_at', $request->validated())->paginate(6);
        
        return view('user.dashboard.transactions-byMonths', [
           'searchByMonth' => $searchByMonth 
        ]);
        
    }

    public function checkout(FreeFireCard $freefirecard){
        return view('user.process_payment.checkout_page.checkout', [
            'freefirecard' => $freefirecard 
        ]);
    }

    public function process(FreeFireCard $freefirecard, ProcessRequest $request){
        if($request->methode_de_paiement === 'moncash'){
            return view('user.process_payment.forms.moncash', [
              'freefirecard' => $freefirecard,
              'processrequest'      => $request
            ]);
        }elseif($request->methode_de_paiement === 'natcash'){
            return view('user.process_payment.forms.natcash', [
                'freefirecard' => $freefirecard,
                'processrequest'      => $request
            ]);
        }else{
         return to_route('checkout', $freefirecard)
         ->with('error', 'veuillez choisir une methode de paiement');
        }

    }

    
}
