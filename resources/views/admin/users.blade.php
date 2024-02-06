@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                    
                    <div class="row">
                        
                        <!-- hoverable table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Users</h5> 
                                <!--<a href="{{route('addProduct')}}" class="btn btn-primary ml-auto" >Add Product</a>-->
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <th scope="row">{{$user->account_id}}</th>
                                                <td>{{$user->account_name}}</td>
                                                <td>{{$user->account_phone}}</td>
                                                <td>{{$user->account_balance}}</td>
                                                @if($user->account_status=="A")
                                                <td><span class="badge badge-success shadow-success m-1">Active</span></td>
                                                {{-- <button type="button" class="btn btn-success btn-round waves-effect waves-light m-1">Active</button>  --}}
                                                @else
                                                {{-- <button type="button" class="btn btn-danger btn-round waves-effect waves-light m-1">Inactive</button>  --}}
                                                <td><span class="badge badge-danger shadow-danger m-1">Inactive</span></td>
                                                @endif
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $users->onEachSide(1)->links() !!}
                                </div>
                            </div>
                        </div>
                        
                        <!-- end hoverable table -->
                        <!-- ============================================================== -->
                    </div>
                    @include('layouts.footer')
                    </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('addCategory')}}" method="POST" enctype="multipart/form-data">
                        {{@csrf_field()}}
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Category Name</label>
                        <input id="category_name" name="category_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_logo" class="col-form-label">Category Logo (Optional)</label>
                        <div class="custom-file">
                            <input type="file" name="category_logo" class="custom-file-input" id="category_logo" name="category_file">
                            <label class="custom-file-label" for="category_logo">Choose File</label>
                        </div>
                            <small class="form-text text-muted">Accepted formats are JPG,PNG and JPEG</small>
                    </div>
                    <div class="form-group">
                        <label for="category_banner" class="col-form-label">Category Banner (Optional)</label>
                        <div class="custom-file">
                            <input type="file" name="category_banner" class="custom-file-input" id="category_banner" name="category_file">
                            <label class="custom-file-label" for="category_banner">Choose File</label>
                        </div>
                            <small class="form-text text-muted">Accepted formats are JPG,PNG and JPEG</small>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </div>
             </form>
              </div>
              </div>
    @include('layouts.js')