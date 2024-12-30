<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardGameRequest;
use App\Models\Cardgames;
use App\Models\FreeFireCard;
use App\Models\OrderItems;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function home(){
       return view('frontend-dashboard.admin.index');
    }

    public function AllCardComponents(){
        return view('frontend-dashboard.admin.index', [
           'TotalClients'       => User::count(),
           'TotalCommandes'     => OrderItems::count(),
           'TotalCommandesSuccess' => OrderItems::where('status', 'reussi')->count(),
           'TotalCommandesFailed' => OrderItems::where('status', 'échoué')->count(),
           'TotalCommandesPending' => OrderItems::where('status', 'en cours')->count(),
           'TotalTransactions'  => Transactions::count(),
           'TotalBalance'       => Transactions::where('status', 'validé')->sum('montant'),
           'TotalTransactionSuccess' => Transactions::where('status', 'validé')->count(),
           'TotalTransactionFailed' => Transactions::where('status', 'echoué')->count(),
           'TotalTransactionPending' => Transactions::where('status', 'en attente')->count(),
           'TotalTransactionRefund' => OrderItems::where('status', 'remboursé')->count(),
           'TotalCards'         => Cardgames::count(),
           'TotalFreeFireCards' => FreeFireCard::count(),

        ]);
    }

    
}
