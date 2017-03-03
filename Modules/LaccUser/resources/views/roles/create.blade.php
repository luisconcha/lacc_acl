@extends('layouts.app')

@section('title')
    New Role
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>New Role</h3>

            @include('laccuser::errors._check')

            {!! Form::open(['route'=>'laccuser.roles.store']) !!}

            @include('laccuser::roles._form')

            <div class="form-group text-center">
                {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
                <a href="{{ route('laccuser.roles.index') }}" class="btn btn-warning btn-sm"> Return </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection