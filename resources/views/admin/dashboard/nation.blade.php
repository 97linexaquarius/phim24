@extends('admin.dashboard.master')
@section('content')
<div class="container" ng-controller="NationController">
<h2>Danh sách quốc gia</h2>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Tên quốc gia</th>
        <th>
            <button type="button " class="btn btn-success" ng-click="modal('add')">
                <i class="fa fa-plus-square" aria-hidden="true"></i>   Thêm quốc gia
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="l in list">
        <td ng-cloak>@{{$index+1}}</td>
        <td ng-cloak>@{{l.name}}</td>       
        <td ng-cloak>
            <button type="button" class="btn btn-primary" ng-click="modal('edit',l.id)">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>   Sửa
            </button>
            <button type="button" class="btn btn-danger" ng-click="confirmDelete(l.id)">
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
        <form name="frmNation" class="form-horizontal" autocomplete="off">
           
            <div class="form-group">
                <label>Tên Quốc Gia</label>
                <input id="name" ng-model="nation.name" ng-required="true" name="name" type="text" class="form-control" autofocus="autofocus">
                <small ng-show="frmNation.name.$error.required" class="form-text text-muted">Bạn chưa nhập tên quốc gia</small>
            </div>
        </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmNation.$invalid" ng-click="save(state,id)">Lưu</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection