@extends('layouts.app')

@section('title')
    List of Roles
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('laccuser.roles.create') }}" class="btn btn-primary">New role</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <td>Description</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td><span class="label" style="background-color: {!! $role->cor !!}">{{ $role->name
                        }}</span></td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <a href="{{route('laccuser.roles.edit',['id'=>$role->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            @if( $role->name == config( 'laccuser.acl.role_admin' ))
                                <a href="#"
                                   class="btn btn-default btn-outline btn-xs disabled">
                                    <strong>You can not delete the default system role</strong>
                                </a>
                            @else
                                <a href="{{route('laccuser.roles.destroy',['id'=>$role->id])}}"
                                   class="btn btn-danger btn-outline btn-xs">
                                    <strong>Delete</strong>
                                </a>
                                <a href="{{route('laccuser.roles.permissions.edit',['id'=>$role->id])}}"
                                   class="btn btn-primary btn-outline btn-xs">
                                    <strong>Edit Permissions</strong>
                                </a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $roles->links() }}</div>

        </div>
    </div>
@endsection
