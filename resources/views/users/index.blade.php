@extends('layouts.app')
@section('title')
User List
@endsection

@section('content')
	<div class="row"> 
    @if(session()->has('message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session()->get('message') }}
    </div>
@endif
    <div class="col-md-12">
      <h4>Active Users</h4>
      <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
          <thead>
            <!-- <th><input type="checkbox" id="checkall" /></th> -->
                  <th>S/N</th>
                   <th>Prefix Name</th>
                   <th>Last Name</th>
                   <th>First Name</th>
                   <th>Middle Name</th>
                    <th>Username</th>
                     <th>Email</th>
                     <th>Photo</th>
                      <th>Edit</th>
                      
                       <th>Delete</th>
                   </thead>
                  <tbody>
                  <?php $count = 1; ?>
                  @foreach($users as $user)
                  <tr>
                    <!-- <td><input type="checkbox" class="checkthis" /></td> -->
                    <td> <?php echo $count++; ?></td>
                    <td>{{ $user->prefixname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->middlename }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img width="35" height="30" class="rounded-circle" src="{{ asset('uploads/'). '/'.$user->avatar }}" alt="user-photo"></td>
                    <td><a href="{{ url('/users/' . $user->id . '/' . 'edit') }}">Edit</a></td>

                    <td>
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm" title="Delete">Delete</button>
                      </form>
                    </td>  
                  </tr>

                  @endforeach
                  
                 {{ $users->links()}}
                  
                  </tbody>
                      
              </table>

              <div class="clearfix"></div>
              <!-- <ul class="pagination pull-right">
                <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
              </ul> -->
                              
                          </div>
                          
                      </div>
              	</div>
              </div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
          </div>
          <div class="modal-footer ">
            <a href="/{{$user->id}}" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
          </div>
        </div>
          <!-- /.modal-content --> 
      </div>
        <!-- /.modal-dialog --> 
    </div>

<!-- @section('custom_js')

    <script type="text/javascript">
    $(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});
</script>
@endsection -->
@endsection