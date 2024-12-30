<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FreeFireCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'nom',
       'quantite_diamons',
       'prix',
       'descriptions_id',
       'chemin_image',
    ];


    public function descriptions(): BelongsTo{
       return $this->belongsTo(Descriptions::class);
    }

    public function transactions(): HasMany{
       return $this->hasMany(Transactions::class);
    }

    public function orderitems(): HasMany{
       return $this->hasMany(OrderItems::class);
    }


   //  scopes

   public function scopeRecent(Builder $builder){
       $builder->orderBy('created_at', 'desc');
   }

   public function scopeOrderByLowerPrice(Builder $builder){
      $builder->orderBy('prix', 'asc');
   }

    public function imageUrl(){
       return Storage::url($this->chemin_image);
    }
}
