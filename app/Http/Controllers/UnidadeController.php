<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unidade;
use App\Morador;
use App\Bloco;


class UnidadeController extends Controller
{

    public function manageUnidade()
    {

        $moradores = Morador::all();
        $blocos = Bloco::all();
        return view('unidade.index',compact('moradores','blocos'));
    }

    public function index(Request $request)
    {

        $unidades = Unidade::with(['bloco','morador'])->paginate(25);


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

        //dd($request);

        $numero_unidade = $request->numero_unidade;
        $id_responsavel = $request->id_responsavel;
        $metragem = $request->metragem;
        $quantidade_comodos = $request->quantidade_comodos;
        $numero_matricula = $request->numero_matricula;
        $situacao = $request->situacao;
        $id_bloco = $request->id_bloco;

        $this->validate($request, [

            'id_bloco' => 'required',

            'numero_unidade' => 'required',

        ]);

        if ($id_responsavel == "") {

            $id_responsavel = null;
        }

        //$create = Unidade::create($request->all());
        $create = Unidade::create([
            'numero_unidade' => $numero_unidade,
            'id_responsavel' => $id_responsavel,
            'metragem' => $metragem,
            'quantidade_comodos' => $quantidade_comodos,
            'numero_matricula' => $numero_matricula,
            'situacao' => $situacao,
            'id_bloco' => $id_bloco
        ]);


        return response()->json($create);

    }


    

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            'id_bloco' => 'required',

            'numero_unidade' => 'required',

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