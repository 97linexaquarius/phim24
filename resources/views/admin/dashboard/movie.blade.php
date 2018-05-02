@extends('admin.dashboard.master')
@section('content')
<div class="container" ng-controller="MovieController">
<h2>Danh sách phim</h2>
<form>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tìm phim:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" ng-model="searchBox">
    </div>
  </div>
</form>
<div class="table-responsive">
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Tên phim</th>
        <th>Hình thức</th>
        <th>Tên thể loại</th>
        <th>Quốc gia</th>
        <th>Chất lượng</th>
        <th>
            <button type="button " class="btn btn-success" ng-click="modal('add')">
                <i class="fa fa-plus-square" aria-hidden="true"></i>   Thêm phim
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="m in movie|filter:searchBox|startFrom:(currentPage-1)*pageSize|limitTo:pageSize">
        <td ng-cloak>@{{$index+1}}</td>
        <td ng-cloak>@{{m.movie_name}}</td>
        <td ng-cloak>@{{m.type==1 ? 'Phim lẻ' : 'Phim bộ'}}</td>
        <td ng-cloak>@{{m.name}}</td>
        <td ng-cloak>@{{m.nation_name}}</td>   
        <td ng-cloak>@{{m.status}}</td>        
        <td ng-cloak>
            <button ng-click="modal('edit',m.id)" type="button" class="btn btn-primary" >
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>   Sửa
            </button>
            <button ng-click="confirmDelete(m.id)" type="button" class="btn btn-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>   Xóa
            </button>
        </td>        
    </tr>
    </tbody>
</table>
</div>

<!-- <ul uib-pagination total-items="movie.length" ng-model="currentPage" items-per-page="pageSize"></ul> -->
<ul uib-pagination total-items="movie.length" ng-model="currentPage" items-per-page="pageSize" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>

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
        <form name="frmMovie" class="form-horizontal" autocomplete="off">
            <div class="form-group">
                <label>Tên phim</label>
                <input ng-model="movie_data.name" ng-required="true" id="name" name="name" type="text" class="form-control" autofocus="autofocus">
                <small ng-show="frmMovie.name.$error.required" class="form-text text-muted">Bạn chưa nhập tên phim</small>
            </div>
            <div class="form-group">
                <label>Loại phim</label>
                <select ng-options="size.name for size in sizes track by size.code" ng-model="selectedItem" ng-change="update()" class="form-control"></select>
            </div>
            <div class="form-group">
                <label>Thể loại</label>
                <select ng-model="movie_data.type" ng-required="true" class="form-control" id="type" name="type">
                    <option ng-repeat="movie_data in list_type" value=@{{movie_data.id}}>@{{movie_data.name}}</option>
                </select> 
            </div>
            <div class="form-group">
                <label>Quốc gia</label>
                <select ng-model="movie_data.nation" ng-required="true" class="form-control" id="type" name="type">
                    <option ng-repeat="movie_data in list_nation" value=@{{movie_data.id}}>@{{movie_data.name}}</option>
                </select> 
            </div>
            <div class="form-group">
                <label>Chất lượng/Số tập</label>
                <input ng-model="movie_data.status" ng-required="true" id="status" name="status" type="text" class="form-control">
                <small ng-show="frmMovie.status.$error.required" class="form-text text-muted">Bạn chưa nhập chất lượng cho phim lẻ / Số tập cho phim bộ</small>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmMovie.$invalid" ng-click="save(state,id)">Lưu</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@{{frmtitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmMovieEdit" class="form-horizontal" autocomplete="off">
            <div class="form-group">
                <label>Tên phim</label>
                <input ng-model="movie_data_edit[0].name" id="name" name="name" type="text" class="form-control" autofocus="autofocus">
            </div>
            <div class="form-group">
                <label>Loại phim</label>
                {{--  <select ng-options="size.name for size in sizes track by size.code" ng-model="selectedItem" ng-change="update()" class="form-control">
                </select>   --}}
                <input type="text" ng-value="selectedItem==1?'Phim lẻ':'Phim bộ'" class="form-control" readonly>
            </div>
            {{--  <div class="form-group">
                <label>Loại phim</label>
                <select ng-model="selectedItem" ng-change="update()" class="form-control">
                    <option ng-selected="@{{s.code=selectedItem}}" ng-repeat="s in sizes" value="@{{s.code}}">@{{s.name}}</option>
                </select>
            </div>  --}}
            <div class="form-group">
                <label>Thể loại</label>
                <select ng-model="movie_data_edit[0].type" ng-required="true" class="form-control" id="type" name="type">
                    <option ng-repeat="movie_data in list_type" value=@{{movie_data.id}}>@{{movie_data.name}}</option>
                </select> 
            </div>
            <div class="form-group">
                <label>Quốc gia</label>
                <select ng-model="movie_data_edit[0].nation" ng-required="true" class="form-control" id="type" name="type">
                    <option ng-repeat="movie_data in list_nation" value=@{{movie_data.id}}>@{{movie_data.name}}</option>
                </select> 
            </div>
            <div class="form-group">
                <label>Chất lượng/Số tập</label>
                <input ng-model="movie_data_edit[0].chatluong" ng-required="true" id="status" name="status" type="text" class="form-control">
                <small ng-show="frmMovieEdit.status.$error.required" class="form-text text-muted">Bạn chưa nhập chất lượng cho phim lẻ / Số tập cho phim bộ</small>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmMovieEdit.$invalid" ng-click="save(state,id)">Lưu</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection