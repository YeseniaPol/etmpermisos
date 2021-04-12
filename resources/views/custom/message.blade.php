@if (session('status_success'))
<strong>
<div class="alert alert-success  alert-dismissible" role="alert">
<i class="fas fa-check-circle"></i><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('status_success') }}
</div>
</strong> 
@endif
                    
@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{$error}}
        </li>
        @endforeach

        
    </ul>
</div>
@endif