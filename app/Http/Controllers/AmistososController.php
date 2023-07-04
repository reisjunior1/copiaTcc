<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time;
use App\Models\partida;
use App\Models\local;
use App\Http\Requests\TimeRequest;
use App\Models\joga_em;
use App\Models\jogador;
use App\Models\arbritos;
use Auth;
use App\Models\Arquivo;
use Barryvdh\DomPDF\Facade\Pdf;

class AmistososController extends Controller
{
    private $objUsuario;
    private $objTime;
    

    public function listarpartidasamistosos($idTime)
    {  
        $modelPartidas=new partida();

        $partidas=$modelPartidas-> listaamistosos($idTime);

 //dd($mandante);
$times= array_column($partidas, 'id_time_casa');
$locais= array_column($partidas, 'nome', 'idlocal');
//$arbritosmodel=new arbritos;   
$modelArquivo = new Arquivo();
$arquivos = array_column(
    $modelArquivo->lstArquivos(array_column($partidas, 'id')),
    'id_partida',
    'arquivo',
);
//dd($partidas);
return view(
    'times.partidasAmistosas',
    compact('partidas' , 'arquivos', 'idTime')
);

/*return view(
  'times.partidasAmistosas',
compact(  'times', 'locais', 'arbritos' ,'idTime')
);*/

}
   
public function geraSumulaPdf($idPartida)
{
    
    $modelPartida = new partida();
    $partida =  $modelPartida->lstDadosPartidaAmistosoPorIdPartida($idPartida);
//dd($partida);
    $modeljoga_em = new joga_em();
    $jogadoresTimeCasa = $modeljoga_em->lstJogadoresPorTime(
        $partida[0]['idTimeCasa'],
        0,0
    );
    
    $jogadoresTimeVisitante = $modeljoga_em->lstJogadoresPorTime(
     
        $partida[0]['idTimeVisitante'],
        0,0
    );
    $qtdeJogadores = count($jogadoresTimeCasa) >= count($jogadoresTimeVisitante)
        ? count($jogadoresTimeCasa)
        : count($jogadoresTimeVisitante);
    
    //dd($jogadoresTimeCasa, $jogadoresTimeVisitante);
    $partida[0]['nome']='amistoso';
   // dd($jogadoresTimeCasa);
    $pdf = PDF::loadView(
        'campeonatos.sumulaPDF',
        compact(
            'partida',
            'qtdeJogadores',
            'jogadoresTimeCasa',
            'jogadoresTimeVisitante'
        )
        
    );
    
    return $pdf->setPaper('A4')->stream('sumula.pdf');
}

public function gerarComprovantePdf($idPartida)
{
    $modelPartida = new partida();
    $partida =  $modelPartida->lstDadosPartidaAmistosoPorIdPartida($idPartida);
    //dd($partida);
    $pdf = PDF::loadView(
        'times.comprovantepdf',
        compact(

            'partida',
            
        )
        
    );
    
    return $pdf->setPaper('A4')->stream('comprovantepdf.pdf');



}
public function gerarComprovantepresencaPdf($idPartida)
{
   
    $modelPartida = new partida();
    $partida =  $modelPartida->lstDadosPartidaAmistosoPorIdPartida($idPartida);
//dd($partida);
    $modeljoga_em = new joga_em();
    $jogadoresTimeCasa = $modeljoga_em->lstJogadoresPorTime(
        $partida[0]['idTimeCasa'],
        0,0
    );
    
    $jogadoresTimeVisitante = $modeljoga_em->lstJogadoresPorTime(
        
        $partida[0]['idTimeVisitante'],
        0,0
    );
    $qtdeJogadores = count($jogadoresTimeCasa) >= count($jogadoresTimeVisitante)
        ? count($jogadoresTimeCasa)
        : count($jogadoresTimeVisitante);
    
    //dd($jogadoresTimeCasa, $jogadoresTimeVisitante);
   
    $pdf = PDF::loadView(
        'times.comprovantepresencapdf',
        
        compact(
            'partida',
            'qtdeJogadores',
            'jogadoresTimeCasa',
            'jogadoresTimeVisitante'
        )
        
    );
    
    return $pdf->setPaper('A4')->stream('comprovantepresencapdf.pdf');


}




    public function criaramistoso($idTime)
    {  
        
        $modelTime=new time();
        $times=$modelTime->sltTimes();
        $modelLocal = new local();
        $locais= $modelLocal->lstLocais(true);
        $idCampeonato=0;
        $formato=null;
        $grupo=null; 
        $modelArbrito = new arbritos();
        $arbritos = $modelArbrito->lstArbritos(0);
        $amistoso=true;

        return view(
            'campeonatos.criaPartidas',
            compact('idCampeonato', 'times', 'locais', 'formato', 'grupo', 'arbritos' ,'idTime' ,'amistoso')
        );

    }
    public function show(){
        
    }


    



}
