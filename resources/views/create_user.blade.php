@extends('layouts.app')

<div class="container">
@section('content')
<h1>Add Course Admin</h1>
<hr>
<form action="/users" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title">Admin Name</label>
        <input type="text" class="form-control" id="taskTitle"  name="name">
    </div>
    <div class="form-group">
        <label for="description">Email</label>
        <input type="text" class="form-control" id="taskDescription" name="email">
    </div>

    <div class="form-group">
        <label for="description">Course Name</label>
        <input type="text" class="form-control" id="taskDescription" name="CourseName">
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
</div>