<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curriculo;

class CurriculoController extends Controller
{
    public function index() {
        $user = auth()->user();
        if($user->curriculo){
            return $user->curriculo;
        }else{
            return false;
        }
    }
    public function store(Request $request) {
        $user = auth()->user();
        if($user->curriculo){
            return redirect('/candidato')->with('msg', 'Curriculo já Cadastrado');

        }else{
            $curriculo = new Curriculo;

            $curriculo->area_atuacao = $request->area_atuacao;
            $curriculo->grau_ensino = $request->grau_ensino;
            $curriculo->experiencia = $request->experiencia;
    
            $user = auth()->user();
            $curriculo->user_id = $user->id;
    
            var_dump($curriculo);
            $curriculo->save();
    
            return redirect('/candidato')->with('msg', 'Curriculo criado com sucesso!');
        }
       

    }
    public function update(Request $request){
        $data = $request->all();
        $user = auth()->user();
        $curriculo = $user->curriculo;

        $curriculo->area_atuacao = $data["area_atuacao"];
        $curriculo->grau_ensino = $data["grau_ensino"];
        $curriculo->experiencia = $data["experiencia"];

        $curriculo->save();

        return redirect('/candidato')->with('msg', 'curriculo editado com sucesso!');
    }
}
