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
                                <h5 class="card-header">Categories</h5> 
                                <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">Add Category</a>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Logo</th>
                                                <th scope="col">Banner</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <th scope="row">{{$category->category_id}}</th>
                                                <td>{{$category->category_name}}</td>
                                                <td><img style="width:30px; height:30px;" src="{{$category->category_logo}}" alt="company_logo" ></td>
                                                <td><img style="width:30px; height:30px;" src="{{$category->category_banner}}" alt="Nothing to show" ></td>
                                                <td>{{$category->category_status}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
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