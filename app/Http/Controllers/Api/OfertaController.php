<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oferta;

class OfertaController extends Controller
{

    public function status(){
        return ['status' => 'Voucher Online'];
    }

    public function add(Request $request){

        try {
            
            $oferta = new Oferta();
            
            $oferta->nome = $request->nome;
            $oferta->percentual_desconto = $request->percentual_desconto;

            $oferta->save();

            return ["retorno" => "Oferta cadastrado com sucesso"];


        } catch (\Exception $e) {

            return ["retorno" => "Erro ao cadastrar a oferta", "detalhes", $e];
        }
    }

    public function list(Request $request){
        $oferta = Oferta::all();
        return $oferta;
    }

    public function select(int $id){
        $oferta = Oferta::find($id);
        return $oferta;
    }

    public function update(Request $request, int $id){
        try {
            $oferta = Oferta::find($id);

            $oferta->nome = $request->nome;
            $oferta->percentual_desconto = $request->percentual_desconto;

            $oferta->save();
            return ["retorno" => "oferta atualizado com sucesso", "Dados" => $request->all()];

        } catch (\Exception $e) {

            return ["retorno" => "Erro ao cadastrar oferta", "detalhes", $e];
        }
    }

    public function delete(int $id){
        try {
            $oferta = Oferta::find($id);

            $oferta->delete();
            return ["retorno" => "oferta deletada com sucesso"];

        } catch (\Exception $e) {

            return ["retorno" => "Erro ao apagar oferta", "detalhes", $e];
        }
    }
}
