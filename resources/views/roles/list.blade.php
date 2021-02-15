@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading"> <small>{{__('messages.list_role')}}</small><a href="{{ route('roles.create') }}" type="button" class="btn  btn-secondary pull-right js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">{{__('messages.add_role')}}</a></h2>
        <div class="block">

        <div class="block-content">
            <form> 
                <div class="row mb-4"> 
                    <div class="col-2">
                        <select class="form-control" name="per_page">
                            <option {{request()->get('per_page') == "10" ?'selected':'' }} value="10">10</option>
                            <option {{request()->get('per_page') == "25" ?'selected':'' }} value="25">25</option>
                            <option {{request()->get('per_page') == "50" ?'selected':'' }} value="50">50</option>
                            <option {{request()->get('per_page') == "100" ?'selected':'' }} value="100">100</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <input autocomplete="new-password" name="search" type="text" class="form-control" placeholder="Search User">
                    </div>
                    <button  type="submit" class="btn  btn-secondary pull-right js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">Search</button>
                </div>
            </form>
            <table class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>{{__('messages.user_role')}}</th>
                        <th class="text-center">{{__('messages.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($userroles)>0)
                    @foreach ($userroles as $key => $role)
                        <tr>
                            <th class="text-center" scope="row">{{ $key+1 }}</th>
                            <td>{{ $role->user_role }}</td>                            
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('roles.edit',$role->id) }}" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button type="button" class="btn deleteRow btn-sm btn-secondary js-tooltip-enabled"   id="{{ $role->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>  
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td class="text-center" colspan=5>No record found!</td></tr>
                @endif
                </tbody>
            </table>
                            {{ $userroles->links() }}
                        
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('delete-role') }}">
                @csrf
                {{ method_field('DELETE')}}                      
                <div class="modal-body">
                <input type="hidden" id="rowid" name="rowid">
                    Are you sure you want to delete this row?                                              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div> 


    <!--End Modal--> 
    <!-- END Page Content -->

<script src="{{ asset('/themes/js/jquery.min.js') }}"></script>
<script src="{{ asset('/themes/js/bootstrap.min.js') }}"></script>
<script src="{{ asset( '/themes/js/popper.min.js') }}"></script>
<script type="text/javascript">
    $(".deleteRow").click(function(e){
        var id = this.id;
        e.preventDefault();
        $("#deleteModal #rowid").val(id);
       $("#deleteModal").modal();
    });
</script> 
@endsection
