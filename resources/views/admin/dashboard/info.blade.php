@extends('admin.dashboard.master')
@section('content')
<div class="container" ng-controller="InfoController">
<h2>Danh sách thông tin phim</h2>
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
        <th>Poster</th>
        <th>Đạo diễn</th>
        <th>Diễn viên</th>
        <th>Độ dài</th>
        <th>Giới thiệu</th>
        <th>
            <button type="button " class="btn btn-success" ng-click="modal('add')">
                <i class="fa fa-plus-square" aria-hidden="true"></i>   Thêm phim
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="m in info|filter:searchBox|startFrom:(currentPage-1)*pageSize|limitTo:pageSize">
        <td ng-cloak>@{{$index+1}}</td>
        <td ng-cloak>@{{m.name}}</td>
        <td ng-cloak><img ng-src="../../public/images/@{{m.poster}}" width=80px;></td>
        <td ng-cloak>@{{m.daodien}}</td>
        <td ng-cloak>@{{m.dienvien}}</td>
        <td ng-cloak>@{{m.dodai}} phút</td>  
        <td ng-cloak>@{{m.gioithieu}}</td>        
        <td ng-cloak>
            <button ng-click="modal('edit',m.info_id)" type="button" class="btn btn-primary" >
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>   Sửa
            </button>
            <button ng-click="confirmDelete(m.info_id)" type="button" class="btn btn-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>   Xóa
            </button>
        </td>        
    </tr>
    </tbody>
</table>
</div>

<!-- <ul uib-pagination total-items="movie.length" ng-model="currentPage" items-per-page="pageSize"></ul> -->
<ul uib-pagination total-items="info.length" ng-model="currentPage" items-per-page="pageSize" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>

<div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@{{frmtitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmInfoAdd" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label>Phim chưa cập nhật thông tin</label>
                <select ng-model="movie_data_add.id_movie" ng-required="true" class="form-control" id="id_movie" name="id_movie">
                    <option ng-repeat="movie_data in list_type" value=@{{movie_data.id}}>@{{movie_data.name}}</option>
                </select> 
            </div>
            {{--  form up load file.   --}}
            <div class="form-group">
                <input type="file" ngf-select ng-model="picFile" name="file"    
                accept="image/*" ngf-max-size="2MB" required
                ngf-model-invalid="errorFile">
                <i ng-show="frmInfoAdd.file.$error.required">*required</i><br>
                <img ng-show="frmInfoAdd.file.$valid" ngf-thumbnail="picFile" class="thumb"> <button ng-click="picFile = null" ng-show="picFile">Remove</button>
            </div>
            <div class="form-group" >
                <label>Đạo diễn</label>
                <input ng-model="movie_data_add.daodien" ng-required="true" id="daodien" name="daodien" type="text" class="form-control">
                <small ng-show="frmInfoAdd.daodien.$error.required" class="form-text text-muted">Bạn chưa nhập tên đạo diễn</small>
            </div>
            <div class="form-group">
                <label>Diễn viên</label>
                <input ng-model="movie_data_add.dienvien" ng-required="true" id="dienvien" name="dienvien" type="text" class="form-control">
                <small ng-show="frmInfoAdd.dienvien.$error.required" class="form-text text-muted">Bạn chưa nhập tên diễn viên</small>
            </div>
            <div class="form-group">
                <label>Độ dài (tính bằng phút)</label>
                <input ng-model="movie_data_add.dodai" ng-required="true" id="dodai" name="dodai" type="number" class="form-control">
                <small ng-show="frmInfoAdd.dodai.$error.required" class="form-text text-muted">Bạn chưa nhập độ dài phim</small>
                <small ng-show="frmInfoAdd.dodai.$error.number" class="form-text text-muted">Không đúng định dạng</small>
            </div>
            <div class="form-group">
                <label>Giới thiệu</label>
                <textarea ng-model="movie_data_add.gioithieu" ng-required="true" id="gioithieu" name="gioithieu" type="text" class="form-control" rows="3"></textarea>
                <small ng-show="frmInfoAdd.gioithieu.$error.required" class="form-text text-muted">Bạn chưa nhập giới thiệu cho phim</small>
            </div>
        </form>
      </div> 
      {{--  save(state,id);  --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmInfoAdd.$invalid" ng-click="save(state,id,picFile)">Lưu</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@{{frmtitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmInfoSave" class="form-horizontal" autocomplete="off">
             <div class="form-group">
                <label>Phim</label>
                <input disabled ng-model="movie_data.name" ng-required="true" id="daodien" name="daodien" type="text" class="form-control">
            </div> 
            {{--  form up load file.   --}}
            <div class="form-group">
                <input type="file" ngf-select ng-model="picFile" name="file"    
                accept="image/*" ngf-max-size="2MB" required
                ngf-model-invalid="errorFile">
                <i ng-show="frmInfoSave.file.$error.required">*required</i><br>
                <img ng-show="frmInfoSave.file.$valid" ngf-thumbnail="picFile" class="thumb"> <button ng-click="picFile = null" ng-show="picFile">Remove</button>
            </div>
            <div class="form-group">
                <label>Đạo diễn</label>
                <input ng-model="movie_data.daodien" ng-required="true" id="daodien" name="daodien" type="text" class="form-control">
                <small ng-show="frmInfoSave.daodien.$error.required" class="form-text text-muted">Bạn chưa nhập tên đạo diễn</small>
            </div>
            <div class="form-group">
                <label>Diễn viên</label>
                <input ng-model="movie_data.dienvien" ng-required="true" id="dienvien" name="dienvien" type="text" class="form-control">
                <small ng-show="frmInfoSave.dienvien.$error.required" class="form-text text-muted">Bạn chưa nhập tên diễn viên</small>
            </div>
            <div class="form-group">
                <label>Độ dài (tính bằng phút)</label>
                <input ng-model="movie_data.dodai" ng-required="true" id="dodai" name="dodai" type="number" class="form-control">
                <small ng-show="frmInfoSave.dodai.$error.required" class="form-text text-muted">Bạn chưa nhập độ dài phim</small>
                <small ng-show="frmInfoSave.dodai.$error.number" class="form-text text-muted">Không đúng định dạng</small>
            </div>
            <div class="form-group">
                <label>Giới thiệu</label>
                <textarea ng-model="movie_data.gioithieu" ng-required="true" id="gioithieu" name="gioithieu" type="text" class="form-control" rows="3"></textarea>
                <small ng-show="frmInfoSave.gioithieu.$error.required" class="form-text text-muted">Bạn chưa nhập giới thiệu cho phim</small>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmInfoSave.$invalid" ng-click="save(state,id, picFile)">Lưu</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection