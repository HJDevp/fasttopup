<?php

namespace App\Http\Controllers\FreeFireCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreeFireCardRequest;
use App\Models\Descriptions;
use App\Models\Faqs;
use App\Models\FreeFireCard;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FreeFireCardsController extends Controller
{
    public function home(FreeFireCard $freeFireCard){
       return view('user.freefirecards.allfreefirecards',[
        'allfreefirecards' => $freeFireCard->orderByLowerPrice()->paginate(4),
        'faqs'             => Faqs::all()
       ]);
    }

    public function index(FreeFireCard $freeFireCard){
        return view('admin.free-fire-card.index', [
            'freeFireCards' => $freeFireCard->recent()->paginate(6)
        ]);
    }


    public function create(FreeFireCard $freeFireCard){
        $freeFireCard = new FreeFireCard();

        return view('admin.free-fire-card.form', [
          'freeFireCard' => $freeFireCard,
          'Descriptions' => Descriptions::select('id', 'nom')->get()
        ]);
    }

    public function store(FreeFireCard $freeFireCard, FreeFireCardRequest $request){
        $freeFireCard->create($this->ExtractData($freeFireCard, $request));
        return to_route('admin.freefire.cards.index')->with('success', 'La carte FreeFire a été bien creé');
    }

    public function edit(FreeFireCard $freeFireCard){
        return view('admin.free-fire-card.form', [
            'freeFireCard' => $freeFireCard,
            'Descriptions' => Descriptions::select('id', 'nom')->get()
        ]);
    }

    public function update(FreeFireCard $freeFireCard, FreeFireCardRequest $request){
        $freeFireCard->update($this->ExtractData($freeFireCard, $request));
        return to_route('admin.freefire.cards.index');
    }


    public function ExtractData(FreeFireCard $freeFireCard, FreeFireCardRequest $request){
        $data = $request->validated();
        /** @var UploadedFile|null $image */
        $image = $request->validated('chemin_image');

        if($image == null | $image->getError()){
           return $data;
        }

        if($request->hasFile('chemin_image')){
            $image = $request->file('chemin_image');
            $extension_image = $image->getClientOriginalExtension();
            $name = $image->getClientOriginalName();
            $image_name   = $extension_image.'.'.time().'-'.date('d-m-y-').$name; 
            
            if($freeFireCard->exists){
               Storage::disk('public')->delete($freeFireCard->chemin_image);
            }

            $chemin_image = $image->storeAs('FreeFireCard', $image_name, 'public');
        }

       $data['chemin_image'] = $chemin_image;
       return $data;
    }

    public function destroy(FreeFireCard $freeFireCard){
        if($freeFireCard->exists){
          Storage::disk('public')->delete($freeFireCard->chemin_image);
        }
        $freeFireCard->delete();
        return to_route('admin.freefire.cards.index')->with('success', 'La carte FreeFire a été supprimé avec success');
    }
}
