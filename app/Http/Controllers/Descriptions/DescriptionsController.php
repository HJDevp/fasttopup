<?php

namespace App\Http\Controllers\Descriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\DescriptionsRequest;
use App\Models\Descriptions;
use Illuminate\Http\Request;

class DescriptionsController extends Controller
{
    public function index(Descriptions $descriptions){
        return view('admin.descriptions.index', [
         'descriptions' => $descriptions->recent()->paginate(10),
         'description_' => new Descriptions()
        ]);
    }


    // public function create(Descriptions $description){
    //     $description = new Descriptions();
    //     return view('admin.descriptions.index', [
    //        'descriptions' => $description->orderBy('created_at', 'desc')->paginate(10),
    //        'description_' => $description
    //     ]);
    // }


    public function store(Descriptions $description, DescriptionsRequest $request){
       $description->create($request->validated());
       return to_route('admin.description.index')->with('success', 'La description a été bien ajouté');
    }

    public function edit(Descriptions $description){
        return view('admin.descriptions.form', [
            'description' => $description
        ]);
    }


    public function update(Descriptions $description, DescriptionsRequest $request){
        $description->update($request->validated());
        return to_route('admin.description.index')->with('success', 'La description a été bien modifié');
    }


    public function destroy(Descriptions $description){
       $description->delete();
       return to_route('admin.description.index')->with('success', 'La description a été bien supprimé');
    }
}
