@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>

<div class="participants">
    <h3>Participants:</h3>
    <table border="1">
        <tr><th>id</th><th>Name</th></tr>
        @foreach ($participants as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['Fname']}}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection()