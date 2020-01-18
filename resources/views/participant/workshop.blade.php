@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>
<div class="facilitator">{{$facilitator->Fname}}</div>      <br>
@endsection()