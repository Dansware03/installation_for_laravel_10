@extends('installation.layout')

@section('content')
    <h3>Requisitos del Sistema</h3>
    <p>Verificando que tu servidor cumpla con los requisitos necesarios para la instalación.</p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Requisito</th>
                    <th>Estado Actual</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requirements as $requirement)
                    <tr>
                        <td>{{ $requirement['name'] }}</td>
                        <td>{{ $requirement['current'] }}</td>
                        <td>
                            @if($requirement['result'])
                                <span class="text-success"><i class="bi bi-check-circle-fill"></i> Cumple</span>
                            @else
                                <span class="text-danger"><i class="bi bi-x-circle-fill"></i> No Cumple</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(collect($requirements)->where('result', false)->isNotEmpty())
        <div class="alert alert-danger">
            <strong>Error:</strong> Tu servidor no cumple con todos los requisitos necesarios. Por favor, corrige los problemas antes de continuar.
        </div>
    @else
        <div class="alert alert-success">
            <strong>¡Felicidades!</strong> Tu servidor cumple con todos los requisitos necesarios.
        </div>
    @endif
@endsection

@section('footer')
    <a href="{{ route('installation.welcome') }}" class="btn btn-secondary">Anterior</a>
    @if(collect($requirements)->where('result', false)->isEmpty())
        <a href="{{ route('installation.database') }}" class="btn btn-primary">Siguiente: Configurar Base de Datos</a>
    @else
        <button class="btn btn-primary" disabled>Siguiente: Configurar Base de Datos</button>
    @endif
@endsection
