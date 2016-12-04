<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Morador;
use App\Unidade;

class MoradorController extends Controller
{

    public function manageMorador()
    {
        $unidades = Unidade::all();
        return view('morador.index', compact('unidades'));
    }

    public function index(Request $request)
    {

        $moradores = Morador::with(['unidade'])->paginate(25);


        $response = [

            'pagination' => [

                'total' => $moradores->total(),

                'per_page' => $moradores->perPage(),

                'current_page' => $moradores->currentPage(),

                'last_page' => $moradores->lastPage(),

                'from' => $moradores->firstItem(),

                'to' => $moradores->lastItem()

            ],

            'data' => $moradores

        ];

        return response()->json($response);

    }


    public function store(Request $request)
    {

        /*$this->validate($request, [

            'id_bloco' => 'required',

            'numero_unidade' => 'required',

        ]);*/


        $create = Morador::create($request->all());


        return response()->json($create);

    }


    

    public function update(Request $request, $id)

    {

        /*$this->validate($request, [

            'id_bloco' => 'required',

            'numero_unidade' => 'required',

        ]);*/


        $edit = Morador::find($id)->update($request->all());


        return response()->json($edit);

    }



    public function destroy($id)

    {

        Morador::find($id)->delete();

        return response()->json(['done']);

    }

}