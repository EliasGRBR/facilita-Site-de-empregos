<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    public function index(){
        $user = auth()->user();
        $detalhes = app('App\Http\Controllers\DetalhesEmpresaController')->index();
        $vagaspublicadas = $user->PublicadasVagas;
        return view('empresa',['user'=> $user,'detalhes'=> $detalhes, 'vagas' => $vagaspublicadas]);
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
                    return redirect('/empresa')->with('error', 'Senha Nova e confirmar divergem');
                }
            }else{
                return redirect('/empresa')->with('error', 'Senha incorreta');
            }
        }
        $user->name = $data["name"];
        $user->save();
        return redirect('/empresa')->with('msg', 'Usuario editado com sucesso!');
    }
}
