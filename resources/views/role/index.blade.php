@extends('etm_permisos::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    
        <div class="col-md-12">
            <div class="card ">
                <!--div class="card-header">Lista de roles</div-->
                <div class="card-header bg-titulo h1 text-center font-weight-bolder text-white ">ROLE LIST</div>


                <div class="card-body">
                @include('etm_permisos::custom.message')
                    <br>
                    
                    <div class="col-md-12">
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                @can('haveaccess', 'role.create') <!--policy y blindar -->
                                        <a href="{{ Route('role.create',(request()->query())) }}" class="btn btn-outline-success"><i class="fas fa-plus-square text-success"></i>      Create</a> <!--request de mas -->
                                @endcan
                                </div>
                    </div>
                    <br>
                    <!--paginado-->
                    <div class="form-group col-md-12 row justify-content-center">
                        {{$users->links()}}
                    </div>
                    <!-- Paginado  parte superior-->

     
                     <!-- PARA TABLA RESPONSIVA AGREGAR table-responsive en el Class de la etiqueta Table -->
                     <div class="col-md-12">
                        <table class="table table-striped  table-bordered table-hover table-sm">
                        <thead class="thead-green">
                        <tr>
                            <th style="width: 4%"  class="text-center align-middle">#</th>
                            <th style="width: 16%" class="text-center align-middle" title="Name">Name</th>
                            <th style="width: 10%" class="text-center align-middle" title="Slug">Slug</th>
                            <th style="width: 20%" class="text-center align-middle" title="Description">Description</th>
                            <th style="width: 8%" class="text-center align-middle" title="Full_accss">Full access</th>
                            <th style="width: 22%" class="text-center align-middle" colspan="3">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($roles as $role)

                            <tr>
                                <th class="text-center" scope="row">{{$role->id}}</th>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>{{$role->description}}</td>
                                <td class="text-center">{{$role['full-access']}}</td><!----el (_) se resuelve utilizando ['']-->
                                
                                <td class="text-center">
                                    @can('haveaccess', 'role.show') <!--policy y blindar -->
                                    <a class="btn btn-outline-primary" href="{{ route('role.show', $role->id)}}"><i class="fas fa-eye"></i>  Show</a>
                                    @endcan
                                </td>

                                <td class="text-center">
                                    @can('haveaccess', 'role.edit') <!--policy y blindar -->
                                    <a class="btn btn-outline-secondary" href="{{ route('role.edit', $role->id)}}"><i class="fas fa-edit"></i>  Edit</a>
                                    @endcan
                                </td>

                                <td class="text-center">
                                     @can('haveaccess', 'role.destroy') <!--policy y blindar -->
                                    <form action="{{ route('role.destroy', $role->id)}}" method ="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i>  Delete</button>
                                    </form>
                                    @endcan

                                    </td>
                                </tr>
                                @endforeach
                                                      
                        </tbody>
                        </table>



                    <!--paginado-->
                    <div class="form-group col-md-12 row justify-content-center">
                        {{$users->links()}}
                    </div>
                    <!-- Paginado  parte superior-->
                                            
                        </div>                
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
