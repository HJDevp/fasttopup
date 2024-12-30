<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'read_at'  
    ];

    // scopes

    public function scopeRecent(Builder $builder){
        $builder->orderBy('created_at', 'desc');
      }
  
      public function scopeTransactionNotification(Builder $builder){
         $builder->where('type', 'App\Notifications\TransactionNotification');
      }
  
      public function scopeOrderItemsNotification(Builder $builder){
         $builder->where('type', 'App\Notifications\OrderItemNotification');
      }
}
