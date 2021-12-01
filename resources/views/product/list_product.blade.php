@extends('admin_layout');
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <?php 
            $message = Session::get('message');
            if($message){
                echo '<span class = "text-alert">' . $message . '</span>';
                Session::put('message',null);
            }
        ?>
        <div class="panel-heading">
            <b>Danh sách sản phẩm</b>
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Màu sắc</th>
                        <th>Size</th>
                        <th>Hình ảnh</th>
                        <th>Hiển thị</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_product as $product)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        
                        <td>{{$product->product_color}}</td>
                        <td>{{$product->product_size}}</td>
                        <td><img src="upload/products/{{$product->product_image}}" width="100" height="100" alt=""></td>

                        <td><span class="text-ellipsis">
                                <?php if($product->product_status == 1){?>
                                <a href="{{asset('/active-product/' . $product->product_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php } else {?>
                                <a href="{{asset('/unactive-product/' . $product->product_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php 
                            }
                        ?>
                            </span>
                        </td>
                        <td>{{$product->category_name}}</td>
                        <td>{{$product->brand_name}}</td>
                        <td>
                        <a href="{{asset('/edit-product/' . $product->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a href="{{asset('/delete-product/' . $product->product_id)}} " onclick="return confirm('Bạn có muốn xóa?')"><i class="fa fa-trash text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection