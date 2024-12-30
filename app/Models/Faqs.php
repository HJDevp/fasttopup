<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faqs extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'question',
       'reponse',
       'categorie',  
    ];

    //  scopes

   public function scopeRecent(Builder $builder){
    $builder->orderBy('created_at', 'desc');
 }
}
