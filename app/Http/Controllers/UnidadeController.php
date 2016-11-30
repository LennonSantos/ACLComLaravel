<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unidade;

class UnidadeController extends Controller
{

    public function manageUnidade()
    {
        return view('unidade.index');
    }

    public function index(Request $request)
    {

        $unidades = Unidade::latest()->paginate(5);


        $response = [

            'pagination' => [

                'total' => $unidades->total(),

                'per_page' => $unidades->perPage(),

                'current_page' => $unidades->currentPage(),

                'last_page' => $unidades->lastPage(),

                'from' => $unidades->firstItem(),

                'to' => $unidades->lastItem()

            ],

            'data' => $unidades

        ];


        return response()->json($response);

    }


    public function store(Request $request)
    {

        /*$this->validate($request, [

            'id_bloco' => 'required',

            'numero_unidade' => 'required',

        ]);*/


        $create = Unidade::create($request->all());


        return response()->json($create);

    }


    

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            'nome_bloco' => 'required',

            'quantidade_unidade' => 'required',

        ]);


        $edit = Unidade::find($id)->update($request->all());


        return response()->json($edit);

    }



    public function destroy($id)

    {

        Unidade::find($id)->delete();

        return response()->json(['done']);

    }

}