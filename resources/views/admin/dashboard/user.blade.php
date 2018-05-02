@extends('admin.dashboard.master')
@section('content')
<div class="container" ng-controller="UserController">
<h2>Danh sách admin</h2>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Tên admin</th>
        <th>Email đăng nhập</th>
        <th>Quyền hạn</th>
        <th>
            <button type="button " class="btn btn-success" ng-click="modal('add')">
                <i class="fa fa-plus-square" aria-hidden="true"></i>   Thêm admin
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="user in users">
        <td ng-cloak>@{{$index+1}}</td>
        <td ng-cloak>@{{user.name}}</td>
        <td ng-cloak>@{{user.email}}</td>
        <td ng-cloak>     
            @{{user.level==1 ? 'Boss' : 'Admin'}}
        </td>        
        <td ng-cloak>
            <button type="button" class="btn btn-danger" ng-click="confirmDelete(user.id)">
                <i class="fa fa-trash-o" aria-hidden="true"></i>   Thu hồi
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
        <form name="frmUser" class="form-horizontal" autocomplete="off">
           
            <div class="form-group">
                <label>Tên admin</label>
                <input id="name" ng-model="user.name" ng-required="true" name="name" type="text" class="form-control" autofocus="autofocus">
                <small ng-show="frmUser.name.$error.required" class="form-text text-muted">Bạn chưa nhập tên admin</small>
            </div>
            <div class="form-group">
                <label>Email đăng nhập</label>
                <input id="email" ng-model="user.email" ng-required="true" name="email" type="email" class="form-control" autofocus="autofocus">
                <small ng-show="frmUser.email.$error.required" class="form-text text-muted">Bạn chưa nhập email</small>
                <small ng-show="frmUser.email.$error.email" class="form-text text-muted">Email không chính xác</small>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input id="pass" ng-model="user.pass" ng-required="true" name="pass" type="password" class="form-control" autofocus="autofocus">
                <small ng-show="frmUser.pass.$error.required" class="form-text text-muted">Bạn chưa nhập mật khẩu</small>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input id="repass" ng-model="user.repass" ng-required="true" name="repass" type="password" class="form-control" autofocus="autofocus">
                <small ng-show="frmUser.repass.$error.required" class="form-text text-muted">Bạn chưa nhập lại mật khẩu</small>
                <small ng-show="user.pass!==user.repass" class="form-text text-muted">Mật khẩu không trùng khớp</small>
            </div>
            <div class="form-group">
                <label>Quyền hạn</label>
                <select class="form-control" ng-model="user.type" ng-required="true">
                    <option value=1>Boss</option>
                    <option value=2>Admin</option>
                </select>
            </div>
            
        </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmUser.$invalid ||  user.pass!==user.repass" ng-click="save(state)">Lưu</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection