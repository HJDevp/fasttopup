<?php

namespace App\Models;

use Cache;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache as FacadesCache;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'numero_telephone',
        'password',
        'avatars_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole($role){
        if($this->role == $role){
          return true;
        }   
    }
    
    public function userOnline(){
       return FacadesCache::has('user-is-online'.$this->id);
    }

    public function avatars(): BelongsTo{
      return $this->belongsTo(Avatars::class);
    }

    public function transactions(): HasMany{
      return $this->hasMany(Transactions::class);
    }

    public function orderitems(): HasMany{
      return $this->hasMany(OrderItems::class);
    }

    

   


}
