<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Cardgames extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'nom',
       'chemin_image'  
    ];

    public function ImageUrl(){
      return Storage::url($this->chemin_image);
    }


    //  scopes

    public function scopeRecent(Builder $builder){
      $builder->orderBy('created_at', 'desc');
    }
}
