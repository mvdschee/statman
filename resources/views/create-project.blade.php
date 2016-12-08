@extends('layouts.login')

@section('content')
<div class="create-project contentbg">
  <div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default custompanel">
        <div class="panel-heading">Create story</div>

          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-project') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Project name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group socialmedia">

                <div class="col-md-6 col-md-offset-4">
                  <div class="facebook">
                    <span class="icon"></span>
                    <span class="text">Facebook</span>
                    <div class="connected">
                      <span class="icon"></span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-md-offset-4">
                  <div class="youtube">
                    <span class="icon"></span>
                    <span class="text">YouTube</span>
                    <div class="connected">
                      <span class="icon"></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary white">Create</button>
              </div>

            </div>
          </form>
        </div>
      </div> 
    </div>
  </div> 
</div>

@endsection
