@extends('layouts.app')

@section('title')
    Permissions
@endsection

@section('content')
    <div class="container">


        <div class="row">

        </div>
    </div>

    <div class="container">
        <div class="row">

            <h3>Permissions for : <span class="label" style="background-color:{{$role->cor}}">{{$role->name}}</span>
            </h3>

            @include('laccuser::errors._check')

            {!! Form::open(['route'=>['laccuser.roles.permissions.update',$role->id],'class'=>'form',
            'method'=>'PUT']) !!}

            {!! Form::hidden('redirect_to', URL::previous()) !!}

            <ul class="list-group">
                @foreach($permissionsGroup as $group)
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">
                            <strong>{{ $group->description }}</strong>
                        </h4>
                        <p class="list-group-item-text">
                        <ul class="list-inline">
                            <?php
                            //Apply filter to get section permissions to be grouped
                            $permissionsSubGroup = $permissions->filter( function ( $value ) use ( $group ) {
                                return $value->name == $group->name;
                            } );
                            ?>
                            {{--List the permissions for that section--}}
                            @foreach($permissionsSubGroup as $permission)
                                <li>
                                    <div class="checkbox">
                                        <label for="">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   {{$role->permissions->contains('id', $permission->id) ?'checked="checked"' : ""}}
                                                   value="{{$permission->id}}"/>
                                            {{$permission->resource_description}}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="form-group text-center">
                {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
                <a href="{{ route('laccuser.roles.index') }}" class="btn btn-warning btn-sm"> Return </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
