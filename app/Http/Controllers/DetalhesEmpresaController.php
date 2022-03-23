<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalhesEmpresa;

class DetalhesEmpresaController extends Controller
{
    public function index() {
        $user = auth()->user();
        if($user->detalheEmpresa){
            return $user->detalheEmpresa;
        }else{
            return false;
        }
    }
    public function store(Request $request) {
        $user = auth()->user();
        if($user->detalheEmpresa){
            return redirect('/empresa')->with('msg', 'Detalhes da empresa já Cadastrado');

        }else{
            $detalheEmpresa = new DetalhesEmpresa;

            $detalheEmpresa->ramo_de_atuacao = $request->ramo_de_atuacao;
            $detalheEmpresa->local = $request->local;
    
            $user = auth()->user();
            $detalheEmpresa->user_id = $user->id;
    
            var_dump($detalheEmpresa);
            $detalheEmpresa->save();
    
            return redirect('/empresa')->with('msg', 'Detalhes da empresa criado com sucesso!');
        }
    }
    public function update(Request $request){
        $data = $request->all();
        $user = auth()->user();
        $detalheEmpresa = $user->detalheEmpresa;

        $detalheEmpresa->local = $data["local"];
        $detalheEmpresa->ramo_de_atuacao = $data["ramo_de_atuacao"];
        
        $detalheEmpresa->save();

        return redirect('/empresa')->with('msg', 'Detalhes editados com sucesso!');
    }
}
