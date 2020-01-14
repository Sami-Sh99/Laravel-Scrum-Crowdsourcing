@extends('layouts.app')

@section('content')

<div class="container bootstrap snippet">
    <div class="row mb-50">
        <div class="col-sm-10">
            <h1 class="header1">Create Workshop </h1>
        </div>
    </div>
    <div class="row">
        <!--/col-3-->
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form method="POST" action="{{ url('facilitator/workshop/create') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="col-xs-6">
                                <label for="title" class="control-label">Title</label>
                                <input id="title" type="text" class="form-control" name="title"
                                    autofocus>
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('required_participants') ? ' has-error' : '' }}">
                            <div class="col-xs-6">
                                <label for="required_participants" class="control-label">Number of required participants</label>
                                <input id="required_participants" type="number" class="form-control" name="required_participants"
                                     autofocus>

                                @if ($errors->has('required_participants'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('required_participants') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <label for="description" class=" control-label  mt-20">Description</label>
                                <textarea id="description"  class="form-control" name="description"></textarea>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 mt-20">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>

                    <hr>

                </div>
            </div>
            <!--/tab-pane-->
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->

@endsection