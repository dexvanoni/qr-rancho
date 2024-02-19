<?php
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

    //OCORREU UM ERRO
    //CPF OU SENHA INCORRETOS
}
*/?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous">
        </script>

        <!--BOOTSTRAP -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color:#4175A9;
                //background-color:#fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 70px;
                color:#fff;
            }

            .title2 {
                font-size: 28px;
                color:#fff;
            }

            .title3 > a {
                font-size: 34px;
                color:#FFF700;
                text-decoration: none;
            }

            .links > a {
                color: #C6E3FF;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registro</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="m-b-md">
                    <img src="/imagens/logo.png" alt="logo" width="120px" height="120px">
                </div>
                <div class="title m-b-md">
                    COMANDA<br>
                    BACG
                </div>
                <div class="title2 m-b-md">
                    Sistema de Arraçoamento<br>
                    da Base Aérea de Campo Grande
                </div>
                <div class="title3 m-b-md">
                    <a href="{{ route('login') }}">Clique aqui!</a>
                </div>


                <div class="links">
                    <a href="{{route('login-fiscal')}}">Fiscal</a>
                    <a href="{{route('login-rancho')}}">Rancho</a>
                </div>
            </div>
        </div>
        <footer class="footer fixed-bottom bg-dark text-white text-center p-2" style="padding: .3rem!important;">
            Desenvolvido por: Sgt Vanoni
        </footer>
    </body>

</html>
