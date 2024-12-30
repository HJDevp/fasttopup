<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class OrderItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'user_id',
       'free_fire_card_id',
       'status', 
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function FreeFireCard(): BelongsTo{
        return $this->belongsTo(FreeFireCard::class);
    }

    // scopes
    public function scopeRecent(Builder $builder){
       $builder->orderBy('created_at', 'desc');
    }

    public function scopeUpadateStatusToPending(Builder $builder, $orderItem){
      $builder->where('id', $orderItem->id)->update(['status' => 'en cours']);
    }

    public function scopeUpdateStatusToSuccessfully(Builder $builder, $orderItem){
      $builder->where('id', $orderItem->id)->update(['status' => 'reussi']);
    }

    public function scopeUpdateStatusToFailed(Builder $builder, $orderItem){
      $builder->where('id', $orderItem->id)->update(['status' => 'échoué']);
    }

    public function scopeUpdateStatusToRefund(Builder $builder, $orderItem){
      $builder->where('id', $orderItem->id)->update(['status' => 'remboursé']);
    }

    public function scopeVerifieTrueUser(Builder $builder, Request $request){
        $user_id = $request->user()->id;
        $builder->where('user_id', $user_id);
    }

    public function scopeWithFreeFireCard(Builder $buider){
       $buider->with('freefirecard');
    }


}
