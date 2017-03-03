@extends('layouts.app')

@section('title')
    Edit Role
@endsection

@section('content')
    <div class="container">
        <h1>Edit Role: <span class="label" style="background-color: {{$role->cor}}">{{$role->name}}</span></h1>

        @include('laccuser::errors._check')

        {!! Form::model($role,['route'=>['laccuser.roles.update','id'=>$role->id],'method'=>'put']) !!}

        @include('laccuser::roles._form')

        <div class="form-group text-center">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('laccuser.roles.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection