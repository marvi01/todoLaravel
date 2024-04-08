<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container text-center">
                    <div class="row">

                        <div class="col align-self-center h3">
                            Iniciar Tarefa
                        </div>
                    </div>
                </div>
                <div class="p-6 text-gray-900">
                    <form name="formCard" id="FormCard" class="row g-3" method="post" action="{{url('tasks')}}">
                        @csrf
                        <div class="col-md-6">
                            <label for="title" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="col-6">
                            <label for="initialDate" class="form-label">Data de Inicio</label>
                            <input type="date" class="form-control" id="initialDate" name="initialDate" required>
                        </div>
                        <div class="col-6">
                            <label for="inputAddress2" class="form-label">Data de Finalização Prevista</label>
                            <input type="date" class="form-control" id="expectedFinalDate" name="expectedFinalDate" required >
                        </div>
                        <div class="col-6">
                            <label for="inputAddress2" class="form-label">Usuarios Responsaveis </label>
                            <select class="form-control" name="user_id[]" id="user_id" multiple required>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                @endforeach
                            </select>
                        </div>
{{--                        <div class="col-6">--}}
{{--                            <label for="itens">Usuarios</label>--}}
{{--                            <select class="my-select selectpicker" >--}}
{{--                                <option>Mustard</option>--}}
{{--                                <option>Ketchup</option>--}}
{{--                                <option>Relish</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
