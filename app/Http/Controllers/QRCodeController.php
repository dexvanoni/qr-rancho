<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    
public function showQRCode()
    {
        return view('qr-code');
    }

    public function readQRCode(Request $request)
    {
        $data = $request->input('data');
        // Lógica para processar o QR code lido e retornar o resultado
        return response()->json(['result' => $data]);
    }

    public function processarDados(Request $request)
    {
        // Receba a variável do JavaScript
        $variavelDoJS = $request->input('variavelDoJS');

        if ($variavelDoJS == "06FCE715C9A1D8290D0CA72F5D868CEDF285BFD79DBF1D6EAD06D9037FACE3F2") {
            $nomeMilitar = '2S SIN VANONI';
        } else {
            $nomeMilitar = '3S SIN LEVI';
        }

        /*

        // Crie uma nova instância do modelo e atribua os dados
            $modelo = new NomeDoModelo();
            $modelo->campo1 = $dados['campo1']; // Substitua 'campo1' pelos nomes reais dos seus campos
            $modelo->campo2 = $dados['campo2'];
            // ... adicione os outros campos conforme necessário

        // Salve no banco de dados
            $modelo->save();
        
        */
        
        // Nome do militar
        
        // Adiciona quebra de linha à mensagem JSON
        $mensagem = 'Dados processados e inseridos com sucesso! Militar: ' . $nomeMilitar . "\nO militar fez o arraçoamento!\nLIBERADO!";

        // Retorna a mensagem como JSON com informações dinâmicas
        return response()->json(['mensagem' => $mensagem]);

        
        //return view('sua_view', ['dados' => $dados]);
    }

}
