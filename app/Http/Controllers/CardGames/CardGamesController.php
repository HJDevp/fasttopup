<?php

namespace App\Http\Controllers\CardGames;

use App\Http\Controllers\Controller;
use App\Models\Cardgames;
use App\Http\Requests\CardGameRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CardGamesController extends Controller
{
    public function home(Cardgames $cardgames){
        $Allcardgames = $cardgames->recent()->paginate(10);
         return view('card-games.card-games', [
          'Allcardgames' => $Allcardgames
         ]);
    }


    public function index(Cardgames $cardgames){
        
        $Allcardgames = $cardgames->recent()->paginate(6); 
        return view('admin.card-game.index', [
          'Allcardgames' => $Allcardgames
        ]);

      
    }

    public function create(Cardgames $cardgames)
    {
        $cardgames = new Cardgames(); 
        return view('admin.card-game.form',[
         'cardgame' => $cardgames
        ]);
    }

    public function store(Cardgames $cardgames, CardGameRequest $request){
        $cardgames->create($this->ExtractData($cardgames, $request));
        return to_route('admin.cardgame.index')
        ->with('success', 'la carte de jeux a été cré avec success');
    }

    public function edit(Cardgames $cardgames){
        return view('admin.card-game.form', [
          'cardgame' => $cardgames
        ]);
    }

    public function update(Cardgames $cardgames, CardGameRequest $request){
       
       $cardgames->update($this->ExtractData($cardgames, $request));
       return to_route('admin.cardgame.index')
       ->with('success', 'La carte a été mis a jour avec success');
    }

    public function ExtractData(Cardgames $cardgames, CardGameRequest $request){
         $data = $request->validated();
         $nom  = $request->validated('nom');
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        $Gamedata = [];

        if($image == null | $image->getError()){
          return $data;
        }

        if($cardgames->exists){
          Storage::disk('public')->delete($cardgames->nom);
          Storage::disk('public')->delete($cardgames->chemin_image);
        }

        if($request->hasFile('image')){
          $image = $request->file('image');
          $extension_image = $image->getClientOriginalExtension();
          $name = $image->getClientOriginalName();
          $image_name = $extension_image.'.'.time().'-'.date('d-m-y-').$name;
          $chemin_image = $image->storeAs('Cardgames', $image_name, 'public');

          $Gamedata = [
            'nom'          => $nom,
            'chemin_image' => $chemin_image  
          ];
        }

        return $Gamedata;
    }


    public function destroy(Cardgames $cardgames){
      if($cardgames->exists){
        Storage::disk('public')->delete($cardgames->nom);
        Storage::disk('public')->delete($cardgames->chemin_image,);
      }
      $cardgames->delete();
      return to_route('admin.cardgame.index')->with('success', 'La carte a été bien supprimé');
    }
}

