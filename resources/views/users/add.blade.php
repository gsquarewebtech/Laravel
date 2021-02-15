@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">@if(isset($user)) {{__('messages.edit_user')}} @else {{__('messages.add_user')}} @endif
        @if(Auth::id() != 1)
            @if(in_array('user',array_keys($permissions)))
            <a href="{{ route('user') }}" type="button" class="btn  btn-secondary pull-right js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">{{__('messages.list_user')}}</a>
            @endif
        @else
            <a href="{{ route('user') }}" type="button" class="btn  btn-secondary pull-right js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">{{__('messages.list_user')}}</a> 
        @endif 
        </h2>
        <div class="block">

            <div class="block-content">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('message_type'))
                 <div class="alert alert-{{ session('message_type') == 'success' ? 'success' : 'danger' }}">
                        <ul class="p-0 m-0">  
                            <li>{{ session('message') }}</li>
                        </ul>
                    </div>
                @endif
                <form action="{{ $action }}" method="post" >
                    @csrf
                    @isset($user->id)
                        {{ method_field('PUT')}}
                    @endisset
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" value="{{@$user->id}}" name="id">
                                <label>{{__('messages.first_name')}}</label>
                                <input value="{{@$user->first_name}}" type="text" name="first_name" class="form-control" placeholder="{{__('messages.first_name')}}">
                            </div>
                            <div class="col-6">
                                <label>{{__('messages.last_name')}}</label>
                                <input  value="{{@$user->last_name}}" type="text" name="last_name" class="form-control" placeholder="{{__('messages.last_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>{{__('messages.email')}}</label>
                                @if(!empty(@$user->id))
                                <input type="text" value="{{@$user->email}}"  readonly class="form-control" placeholder="{{__('messages.email')}}">
                                @else
                                  <input type="text"   name="email" class="form-control" placeholder="{{__('messages.email')}}">
                                @endif
                            </div>
                            <div class="col-6">
                                <label>{{__('messages.user_type')}}</label>
                                <select class="form-control" name="user_type"   >
                                        @foreach($roles as $key =>$role)
                                        <option value="{{ $role->id }}">{{ $role->user_role }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>{{__('messages.password')}}</label>
                                <input autocomplete="new-password" name="password" type="Password" class="form-control" placeholder="{{__('messages.password')}}">
                            </div>
                            <div class="col-6">
                                <label>{{__('messages.confirm_password')}}</label>
                                <input autocomplete="new-password" name="confirm_password" type="password" class="form-control" placeholder="{{__('messages.confirm_password')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-alt-primary">{{__('messages.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    <script>
        var url = "{{ route('LangChange') }}";
            $(".Langchange").change(function(){
                window.location.href = url + "?lang="+ $(this).val();
            });
    </script>
@endsection
