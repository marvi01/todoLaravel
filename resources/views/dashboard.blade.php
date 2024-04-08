<x-app-layout>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Quantidade</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result as $value)
                            <tr>

                                <th scope="row">
                                    @switch($value['status'])
                                        @case(1) <span class="badge text-bg-primary">  Em Andamento </span>
                                        @break
                                        @case(2) <span class="badge text-bg-danger">  Em Atraso</span>
                                        @break
                                        @case(3) <span class="badge text-bg-success">  Concluida</span>
                                        @break
                                        @case(4) <span class="badge text-bg-warning">  Concluida Fora do Prazo </span>
                                        @break
                                    @endswitch</th>
                                <td>{{$value['quantity']}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
