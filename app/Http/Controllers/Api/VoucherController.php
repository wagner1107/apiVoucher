<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Cliente;

class VoucherController extends Controller
{

    public function status(){
        return ['status' => 'Voucher Online'];
    }

    public function add(Request $request){

        try {

            $clientes = Cliente::all("id"); //recupero o total de clientes;
            $ultimoVoucher = Voucher::get()->last()->id; // recupera o último id da tabela

            foreach ($clientes as $key => $cliente_id) {

                $voucher = new Voucher();                
                $voucher->uuid = md5( $ultimoVoucher + $key );
                $voucher->data_expiracao = $request->data_expiracao;
                $voucher->cliente_id = $cliente_id['id'];
                $voucher->oferta_id = $request->oferta_id;
                

                $voucher->save();
            }

            return ["retorno" => "voucher cadastrado com sucesso"];


        } catch (\Exception $e) {

            return ["retorno" => "Erro ao cadastrar a voucher", "detalhes", $e];
        }
    }

    public function list(Request $request){
        $voucher = Voucher::all();
        return $voucher;
    }

    public function select(Request $request){
        
        $voucher = new Voucher();
        $voucherClientes = $voucher->buscarVoucherCliente($request->email, $request->voucher);

        if(isset($voucherClientes[0])){

            $this->utilizarVoucher( date("Y-m-d"), $voucherClientes[0]->id);

            return ['status' => "ok", "percentual" => $voucherClientes[0]->percentual_desconto ];

        } 
        
        return ["status" => 'Error', "msg" => "código já foi utilizado"];


    }

    public function update(Request $request, int $id){
        try {
            $voucher = Voucher::find($id);

            $voucher->data_expiracao = $request->data_expiracao;

            $voucher->save();
            return ["retorno" => "voucher atualizado com sucesso", "Dados" => $request->all()];

        } catch (\Exception $e) {

            return ["retorno" => "Erro ao cadastrar voucher", "detalhes", $e];
        }
    }

    public function delete(int $id){
        try {
            $voucher = Voucher::find($id);

            $voucher->delete();
            return ["retorno" => "voucher deletada com sucesso"];

        } catch (\Exception $e) {

            return ["retorno" => "Erro ao apagar voucher", "detalhes", $e];
        }
    }

    public function utilizarVoucher($utilizado, $id){

        try {
            $voucher = Voucher::find($id);


            $voucher->utilizado = "2021-05-16 10:00:00";

            

            $voucher->save();
            return ["retorno" => "voucher atualizado com sucesso11"];

        } catch (\Exception $e) {

            return ["retorno" => "Erro ao Atualizar voucher", "detalhes", $e];
        }
    }

    public function listVoucherWithEmail(Request $request){
        
        $voucher = new Voucher();
        $voucherClientes = $voucher->buscarVoucherPorEmail($request->email);
        
        if(isset($voucherClientes[0]) && !empty($voucherClientes)){
            
            return $voucherClientes;
        } 
        
        return ["status" => 'Error', "msg" => "Cliente não possuí voucher válidos"];


    }
}