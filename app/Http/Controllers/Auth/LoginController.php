<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//CÓDIGO ORIGINAL DO LARAVEL AUTH

    use AuthenticatesUsers;

    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {

    //---------------------------LOGIN NO DOMÍNIO GAPCG -----------------------------
    // Lembrar de alterar na view login o campo cpf para peslogin
        $srv = "10.152.16.174";
        $usr = $request->get('cpf');
        $pwd = $request->get('password');

        Session::put('usr', $usr);
        Session::put('pwd', $pwd);

        function valida_ldap($srv, $usr, $pwd){
            $ldap_server = $srv;
            $auth_user = $usr;
            $auth_pass = $pwd;

          // Tenta se conectar com o servidor
            if (!($connect = @ldap_connect($ldap_server))) {
                return FALSE;
            }

          // Tenta autenticar no servidor
            if (!($bind = @ldap_bind($connect, $auth_user, $auth_pass))) {
          // se não validar retorna false
                return FALSE;
            } else {
          // se validar retorna true
                return TRUE;
            }

        }
      $server = "10.152.16.174"; //IP ou nome do servidor
      $dominio = "@gapcg.intraer"; //Dominio Ex: @gmail.com
      $user_r = $usr.$dominio;
      $pass = $pwd;

      if (!(valida_ldap($server, $user_r, $pass))) {
            Session::flash('mensagem_autentica', 'Não autenticado no domínio GAPCG. Tente novamente!');
            return redirect()->route('login');
    } else {
            $usuario = DB::connection('mysql_sucoi')->table('cp_cadastroefetivo')->where('cpf', $usr)->first();
            Session::put('usuario', 
                [
                    'nome_completo' => $usuario->nomeCompleto,
                    'nome_guerra' => $usuario->nomeGuerra,
                    'posto' => $usuario->posto,
                    'especialidade' => $usuario->especialidade,
                    'quadro' => $usuario->quadro,
                    'cpf' => $usuario->cpf,
                ]);
            $setor = DB::connection('mysql_sucoi')->table('cp_setor')->where('id', $usuario->setor_id)->first();
            Session::put('setor', $setor);

            return view('home', compact('usuario', 'setor'));
        }
    
    //---------------------------LOGIN NO DOMÍNIO GAPCG -----------------------------

    //---------------------------LOGIN NO LDAP CENTRAL -----------------------------
    /*
    $ldapconfig['host'] = '10.152.28.5';//ALTERAR PARA SERVIDOR LDAP CORRETO
    $ldapconfig['port'] = '389';
    $ldapconfig['basedn'] = 'dc=fab,dc=intraer';
    $ldapconfig['usersdn'] = 'ou=contas';

    $ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
    $ds2=ldap_connect($ldapconfig['host'], $ldapconfig['port']);

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

    ldap_set_option($ds2, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds2, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ds2, LDAP_OPT_NETWORK_TIMEOUT, 10);

    $username = "00470162139";
    $password = "250283Fa#";

    $dn="uid=".$username.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
    $dn2="uid=ldapcentral-slave,ou=sistema,dc=fab,dc=intraer";
    $dn3="ou=contas,dc=fab,dc=intraer"; 

    $bind=ldap_bind($ds, $dn, $password);

    if ($bind) {

       // Realize uma busca para obter informações do usuário
            $ldapBaseDN = 'ou=contas,dc=fab,dc=intraer';
            $ldapFilter = '(uid=00470162139)'; // Filtre pelo nome de usuário ou outro identificador
            $ldapAttributes = array("ou", "givenName", "sn", "mail"); // Atributos a serem recuperados

            $ldapSearch = ldap_search($ds, $ldapBaseDN, $ldapFilter, $ldapAttributes);
            $ldapEntries = ldap_get_entries($ds, $ldapSearch);

            if ($ldapEntries["count"] > 0) {
                // Informações do usuário encontradas
                $userInformation = $ldapEntries[0];
                print_r($userInformation); // Exiba as informações do usuário
            } else {
                echo "Usuário não encontrado.";
            }

            ldap_close($ds); 

        } else {
            echo "Não conectou";
            exit;
        //OCORREU UM ERRO
        //CPF OU SENHA INCORRETOS
        }
    */
    //---------------------------------FIM LOGIN LDAP CENTRAL --------------------------------

    }
    
}

