@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">MEUS ARRAÇOAMENTOS</div>

                <div class="card-body">
                    @if (session('arracoamento_ok'))
                        <div class="alert alert-success" role="alert">
                            {{ session('arracoamento_ok') }}
                        </div>
                    @endif
                    @if (session('arracoamento_erro'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('arracoamento_erro') }}
                        </div>
                        <a href="{{route('home')}}" title="novamente"><button type="button" class="btn btn-secondary">Tentar novamente</button></a>
                    @endif


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
