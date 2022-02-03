@extends('layouts.app')

@section('content')
<div class="conteiner">

    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            
        </button>
    </div>
    @endif



    <a href="{{ url('empleado/create') }}">
        <button class="btn btn-success mb-4">
            Registrar nuevo empleado
        </button>
    </a>

    <table class="table table-ligth">

        <thead class="thead-ligth">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                @foreach($empleados as $empleado)
                <td>{{ $empleado->id }}</td>
                <td>
                    <img src="{{ asset('storage').'/'.$empleado->foto }}" class="img-thumbnail img-fluid" width="100" alt="">

                </td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->primerApellido }}</td>
                <td>{{ $empleado->segundoApellido }}</td>
                <td>{{ $empleado->email }}</td>
                <td>
                    <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}">
                        <button type="submit" class="btn btn-warning">
                            Editar
                        </button>
                    </a>

                    <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <!-- {{ method_field('DELETE') }} -->
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres borrar?')" value="Borrar">Borrar</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
    {!! $empleados->links() !!}
</div>
@endsection