@extends('layouts.app')

@section('content')



<div class="container">

    <div class="workshop-header">

        <div class="workshop-header-left">
          <h2>The Group!</h2>
        </div>
      
        <div class="workshop-header-right"> </div>
        <a class="btn btn-danger" href="{{ url('/workshop/'.$key.'/group/leave/'.$group['id']) }}">Leave</a>
      </div>

      <hr>
      


</div>
<!--/row-->

@endsection