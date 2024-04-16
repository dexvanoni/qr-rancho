<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Arrac;

class ArracController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cpf = Session::get('usuario')['cpf'];
        foreach ($request->refeicoes_semana as $value) {
            $cpf = $request->cpf;
            $datas = explode(" - ", $value);
            $diaSemana = $datas[0];
            $dataArrac = $datas[1];
            $ref = $datas[2];

            //verifica se o militar já fez o arraçoamento
            $pesquisa = DB::connection('mysql_comanda')->table('arracoamentos')
                    ->where('cpf', $cpf)
                    ->where('dia_semana', $diaSemana)
                    ->where('data_arrac', $dataArrac)
                    ->where('refeicao', $ref)
                    ->get();   
            //

            if ($pesquisa->isNotEmpty()) {
                $militar = DB::connection('mysql_sucoi')->table('cp_cadastroefetivo')->where('cpf', $cpf)->first();
                Session::flash('arracoamento_erro', 'Seu arraçoamento já havia sido realizado! Por favor escolha outra semana.');
                return view('arrac.index', compact('militar'));
            } else {
                $arracoamento = new Arrac([
                    'cpf' => $cpf,
                    'dia_semana' => $diaSemana,
                    'data_arrac' => $dataArrac,
                    'refeicao' => $ref,
                ]);
                $arracoamento->save();
            }

        }
        
        $cpf = Session::get('usuario')['cpf'];
        $militar = DB::connection('mysql_sucoi')->table('cp_cadastroefetivo')->where('cpf', $cpf)->first();
        Session::flash('arracoamento_ok', 'Sr. '.$militar->nomeGuerra.', seu arraçoamento foi enviado com sucesso!');
        return view('arrac.index', compact('militar'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
