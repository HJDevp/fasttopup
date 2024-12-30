<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Type\Integer;

class SocialiteController extends Controller
{
    protected $providers = ['google', 'facebook'];

    public function Authredirect(Request $request){
        $provider = $request->provider;

        if(in_array($provider, $this->providers)){
          return Socialite::driver($provider)->redirect(); 
        }
        abort(404);
    }


    public function Authcallback(Request $request){
        $provider = $request->provider;
 
        if(in_array($provider, $this->providers)){
           $googleUser = Socialite::driver($provider)->user();
           
           $email = $googleUser->getEmail();
           $user = User::where('email', $email)->first();

            /*
              Si l'utilisateur existe on fait une mise a jour  
              si non on cree un nouveau utilisateur
            */ 

            if(isset($user)){
               $user->update([
                  'id'    => $googleUser->getId(),
                 'nom'    => $googleUser->user['given_name'],
                 'prenom' => $googleUser->user['family_name'],
                 'email'  => $email,
               ]);
            }else{
                $user_id  = (int) $googleUser->getId();
                $user     = User::create([
                 'id'     => $googleUser->getId(),
                 'nom'    => $googleUser->user['given_name'],
                 'prenom' => $googleUser->user['family_name'],
                 'email'  => $email,
                 'numero_telephone'  => null,
                 'password' => Hash::make(rand($user_id, 10))
                ]);
            }

            Auth::login($user);
            
            if(Auth::check() && Auth::user()->role == 'utilisateur'){
                return to_route('dashboard');
            }elseif(Auth::check() && Auth::user()->role == 'super~administrateur'){
               return to_route('admin.home.dashboard');
            }

        }
    }
}
