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
            <b>Liệt Kê Danh Mục</b>
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
                        <th>Tên thuộc tính</th>
                        <th>Mô tả</th>
                        <th>Danh mục</th>
                        <th>Hiển thị</th>
                        <th>Hành động</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_attribute as $att)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$att->attribute_name}}</td>
                        <td>{{$att->attribute_desc}}</td>
                        <td><span class="text-ellipsis">{{$att->category_name}}</span></td>

                        <td><span class="text-ellipsis">
                                <?php if($att->category_status == 1){?>
                                <a href="{{asset('/active-category-product/' . $att->category_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php } else {?>
                                <a href="{{asset('/unactive-category-product/' . $att->category_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php 
                            }
                        ?>
                            </span></td>
                        <td>
                        <a href="{{asset('/edit-attribute/' . $att->attribute_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a href="{{asset('/delete-attribute/' . $att->attribute_id)}} " onclick="return confirm('Bạn có muốn xóa?')"><i class="fa fa-trash text-danger text"></i></a>
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