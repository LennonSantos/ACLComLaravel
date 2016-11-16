<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bloco;

class BlocoController extends Controller
{

    public function index(Request $request)
    {
        $blocos = Bloco::orderBy('id','DESC')->paginate(5);
        return view('bloco.index',compact('blocos'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('bloco.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Bloco::create($request->all());

        return redirect()->route('bloco.index')
                        ->with('success','bloco created successfully');
    }

    public function show($id)
    {
        $bloco = Bloco::find($id);
        return view('bloco.show',compact('bloco'));
    }

    public function edit($id)
    {
        $bloco = Bloco::find($id);
        return view('bloco.edit',compact('bloco'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Bloco::find($id)->update($request->all());

        return redirect()->route('bloco.index')
                        ->with('success','bloco updated successfully');
    }

    public function destroy($id)
    {
        Bloco::find($id)->delete();
        return redirect()->route('bloco.index')
                        ->with('success','bloco deleted successfully');
    }

}