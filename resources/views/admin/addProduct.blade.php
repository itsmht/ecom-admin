@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                    
                    <!-- basic form  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block" id="basicform">
                                    <h3 class="section-title">Add Product</h3>
                                    <p>Insert all t</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Add Product</h5>
                                    <div class="card-body">
                                        <form enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="product_name" class="col-form-label">Product Name</label>
                                                <input id="product_name" name= "product_name" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select class="form-control" name="category_id" id="category_id">
                                                    <option value="">Please Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->category_id}}" {{$category->category == $category->category_id  ? 'selected' : ''}}>{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_actual_price" class="col-form-label">Price</label>
                                                <input id="product_actual_price" name="product_actual_price" type="number" class="form-control" placeholder="Price">
                                            </div>
                                            <div class="form-group">
                                                <label for="product_discount_percentage" class="col-form-label">Price</label>
                                                <input id="product_discount_percentage" name="product_discount_percentage" type="number" class="form-control" placeholder="Percentage">
                                            </div>
                                            <div class="form-group">
                                                <label for="category_logo" class="col-form-label">Product Images</label>
                                                <div class="custom-file">
                                                    <input type="file" name="product_images[]" class="custom-file-input" id="category_logo" name="category_file" multiple>
                                                    <label class="custom-file-label" for="category_logo">Choose File</label>
                                                </div>
                                                <small class="form-text text-muted">Accepted formats are JPG,PNG and JPEG</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body border-top">
                                        <h3>Sizing</h3>
                                        <form>
                                            <div class="form-group">
                                                <label for="inputSmall" class="col-form-label">Small</label>
                                                <input id="inputSmall" type="text" value=".form-control-sm" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDefault" class="col-form-label">Default</label>
                                                <input id="inputDefault" type="text" value="Default input" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputLarge" class="col-form-label">Large</label>
                                                <input id="inputLarge" type="text" value=".form-control-lg" class="form-control form-control-lg">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end basic form  -->
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