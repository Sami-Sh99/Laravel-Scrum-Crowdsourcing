@extends('layouts.app')

@section('content')



<div class="container">

    <div class="row">
    <div class="col-sm-10">
        <h2>The Group ! </h2>
    </div>
</div>
<a class="btn btn-danger" href="{{ url('/workshop/'.$key.'/group/leave/'.$group['id']) }}">Leave</a>

</div>
<!--/row-->

@endsection