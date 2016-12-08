@extends('layouts.dashboard')

@section('content')
<div class="dashboard">
  <div class="container-fluid">
    <h2>Settings</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="panel">
          <p class="panel-title">Project settings</p>
          <form action="">
            <div class="form-group">
              <label for="project_name">Project name</label>
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
            <button class="btn btn-danger">Reset project</button>
          </form>
        </div>
        <div class="panel">
          <p class="panel-title">Social media settings</p>
          <div class="row">
            <div class="col-md-9 col-md-offset-3">
              <p class="panel-subtitle token-title">Access token <small class="float-right"><a href="">Where can I find this?</a></small></p>
            </div>
          </div>
          <form class="form-horizontal" action="">
              <div class="form-group">
                <div class="col-xs-3 socialmedia-label fb">
                  <div class="col-xs-2 text-left">
                    <img src="./public/icons/icon-fb.png" alt="">
                  </div>
                  <div class="col-xs-6 text-left">
                    <p>Facebook</p>
                  </div>
                  <div class="col-xs-3 text-right">
                    <img src="./public/icons/icon-check.png" alt="">
                  </div>
                </div>
                <div class="col-xs-9">
                  <input type="text" class="form-control" id="fb_token">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-3 socialmedia-label yt">
                  <div class="col-xs-2 text-left">
                    <img src="./public/icons/icon-yt.png" alt="">
                  </div>
                  <div class="col-xs-6 text-left">
                    <p>Youtube</p>
                  </div>
                  <div class="col-xs-3 text-right">
                    <img src="./public/icons/icon-check.png" alt="">
                  </div>
                </div>
                <div class="col-xs-9">
                  <input type="text" class="form-control" id="fb_token">
                </div>
              </div>
            <button class="btn btn-primary margin-fix">Save</button>
            <button class="btn btn-danger">Reset accounts</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel">
          <p class="panel-title">Account settings</p>
          <form action="">
            <div class="form-group">
              <label for="account_name">Name</label>
              <input type="text" class="form-control" id="account_name">
            </div>
            <p class="panel-subtitle">Change password</p>
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
        <div class="panel">
          <p class="panel-title">Information/other</p>
          <p class="panel-info">Monitool version: <b>1.0</b></p>
          <p class="panel-info">Project created: <b>22/04/2016</b></p>
          <p class="panel-subtitle">Terms of service</p>
          <div class="terms">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.

            Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
