<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Descriptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'nom',
       'description'  
    ];

    public function FreeFireCard(): HasMany{
      return $this->hasMany(FreeFireCard::class);
    }

    //  scopes

    public function scopeRecent(Builder $builder){
      $builder->orderBy('created_at', 'desc');
    }
}
