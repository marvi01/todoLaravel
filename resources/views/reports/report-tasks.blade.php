<x-app-layout>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900">
                    <form name="formCard" id="FormCard" class="row g-3" method="post" action="{{url('report-task')}}">
                        @method('POST')
                    @csrf
                    <p class="h2">Filtros </p>
                    <div class="col-4">
                        <label for="initialDate" class="form-label">Data de Inicio</label>
                        <input type="date"  class="form-control" id="initialDate" name="initialDate" >
                    </div>
                        <div class="col-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Todos</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Atraso</option>
                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Concluída</option>
                                <option value="4" {{ old('status') == '4' ? 'selected' : '' }}>Concluída Fora do Prazo</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="order" class="form-label">Ordenar Por:</label>
                            <select class="form-control" name="order" id="order" required>
                                <option value="id" {{ old('status') == 'id' ? 'selected' : '' }}>Identificador</option>
                                <option value="initialDate" {{ old('order') == 'initialDate' ? 'selected' : '' }}>Data Inicial</option>
                                <option value="description" {{ old('order') == 'description' ? 'selected' : '' }}>Descrição</option>
                                <option value="title" {{ old('order') == 'title' ? 'selected' : '' }}>Titulo</option>

                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                        <br>
                </form>
                </div>
            </div>
        </div><BR>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Responsavel</th>
                        <th scope="col">Data de Inicio</th>
                        <th scope="col">Expectativa de Data Final</th>
                        <th scope="col">Data Final</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{$task->id}}</th>
                            <td>{{$task->title}}</td>
                            <td>{{$task->description}}</td>
                            <td>
                                <ul>
                                    @foreach($task->userTasks as $userTask)
                                        <li> {{$userTask->users->name ?? ''}} </li>
                                    @endforeach

                                </ul>
                            </td>
                            <td>{{\Carbon\Carbon::parse($task->initialDate)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->expectedFinalDate)->format('d/m/Y') }}</td>
                            <td>
                                @if($task->finalDate != null)
                                    {{ \Carbon\Carbon::parse($task->finalDate)->format('d/m/Y')}}
                                @endif
                            </td>
                            <td> @switch($task->status)
                                    @case(1) <span class="badge text-bg-primary">  Em Andamento </span>
                                    @break
                                    @case(2) <span class="badge text-bg-danger">  Em Atraso</span>
                                    @break
                                    @case(3) <span class="badge text-bg-success">  Concluida</span>
                                    @break
                                    @case(4) <span class="badge text-bg-warning">  Concluida Fora do Prazo </span>
                                    @break
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
