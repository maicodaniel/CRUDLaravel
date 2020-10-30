@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __($user->name) }}</h1>
                </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p><strong>ID: </strong>{{$user->id}}</p>
                        <p><strong>Email: </strong>{{ $user->email }}</p>
                        <p><strong>Nome: </strong>{{$user->name}}</p>
                        <p><strong>CPF: </strong>{{$user->cpf}}</p>
                        <p><strong>Data de nascimento: </strong>{{date('d/m/Y',strtotime($user->dataNascimento))}}</p>
                        <p><strong>Endereço: </strong>{{$user->endereco}}</p>
                        <p><strong>Telefone: </strong>{{$user->telefone}}</p>
                        <p><strong>Sexo: </strong>{{ $user->sexo == true ? 'Masculino' : 'Feminino' }}</p>
                        <p><strong>Cadastrado em: </strong>{{date('d/m/Y',strtotime($user->created_at))  }}</p>
                        <p><strong>Idade: </strong>{{$user->idade}} anos</p>

                    </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col d-flex justify-content-center mt-2">
                            <a href="{{ route('user.edit',['user' => $user->id]) }}">Editar</a>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <a href="{{ route('user.index') }}"  class="nav-link">Listar Usuarios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
