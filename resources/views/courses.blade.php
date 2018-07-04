@extends('layouts.app')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table">
        <a href="{{ URL::to('courses/create') }}">
            <button type="button" class="btn bg-primary">Add Course</button>
        </a>&nbsp;
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th></th>
            <th scope="col">Name </th>
            <th scope="col">Credit Hours</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)

            <tr>
                <th scope="row">{{$course->id}}</th>
                <td><a href="/users/{{$course->id}}"></a></td>
                <td>{{$course->name}}</td>
                <td>{{$course->credithours}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ URL::to('courses/' . $course->id . '/edit') }}">
                            <button type="button" class="btn btn-warning">Edit</button>
                        </a>&nbsp;
                        <form action="{{url('courses', [$course->id])}}" method="POST">
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
