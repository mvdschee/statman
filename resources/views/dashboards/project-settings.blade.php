@extends('layouts.master')
@section('content')
<section class="settings container">
   @if($errors->any())
      <div class="error">
         <h1>{{$errors->first()}}</h1>
      </div>
   @endif

    @if (session('status'))
        <div id="js-error" class="alert alert-success">
            {{ session('status') }}
            <a id="js-close">x</a>
        </div>
    @endif

    <div class="settings-container">
      @if(!empty($data['project']))
         <h2>{{htmlspecialchars(decrypt($user->name))}}</h2>
         <p>{{ htmlspecialchars(decrypt($data['project'][0]['project_name'])) }}</p>
      </br>
      <a href="#">
         <form method="POST" action="{{ url('/story-list') }}">
            {{ csrf_field() }}
            <input type="hidden" name="option" value="{{ $data['project_id'] }}">
            <button type="submit"><i class='icon-user-add'></i></button>
         </form>
      </a>
      </br>
         <table>
            <thead>
               <td>user</td>
               <td>role</td>
               <td></td>
            </thead>
            <tbody>
                  @foreach($data['access'] as $users)
                  <tr>
                     <td>{{$users['name']}}</td>
                     @if($users['role_index_id'] == 1)
                        <td>Owner</td>
                     @elseif($users['role_index_id'] == 2)
                        <td>Writer</td>
                     @elseif($users['role_index_id'] == 2)
                        <td>Reader</td>
                     @endif
                     @if($users['user_id'] !== $user['id'])
                        @if($user['role_index_id'] !== 1)

                           <form class="" action="{{ url('/delete-from-project') }}" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="option" value="{{ $data['project_id'] }}">
                              <input type="hidden" name="user" value="{{$users['user_id']}}">
                              <td><button style="background:red;" type="submit">X</button></td>
                           </form>
                        @endif
                     @else

                        <form class="" action="{{ url('/delete-from-project') }}" method="post">
                           {{ csrf_field() }}
                           <input type="hidden" name="option" value="{{ $data['project_id'] }}">
                           <input type="hidden" name="user" value="{{$users['user_id']}}">
                           <td><button style="background:red;">delete</button></td>
                           <td class="hidden" id="deletebuttons">
                              <button style="background:darkgrey;" id="cancel" type="submit">cancel</button>
                              <button style="background:red;" type="submit">confirm</button>
                           </td>
                           <td></td>
                        </form>
                     @endif
                  </tr>
                  @endforeach
                  @if(!empty($data['invites'][0]['id']))
                     @foreach($data['invites'] as $invite)
                        <tr>
                           <td>name</td>

                           @if($invite['role_index_id'] == 1)
                              <td>Owner</td>
                           @elseif($invite['role_index_id'] == 2)
                              <td>Writer</td>
                           @elseif($invite['role_index_id'] == 2)
                              <td>Reader</td>
                           @endif

                           @if($invite['status'] == 0)
                              <td>invited</td>
                           @elseif($invite['status'] == 1)
                              <td>has account</td>
                           @endif
                        </tr>
                     @endforeach
                  @endif
            </tbody>
         </table>
         <hr>
         <table>
            <thead>
               <td>name</td>
               <td>platform</td>
               <td></td>
            </thead>
            <tbody>
               <tr>
                  {{-- {{dd($data['pages'])}} --}}
                  @if(!empty($data['pages'][0]))
                     @foreach($data['pages'] as $page)
                        <tr>
                           <td>{{decrypt($page['service_page_name'])}}</td>

                           @if($page['service_index'] == 0)
                              <td>facebook</td>
                           @elseif($page['service_index'] == 1)
                              <td>instagram</td>
                           @endif
                        {{-- {{$data['pages']}} --}}
                        <form class="" action="{{ url('/delete-service') }}" method="post">
                           {{ csrf_field() }}
                           <input type="hidden" name="option" value="{{ $data['project_id'] }}">
                           <input type="hidden" name="id" value="{{ $page['id'] }}">
                           <td><button style="background:red;" type="submit">X</button></td>
                        </form>
                        </tr>
                     @endforeach
                  @endif
               </tr>
            </tbody>
         </table>
      @endif
      <a href="/{{$data['project_id']}}/instagram">add instagram</a>

    </div>

</section>
@endsection
