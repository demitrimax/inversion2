
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{!! $users->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $users->email !!}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{!! $users->email_verified_at !!}</p>
</div>


<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <p><a href="{{asset('avatar/'.$users->avatar)}}" target="_blank"> {!! $users->avatar !!}</a></p>
</div>

<!-- Nombre -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $users->nombre !!}</p>
</div>

<!-- Nombre -->
<div class="form-group">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    <p>{!! $users->apellidos !!}</p>
</div>

<!-- Cargo -->
<div class="form-group">
    {!! Form::label('cargo', 'Cargo:') !!}
    <p>{!! $users->cargo !!}</p>
</div>
