<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function status(){
        return ['status' => 'Clientes Online'];
    }

    public function add(Request $request){

        try {
            
            $cliente = new Cliente();
            
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;

            $cliente->save();

            return ["retorno" => "Cliente cadastrado com sucesso"];


        } catch (\Exception $e) {

            return ["retorno" => "Erro ao cadastrar cliente", "detalhes", $e];
        }
    }

    public function list(Request $request){
        $cliente = Cliente::all();
        return $cliente;
    }

    public function select(int $id){
        $cliente = Cliente::find($id);
        return $cliente;
    }

    public function update(Request $request, int $id){
        try {
            $cliente = Cliente::find($id);

            $cliente->nome = $request->nome;
            $cliente->email = $request->email;

            $cliente->save();

            return ["retorno" => "Cliente atualizado com sucesso", "Dados" => $request->all()];

        } catch (\Exception $e) {

            return ["retorno" => "Erro ao cadastrar cliente", "detalhes", $e];
        }
    }
}
