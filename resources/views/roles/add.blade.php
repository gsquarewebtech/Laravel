@extends('layouts.backend')
@section('content')
<div class="content">
    <h2 class="content-heading">@if(isset($role)){{__('messages.edit_role') }}@else {{__('messages.add_role')}} @endif <a href="{{ route('roles') }}" type="button" class="btn  btn-secondary pull-right js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">{{__('messages.list_roles')}}</a> </h2>
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
        <form action="{{ $action }}" method="post">
            @csrf
            @isset($role)
                {{ method_field('PUT')}}
            @endisset
            <div class="row">
                <h6>{{__('messages.role_name')}}*</h6>
            </div>
            <input type="text" placeholder="{{__('messages.user_type')}}" name="user_role" class="form-control user" value="{{ @$role }}">
            <div class="checkbox switcher right">
                <label class="switch">
                    <input type="checkbox" id="selectAll" name="select-all">
                    <span class="slider round"></span>
                </label>
                <small>{{__('messages.select_all')}}</small>
            </div>
            <hr/>
            <div class="row">
                <h5>{{__('messages.role_management')}}</h5>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[roles]" {{ @$permissions['roles'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_role')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" {{ @$permissions['roles.create'] == 'on' ? 'checked':'' }}  name="user_permissions[roles.create]">
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_role')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[roles.edit]" {{ @$permissions['roles.edit'] == 'on' ? 'checked':'' }}> 
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_role')}}</small>
                    </div>
                </div>
                <div class="checkbox switcher">
                    <label class="switch">
                        <input type="checkbox" name="user_permissions[delete-role]" {{ @$permissions['delete-role'] == 'on' ? 'checked':'' }}>
                        <span class="slider round"></span>
                    </label>
                    <small>{{__('messages.delete_role')}}</small>
                </div>
            </div>
            <hr/>
            <div class="row">
                <h5>{{__('messages.user_management')}}</h5>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[user]" {{ @$permissions['user'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_user')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[user.create]" {{ @$permissions['user.create'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_user')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[user.edit]" {{ @$permissions['user.edit'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_user')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[delete-user]" {{ @$permissions['delete-user'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.delete_user')}}</small>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <h5>{{__('messages.website_management')}}</h5>
            </div>
            <div class="row">
            <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[websites]" {{ @$permissions['websites'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_website')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[websites.create]" {{ @$permissions['websites.create'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_websites')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[websites.edit]" {{ @$permissions['websites.edit'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_website')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[delete-website]" {{ @$permissions['delete-website'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.delete_website')}}</small>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <h5>{{__('messages.sitemaps_management')}}</h5>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[sitemaps]" {{ @$permissions['sitemaps'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_sitemap')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[sitemaps.create]" {{ @$permissions['sitemaps.create'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_sitemaps')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[sitemaps.edit]" {{ @$permissions['sitemaps.edit'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_sitemap')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[delete-sitemaps]" {{ @$permissions['delete-sitemaps'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.delete_sitemap')}}</small>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <h5>{{__('messages.websitefeeds_management')}}</h5>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[websitefeeds]" {{ @$permissions['websitefeeds'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_websitefeeds')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[websitefeeds.create]" {{ @$permissions['websitefeeds.create'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_websitefeeds')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[websitefeeds.edit]" {{ @$permissions['websitefeeds.edit'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_websitefeeds')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[delete-websitefeeds]" {{ @$permissions['delete-websitefeeds'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.delete_websitefeeds')}}</small>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <h5>{{__('messages.product_management')}}</h5>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[product]" {{ @$permissions['product'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_product')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[product.create]" {{ @$permissions['product.create'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_products')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[product.edit]" {{ @$permissions['product.edit'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_product')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[delete-product]" {{ @$permissions['delete-product'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.delete_product')}}</small>
                    </div>
                </div>
            </div> 
            <hr/>
            <div class="row">
                <h5>{{__('messages.index_management')}}</h5>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[index]" {{ @$permissions['index'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.show_index')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[index.create]" {{ @$permissions['index.create'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.add_index')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[index.edit]" {{ @$permissions['index.edit'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.edit_index')}}</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox switcher">
                        <label class="switch">
                            <input type="checkbox" name="user_permissions[delete-index]" {{ @$permissions['delete-index'] == 'on' ? 'checked':'' }}>
                            <span class="slider round"></span>
                        </label>
                        <small>{{__('messages.delete_index')}}</small>
                    </div>
                </div>
            </div> 
            <hr/>
            <div class="row">
                <button type="submit" class="btn btn-alt-primary ryt-btn">{{__('messages.save')}}</button>
            </div>    
        </form>
    </div>
</div>
    
<script src="{{ asset('/themes/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery( '#selectAll').on('click', function () {
        if (jQuery(this).hasClass('allChecked')) {
            jQuery('input[type="checkbox"]').prop('checked', false);
        }
        else if(jQuery(this).prop("checked") == false)
        {
            $('#selectAll').prop('checked', false);
        }
        else {
            jQuery('input[type="checkbox"]').prop('checked', true);
        }
        jQuery(this).toggleClass('allChecked');
        });
    });
</script>
<style type="text/css">
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.small, small {
    font-weight: inherit;
    color: #000;
    font-size: 15px;
    /* margin-bottom: -22px; */
    padding: 16px;
    padding-bottom: 4px;
    display: contents;
}


.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

hr {
    margin-top: 4rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid #e4e7ed;
}
.checkbox.switcher.right {
    float: right;
}
input.form-control.user {
    width: 20%;
}
button.btn.btn-alt-primary.ryt-btn {
    float: right;
    margin-left: 1020px;
    margin-top: 32px;
    margin-bottom:30px;
}
</style>
@endsection

