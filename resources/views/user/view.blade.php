@extends('etm_permisos::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-titulo h1 text-center font-weight-bolder text-white ">WIEW USER</div>

                <div class="card-body">
                   
                @include('etm_permisos::custom.message')

                    <br>
                    <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf

                    @method('PUT')


                        <!--	enctype="{{ csrf_field() }}"-->
                        <div class="container-fluid" id="cuerpoFormulario">  

                            <nav class="breadcrumb navbar-dark bg-dark col-md-12">
                                <span class="breadcrumb-item text-white active"><b>User data</b></span>
                            </nav>

                            <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control form-control-sm" title="Name"  id="name" name="name" value="{{old('name', $user->name)}}" placeholder="Enter a user" disabled/> <!---readonly-->
                                    <small class="form-control-feedback"></small>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control form-control-sm" title="Email" id="email" name="email" value="{{old('email',  $user->email)}}" placeholder="Enter a email" disabled/>
                                    <small class="form-control-feedback"></small>
                                </div>

                                
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select disabled class="form-control form-control-sm" name="roles" id="roles">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id}}"
                                            @isset($user->roles[0]->name)
                                            @if($role->name == $user->roles[0]->name)
                                            selected

                                            @endif
                                            @endisset
                                            
                                        
                                        
                                        
                                        >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                               

                            <hr>

                            <div class="row justify-content-md-center">
                            <a class="btn btn-outline-danger btn-sm m-1" href="{{route('user.index')}}">Back</a>
                            <a class="btn btn-outline-success btn-sm m-1" href="{{route('user.edit', $user->id)}}">Edit</a>
                            </div>



                        </div>       
                    </form>




                </div>

			</div>
		</div>
	</div>
</div>

@endsection

