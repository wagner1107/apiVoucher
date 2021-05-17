<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voucher extends Model
{
 
    use HasFactory;

    public function buscarVoucherCliente(string $email, string $codeVoucher){

       return DB::table('vouchers')
            ->select("vouchers.id","ofertas.percentual_desconto")
            ->join('clientes','clientes.id', 'vouchers.cliente_id')
            ->join('ofertas','ofertas.id', 'vouchers.oferta_id')
            ->where('clientes.email', $email)
            ->where('vouchers.uuid', $codeVoucher)
            ->where('vouchers.data_expiracao', ">" , now())
            ->whereNull('utilizado')
            ->get();

    }

    public function buscarVoucherPorEmail($email){

        return DB::table('vouchers')
             ->select("vouchers.id","ofertas.percentual_desconto", "ofertas.nome")
             ->join('clientes','clientes.id', 'vouchers.cliente_id')
             ->join('ofertas','ofertas.id', 'vouchers.oferta_id')
             ->where('clientes.email', $email)
             ->where('vouchers.data_expiracao', ">" , now())
             ->whereNull('utilizado')
             ->get();
 
     }
 

}
