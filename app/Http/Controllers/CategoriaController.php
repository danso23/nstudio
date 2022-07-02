<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaModel;
use App\Models\ProductoModel;
use Illuminate\Support\Facades\Response;
class CategoriaController extends Controller{
    public function index(){
    	$result = CategoriaModel::where('activo', '1')->get();
        return view('categoria', compact('result'));
    }
}
