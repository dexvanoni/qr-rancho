@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Preencha seu arraçoamento - {{Session::get('usuario')['posto']}} {{Session::get('usuario')['nome_guerra']}}</div>
                <a href="{{route('qr')}}" title=""><i class="fa-solid fa-qrcode fa-beat"></i></a>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('arrac.store') }}" method="post" onsubmit="capturarDadosFormulario(event)">
                        @csrf

                        <input type="hidden" name="cpf" value="{{Session::get('usuario')['cpf']}}">

                        <div class="form-group">
                            <label for="data-inicial">Selecione a Segunda-feira da semana de arraçoamento:</label>
                            <input type="date" id="data-inicial" class="form-control" name="data_inicial" onchange="criarQuadroRefeicoes()">
                        </div>

                        <div id="quadro-refeicoes" class="form-group"></div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <button type="button" class="btn btn-secondary" onclick="mostrarAlertaCancelar()">Cancelar</button>
                        </div>
                    </form>

                    <!-- Modal de confirmação de envio -->
                    <div class="modal" tabindex="-1" role="dialog" id="modalConfirmarEnvio">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmação de Envio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4>Refeições Selecionadas:</h4>
                                    <ul id="selecoesModal"></ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar Envio</button>
                                    <button type="submit" class="btn btn-primary" onclick="enviarFormulario()">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>


<!--<div id="resultado" class="mt-3">
    <h2>Sua Seleção:</h2>
    <ul id="lista-selecionada"></ul>
</div>-->
</div>
</div>
</div>
</div>
</div>

<script>
// Função JavaScript para criar o quadro de seleção de refeições
function criarQuadroRefeicoes() {
    const dataInicial = new Date(document.getElementById("data-inicial").value);
    const quadroRefeicoes = document.getElementById("quadro-refeicoes");
    quadroRefeicoes.innerHTML = '';

    for (let i = 0; i < 7; i++) {
        const data = new Date(dataInicial);
        data.setDate(dataInicial.getDate() + i);
        const diaSemana = primeiraLetraMaiuscula(data.toLocaleDateString(undefined, { weekday: 'long' }));
        const dataFormatada = data.toLocaleDateString();

        const divDia = document.createElement("div");
        divDia.innerHTML = `<h4>${diaSemana}, ${dataFormatada}</h4>`;

        const refeicoes = ["Café da Manhã", "Almoço", "Jantar", "Ceia"];
        refeicoes.forEach(refeicao => {
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "refeicoes_semana[]";
            checkbox.value = diaSemana + ' - ' + dataFormatada + ' - ' + refeicao;

            const label = document.createElement("label");
            label.textContent = ' ' + refeicao ;

            const espaco = document.createElement("span");
            espaco.innerHTML = "&nbsp;";

            divDia.appendChild(checkbox);
            divDia.appendChild(espaco);
            divDia.appendChild(label);
            divDia.appendChild(document.createElement("br"));
        });

        quadroRefeicoes.appendChild(divDia);
    }
}
// Função para colocar a primeira letra em maiúscula
function primeiraLetraMaiuscula(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Vincula o evento onchange a todas as caixas de seleção
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', criarQuadroRefeicoes);
});

 // Função JavaScript para capturar os dados do formulário
 function capturarDadosFormulario(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    const dataInicial = document.getElementById("data-inicial").value;
    const selecionados = document.querySelectorAll('input[type="checkbox"]:checked');
    const selecoes = [];

    selecionados.forEach(checkbox => {
        selecoes.push(checkbox.value);
    });

    // Preenche o modal com as seleções
    const selecoesModal = document.getElementById("selecoesModal");
    selecoesModal.innerHTML = '';

    selecoes.forEach(selecao => {
        const item = document.createElement("li");
        item.textContent = selecao;
        selecoesModal.appendChild(item);
    });

    // Abre o modal de confirmação de envio
    $('#modalConfirmarEnvio').modal('show');
}

// Função para mostrar o modal de cancelamento
function mostrarAlertaCancelar() {
    $('#modalConfirmarEnvio').modal('hide');
}

 // Função para cancelar o envio do formulário
 function cancelarEnvioFormulario() {
    $('#modalConfirmarEnvio').modal('hide');
}

// Função para enviar o formulário
function enviarFormulario() {
    document.querySelector('form').submit(); // Envia o formulário
    $('#modalConfirmarEnvio').modal('hide'); // Fecha o modal
}
</script>
@endsection
