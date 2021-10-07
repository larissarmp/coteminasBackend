<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {

        $search = Produto::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)){
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy('id', 'asc')
        ->paginate(15);
        
        return $search;
    }
    public function list()
    {
        return Produto::all();   
    }
}
