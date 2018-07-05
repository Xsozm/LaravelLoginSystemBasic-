@extends('layouts.app')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table">
        <a href="{{ URL::to('users/create') }}">
            <button type="button" class="btn bg-primary">Create a Course Admin</button>
        </a>&nbsp;
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Name </th>
            <th scope="col">Email</th>
            <th scope="col">Course</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)

            <tr>
                <th scope="row">{{$user->id}}</th>
                <td><a href="/users/{{$user->id}}">{{$user->title}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$courses[$user->id]}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ URL::to('users/' . $user->id . '/edit') }}">
                            <button type="button" class="btn btn-warning">Edit</button>
                        </a>&nbsp;
                        <form action="{{url('users', [$user->id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
