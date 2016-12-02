<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bloco;

class BlocoController extends Controller
{

    public function manageBloco()
    {
        return view('bloco.index');
    }

    public function index(Request $request)
    {

        $blocos = Bloco::latest()->paginate(25);


        $response = [

            'pagination' => [

                'total' => $blocos->total(),

                'per_page' => $blocos->perPage(),

                'current_page' => $blocos->currentPage(),

                'last_page' => $blocos->lastPage(),

                'from' => $blocos->firstItem(),

                'to' => $blocos->lastItem()

            ],

            'data' => $blocos

        ];


        return response()->json($response);

    }


    public function store(Request $request)
    {

        $this->validate($request, [

            'nome_bloco' => 'required',

            'quantidade_unidade' => 'required',

        ]);


        $create = Bloco::create($request->all());


        return response()->json($create);

    }


    

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            'nome_bloco' => 'required',

            'quantidade_unidade' => 'required',

        ]);


        $edit = Bloco::find($id)->update($request->all());


        return response()->json($edit);

    }



    public function destroy($id)

    {

        Bloco::find($id)->delete();

        return response()->json(['done']);

    }

}