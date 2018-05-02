@extends('admin.dashboard.master')
@section('content')
<div class="container" ng-controller="CateController">
<h2>Danh sách thể loại phim</h2>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Tên thể loại</th>
        <th>Hình thức</th>
        <th>
            <button type="button " class="btn btn-success" ng-click="modal('add')">
                <i class="fa fa-plus-square" aria-hidden="true"></i>   Thêm thể loại
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="c in cate">
        <td ng-cloak>@{{$index+1}}</td>
        <td ng-cloak>@{{c.name}}</td>
        <td ng-cloak>     
            @{{c.type==1 ? 'Phim lẻ' : 'Phim bộ'}}
        </td>        
        <td ng-cloak>
            <button type="button" class="btn btn-primary" ng-click="modal('edit',c.id)">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>   Sửa
            </button>
            <button type="button" class="btn btn-danger" ng-click="confirmDelete(c.id)">
                <i class="fa fa-trash-o" aria-hidden="true"></i>   Xóa
            </button>
        </td>        
    </tr>
    </tbody>
</table>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@{{frmtitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmCategory" class="form-horizontal" autocomplete="off">
           
            <div class="form-group">
                <label>Tên thể loại</label>
                <input id="name" ng-model="category.name" ng-required="true" name="name" type="text" class="form-control" autofocus="autofocus">
                <small ng-show="frmCategory.name.$error.required" class="form-text text-muted">Bạn chưa nhập tên thể loại</small>
            </div>
            <div class="form-group">
                <label>Loại phim</label>
                <select ng-model="category.type" ng-required="true" 
                class="form-control" id="type" name="type">
                    <option value=1>Phim lẻ</option>
                    <option value=2>Phim bộ</option>
                </select> 
            </div>
        </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmCategory.$invalid" ng-click="save(state,id)">Lưu</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection