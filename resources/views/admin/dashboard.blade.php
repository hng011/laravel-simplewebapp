@extends('layouts.layout_admin')

@section('title','Dashboard')
    
@section('h_title','Group 3 Members')

@section('content')

<table class="table table-hover">
    <thead>
        <tr>
            <td>NPM</td>
            <td>NAME</td>
            <td>CLASS</td>
            <td>EDIT</td>
            <td>DELETE</td>
        </tr>
    </thead>
    <tbody class="data-user">
        @if ($data->count()==0)
        <tr>
            <td colspan="5">No entry</td>
        </tr>
        @else
        @foreach ($data as $d)
        <tr>
            <td>{{$d->npm}}</td>
            <td>{{$d->name}}</td>
            <td>{{$d->class}}</td>
            <td>
                <a class="btn btn-info edit-btn text-white" href="{{route('admin.editMember',['data'=>$d->npm])}}">
                    Edit
                </a>
            </td>
            <td>
                <form method="post" action="{{route('admin.deleteMember',['data'=>$d->npm])}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger delete_btn">Delete</button>
                </form>
            </td>   
        </tr>              
        @endforeach       
        @endif
    </tbody>
</table>

<div class="manage-news">
    <h1>Set News</h1>
    @foreach ($errors->all() as $e)
    <div class="msg text-danger fw-bold">
        <i>{{$e}}</i>
    </div>
    @endforeach
    <form action="{{route('admin.setNews')}}" method="post">
        @csrf
        @method('post')
        <div class="form-group px-3 pt-2 d-flex flex-row p-5">
            <label for="setNews" class="mx-3">How much news do you want to show? (3-10)</label>
            <input type="number" name="setNews" class="form-control set-val-input" min="3" max="10" value={{$newsVal}}>
            <input class="btn btn-primary mx-2" type="submit" value="Set Value">
        </div>
    </form>
</div>

@endsection
    