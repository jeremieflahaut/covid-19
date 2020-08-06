<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementsController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return Departement::orderBy('name')->get();
    }

}
