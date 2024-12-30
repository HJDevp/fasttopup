<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Avatars extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'nom',
       'chemin_avatar'  
    ];


    public function user(): HasMany{
       return $this->hasMany(User::class);
    }

    public function avatarUrl(){
       return Storage::url($this->chemin_avatar);
    }


   //  scopes

   public function scopeRecent(Builder $builder){
      $builder->orderBy('created_at', 'desc');
   }
}
