@extends('layouts.app')

@section('title')
    List of Users
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>List of users</h3>
        </div>

        <div class="row">
            <a href="{{ route('laccuser.users.create') }}" class="btn btn-primary">New User</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>------</td>
                        <td>
                            <a href="{{route('laccuser.users.edit',['id'=>$user->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            <a href="{{route('laccuser.users.destroy',['id'=>$user->id])}}"
                               class="btn btn-danger btn-outline btn-xs">
                                <strong>Delete</strong>
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4"><span class="label label-warning">There are no registered users</span></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="text-center">{{ $users->links() }}</div>
        </div>
    </div>
@endsection
