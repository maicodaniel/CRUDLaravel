@extends('layouts.app')

@section('content')
    <div class="col ">
        <div class='row '>
            <div class="col-md-12 ">
                <div class="card">
                    <table id="table" class="tb hover dataTable table-striped no-footer" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Cpf</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user )
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->cpf}}</td>
                                <td>
                                    <div class="row">
                                        <div>
                                            <a class="btn btn-link" href="{{ route('user.show',['user' => $user->id]) }}">Detalhes</a>
                                        </div>
                                        <div>
                                            <form method="POST" action="{{ route('user.destroy',['user'=>$user->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-link">Remover</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="card-footer">
                    <a href="{{ route('home') }}"  class="nav-link">Home</a>
                </div>
            </div>
        </div>
    </div>

@endsection
