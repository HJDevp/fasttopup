<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'nom',
       'prenom',
       'telephone',
       'montant',
       'capture_du_paiement',
       'methode_de_paiement',
       'player_id',
       'user_id',
       'free_fire_card_id', 
       'status'
    ];

    public function user(): BelongsTo{
       return $this->belongsTo(User::class);
    }
    
    public function FreeFireCard(): BelongsTo{
       return $this->belongsTo(FreeFireCard::class);
    }

    public function captureTransaction(){
       return Storage::url($this->capture_du_paiement);
    }

   //  scopes

   public function scopeRecent(Builder $builder){
      $builder->orderBy('created_at', 'desc');
   }


   public function scopeUpdateStatusToPending(Builder $builder, $transaction){
      $builder->where('id', $transaction->id)->update(['status' => 'en attente']);
   }

   public function scopeUpdateStatusToSuccessfuly(Builder $builder, $transaction){
      $builder->where('id', $transaction->id)->update(['status' => 'validé']);
   }

   public function scopeUpdateStatusToFailed(Builder $builder, $transaction){
      $builder->where('id', $transaction->id)->update(['status' => 'echoué']);
   }

   public function scopeVerifieTrueUser(Builder $builder, Request $request){
      $user_id = $request->user()->id;
      $builder->where('user_id', $user_id);
   }

   public function scopeWithFreeFireCard(Builder $buider){
      $buider->with('freefirecard');
   }
}

