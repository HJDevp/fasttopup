<?php

namespace App\Http\Controllers\TermsAndConditions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function termsAndConditions(){
       return view('terms-and-conditions.conditions');
    }
}
