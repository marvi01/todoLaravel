<x-app-layout>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form name="formCard" id="FormCard" class="row g-3" method="post" action="{{url('tasks/search')}}">
                            @method('POST')
                            @csrf
                            <p class="h2">Filtros </p>
                            <div class="col-6">
                                <label for="value" class="form-label">Pesquisar</label>
                                <input type="text" class="form-control" id="value" name="value" >
                            </div>

                            <div class="col-7">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div><BR>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @csrf
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Ações</th>
                        <th scope="col">Descrição</th>
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
                            <td>
                                <a href="{{url("tasks/$task->id/edit")}}">
                                    <button class="btn btn-secondary">
                                        Editar
                                    </button>
                                </a>
                                <div>
                                    <a  href="{{url("tasks/$task->id")}}"  class="del-task btn btn-danger" >
                                        Excluir
                                    </a>
                                </div>


                            </td>
                            <td>{{$task->description}}</td>
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
