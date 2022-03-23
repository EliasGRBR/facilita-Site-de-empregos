<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\Vaga;
use App\Models\User;
use DB;
class VagaController extends Controller
{
    public function index(){
        $i = 0;
        $vagas = DB::table('vagas')
            ->join('users', 'users.id', '=', 'vagas.user_id')
            ->select('vagas.*', 'users.name','users.id as empresa')
            ->get();
        if($vagas){
            foreach($vagas as $vaga){
                $user = new User;
                $user->id = $vaga->user_id;
                $vagas[$i]->detalhes_empresa = $user->detalheEmpresa->toArray();
                $i++;
            }
            return view('welcome',['vagas' => $vagas]);
        }
        
    }
    public function show($id){
        $vaga = Vaga::findOrFail($id);
        $donoVaga = User::FindOrFail($vaga->user_id);
        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {   
            $userVagas = $user->CanditaVagas->toArray();

            foreach($userVagas as $userVaga) {
                if($userVaga['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

        }

        return view('showvaga',['vaga' => $vaga, 'hasUserJoined' => $hasUserJoined, 'donoVaga'=> $donoVaga]);

    }
    public function joinVaga($id) {

        $user = auth()->user();

        $user->CanditaVagas()->attach($id, ['status' => '1']);

        return redirect('/candidato')->with('msg', 'Sua presença está confirmada no evento ');

    }
    public function showCandidatos($id){
        $user = auth()->user();
        $vagaCandidatos = new Vaga;
        $vagaCandidatos->id = $id;
        $i = 0;
        if($user->empresa){
           $candidatos = $vagaCandidatos->users->toArray();
           if($candidatos){
                foreach($candidatos as $candidato){
                    $candidatos[$i]['curriculo'] = DB::table('users')
                    ->join('curriculos', 'curriculos.id', '=', 'users.id')
                    ->select('curriculos.*')
                    ->where('curriculos.user_id','=',$candidato['id'])
                    ->get();
                    $candidatos[$i]['status'] = $candidato["pivot"]["status"];
                    $i++;
                    
                }
                $vaga = Vaga::findOrFail($id);
               if($vaga->id == $id){
                    return view('/showCandidatos', ['candidatos'=> $candidatos, 'vaga'=> $vaga]);    
               }else{
                return redirect('/empresa');
                }
            }else{
                $vaga = Vaga::findOrFail($id);
                return view('/showCandidatos', ['candidatos'=> $candidatos, 'vaga'=> $vaga]);
            }
           
        }else{
            return redirect('/candidato');  
        }
    }
    public function store(Request $request) {
        $user = auth()->user();
        $data = $request->all();

        $vaga = new Vaga;

        $vaga->title = $data["title"];
        $vaga->salario = $data["salario"];
        $vaga->area_atuacao = $data["area_atuacao"];
        $vaga->descricao = $data["descricao"];

        $vaga->user_id = $user->id;

        $vaga->save();

        return redirect('/empresa')->with('msg', 'Vaga Cadastrada');
    }
    public function destroy($id){
        $user = auth()->user();
        $vagaspublicadas = $user->PublicadasVagas;

        foreach($vagaspublicadas as $vaga){
            if($vaga->id == $id){
                $vaga->delete();
                return redirect('/empresa')->with('msg', 'Vaga Excluida');
            }
        }
    }
    public function mudarStatus(Request $request,$id){
        
        DB::table('user_vaga')
        ->where('vaga_id', $id)
        ->where('user_id', $request->user_id)
        ->update(['status' => $request->status]);

        return Redirect::back()->with('msg','Operação realizada');
    }
    public function leaveVaga($id) {

        $user = auth()->user();

        $user->CanditaVagas()->detach($id);

        return redirect('/candidato')->with('msg', 'Você cancelou a candidatura');

    }
}
