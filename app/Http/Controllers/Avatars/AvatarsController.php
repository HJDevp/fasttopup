<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarsRequest;
use App\Models\Avatars;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AvatarsController extends Controller
{
    public function index(Avatars $avatars){
        return view('admin.avatar.index', [
          'avatars' => $avatars->recent()->paginate(6)
        ]);
    }


    public function create(Avatars $avatar){
        $avatar = new Avatars();
        return view('admin.avatar.form', [
           'avatar' => $avatar
        ]);
    }

    public function store(Avatars $avatar, AvatarsRequest $request){
        $avatar->create($this->extractData($avatar, $request));
        return to_route('admin.avatar.index')->with('success', 'L\avatar a été bien creé');
    }

    public function edit(Avatars $avatar){
        return view('admin.avatar.form', [
          'avatar' => $avatar
        ]);
    }

    public function update(Avatars $avatar, AvatarsRequest $request){
        $avatar->update($this->extractData($avatar, $request));
        return to_route('admin.avatar.index')->with('success', 'L\avatar a été bien mise a jour');
    }

    public function extractData(Avatars $avatar, AvatarsRequest $request):array{
       $data = $request->validated();
       $nom  = $request->validated('nom');
       /** @var UploadedFile|null $avatar_image */
       
       $avatar_image = $request->validated('chemin_avatar');

        if($avatar_image == null | $avatar_image->getError()){
            return $data;
        }

        if($request->hasFile('chemin_avatar')){
          $avatar_image = $request->file('chemin_avatar');
          $extension_image = $avatar_image->getClientOriginalExtension();
          $name = $avatar_image->getClientOriginalName();
          $image_name = $extension_image.'.'.time().'-'.date('d-m-y-').$name;

          if($avatar->exists){
           Storage::disk('public')->delete($avatar->chemin_avatar);
          }
          $chemin_avatar = $avatar_image->storeAs('Avatars', $image_name, 'public');

        }

        $data['chemin_avatar'] = $chemin_avatar;
        $data['nom'] = $nom;

        return $data;
    }

    public function destroy(Avatars $avatar){
        if($avatar->exists){
           Storage::disk('public')->delete($avatar->chemin_avatar);
        }    
        $avatar->delete();
        return to_route('admin.avatar.index')->with('success', 'L\avatar a été bien supprimé');
    }
}
