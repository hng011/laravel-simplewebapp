@extends('layouts.layout_admin')

@section('title','Edit Member')
    
@section('h_title','Edit Member')

@section('error_msg')
@foreach ($errors->all() as $e)
    <div class="msg text-danger fw-bold">
        <i>{{$e}}</i>
    </div>
@endforeach
@endsection

@section('content')
<form class="form" method="post" action="{{route('admin.updateMember', ['data'=>$data])}}">
    @csrf
    @method('put')
    <div class="manage-data-container w-50">
        <div class="form-group px-3 pt-2">
            <label for="npm">NPM</label>
            <input type="npm" value="{{$data->npm}}" name="npm" class="form-control" id="npm" placeholder="Enter NPM" required maxlength="8">
        </div>
        <div class="form-group px-3 pt-2">
            <label for="name">NAME</label>
            <input type="name" value="{{$data->name}}" name="name" class="form-control" id="name" placeholder="Enter name" required>
        </div>
        <div class="form-group px-3 pt-2">
            <label for="class">CLASS</label>
            <input type="class" value="{{$data->class}}" name="class" class="form-control" id="class" placeholder="Enter class" required required maxlength="5">
        </div>  
        <div class="form-group px-3 pt-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-info text-white">Edit Member</button>
            <a href="{{route('admin.dashboard')}}">Back to Dashboard</a>
        </div>
    </div>
</form>
@endsection