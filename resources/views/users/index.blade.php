@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ __('Utilizadores') }}</h1>

        @if (count($users) > 0)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nome') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Contacto') }}</th>
                    <th scope="col">{{ __('Género') }}</th>
                    <th scope="col">{{ __('Administrador') }}</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)

            <tr>
                <td><p>{{ $user->id }}</p></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contactNumber }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->is_admin?'Sim':'Não' }}</td>
                <td>
                    <div class="btn-group" role="group" arial-label="Ações do formulário">  
                        <a href="{{ route('users.delete', $user) }}" class="btn btn-outline-secondary">{{ __('Remover') }}</a>
                        <a href="{{ route('users.admin', $user) }}" class="btn btn-outline-secondary">{{ __('Administrador') }}</a>
                    </div>
                </td>
            </tr>

            @endforeach

            </tbody>
            
        </table>
        @else

        <p>{{ __('Não existe nenhum produto na base de dados') }}</p>

        @endif

    </div>
    


@endsection