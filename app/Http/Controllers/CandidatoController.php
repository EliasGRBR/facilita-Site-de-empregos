<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CandidatoController extends Controller
{
    public function index(){
        $user = auth()->user();
        // $curriculo = Curriculo->index();
        $vagas = $user->CanditaVagas;
        $curriculo = app('App\Http\Controllers\CurriculoController')->index();
        return view('candidato',['user'=> $user,'curriculo' => $curriculo,'vagas'=> $vagas]);
    }
    public function update(Request $request,$id){
        $data = $request->all();
        $user = User::findOrFail($id);
        if($data["old-pass"]){
            if(Hash::check($data["old-pass"], $user->password)){
                if($data["newPass"] === $data["confirmPass"] && $data["newPass"]){
                    $user->name = $data["name"];
                    $user->password = Hash::make($data["newPass"]);
                    $user->save();
                }else{
                    return redirect('/candidato')->with('error', 'Senha Nova e confirmar divergem');
                }
            }else{
                return redirect('/candidato')->with('error', 'Senha incorreta');
            }
        }
        $user->name = $data["name"];
        $user->save();
        return redirect('/candidato')->with('msg', 'Usuario editado com sucesso!');
    }
}
