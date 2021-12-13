<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\cliente;
use App\Models\telefone;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cliente = cliente::query()->with('categorias');
        $params = $request->all();
        if ($params) {
            switch ($params['tipo']){
                case 'cliente':
                    $cliente->where('nome', 'like', '%'.$params['filter'].'%');
                    break;
                case 'estado':
                    $cliente->where('estado', 'like', '%'.$params['filter'].'%');
                    break;
                case 'categoria':
                    $cliente->whereRaw("categoria_id in (select id from categorias where nome like '%".$params['filter']."%')");
                    break;
            }
        }
        return $cliente->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validate = $this->validateState($request);
        //die($validate['validated']);
        if (!$validate['validated']){
            return response($validate['message'], 401);
        }


        $cliente = new cliente();
        $cliente->fill($request->all());
        $cliente->saveOrFail();
        //die($cliente);
        return $cliente;
    }

    public function validateState(Request $request){
        // valida se o usuario é de minas gerais e se é pessoa fisica
        $validator = Validator::make($request->all(),[
            'estado' => [function ($attribute, $value, $fail) use ($request){
                if ($value == 'MG' &&  $request->type == 'Física'){
                    $fail('Pessoa física não pode ser cadastrada em MG');
                }
            }],
        ]);

        if ($validator->fails()){

            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'field', 'Something is wrong with this field!'
                );
            });

            return ['validated' => false, 'message' => $validator->errors()];
        }

        return ['validated' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $cliente = cliente::with('categorias')->where('id', $id)->get();
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $this->validateState($request);
        if (!$validate['validated']){
            return response($validate['message'], 401);
        }

        $cliente = cliente::findOrFail($id);
        $cliente->fill($request->all());
        if (!$cliente->isDirty()){
            return;
        }
        $cliente->saveOrFail();
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = cliente::findOrFail($id);
        if ($cliente){
            $cliente->delete();
        }
    }
}
