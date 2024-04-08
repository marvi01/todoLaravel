<x-app-layout>



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                    <th scope="col">Email</th>
                    <th scope="col"> Tipo </th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            <div>
                                <a  href="{{url("user/$user->id")}}"  class="del-user btn btn-danger" >
                                    Excluir
                                </a>
                            </div>
                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if( count($user->getAllPermissions())> 0 ) Administrador
                                @else Usuario
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-app-layout>
