<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuzzyRuleController extends Controller
{
    public function index()
    {
        return view('fuzzy.index');
    }
}
