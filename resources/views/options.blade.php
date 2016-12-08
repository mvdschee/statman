@extends('layouts.dashboard')

@section('content')
<div class="dashboard">
  <div class="container-fluid">
    <h2>Settings</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="panel">
          <p class="text-center panel-title">Account settings</p>
          <form action="">
            <div class="form-group">
              <label for="account_name">Name</label>
              <input type="text" class="form-control" id="account_name">
            </div>
            <p class="text-center panel-title">Change password</p>
            <div class="form-group">
              <label for="account_name">Old password</label>
              <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group">
              <label for="account_name">New password</label>
              <input type="password" class="form-control" id="password_new">
            </div>
            <div class="form-group">
              <label for="account_name">Confirm new password</label>
              <input type="password" class="form-control" id="password_new_confirm">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel">
          <p class="text-center panel-title">Project settings</p>
          <form action="">
            <div class="form-group">
              <label for="account_name">Project name</label>
              <input type="text" class="form-control" id="project_name">
            </div>
            <div class="form-group">
              <label for="date_format">Date format</label>
              <select class="form-control" id="date_format">
                <option>DD/MM/JJJJ</option>
                <option>MM/DD/JJJJ</option>
                <option>JJJJ/MM/DD</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
