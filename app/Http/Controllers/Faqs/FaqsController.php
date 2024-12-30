<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqsRequest;
use App\Models\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(Faqs $faqs){
        return view('admin.faqs.index', [
          'faqs' => $faqs->recent()->paginate(6)
        ]);
    }

    public function create(Faqs $faqs){
        $faqs = new Faqs();
        return view('admin.faqs.form', [
            'faqs' => $faqs
        ]);
    }

    public function store(Faqs $faqs, FaqsRequest $request){
       $faqs->create($request->validated());
       return to_route('admin.faqs.index')->with('success', 'La faqs a été bien creé');
    }

    public function edit(Faqs $faqs){
        return view('admin.faqs.form', [
            'faqs' => $faqs
        ]);
    }

    public function update(Faqs $faqs, FaqsRequest $request){
       $faqs->update($request->validated());
       return to_route('admin.faqs.index')->with('success', 'La faqs a été mise a jour avec success');
    }

    public function destroy(Faqs $faqs){
       $faqs->delete();
       return to_route('admin.faqs.index');
    }
}
