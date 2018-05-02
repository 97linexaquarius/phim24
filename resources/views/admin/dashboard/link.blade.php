@extends('admin.dashboard.master')
@section('content')
<div class="container" ng-controller="LinkController">
    
<h2>Danh sách link phim</h2>
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
        <th>Link</th>
        <th>Tập</th>
        <th>
            <button type="button" class="btn btn-success" ng-click="modal('add')">
                <i class="fa fa-plus-square" aria-hidden="true"></i>   Thêm Link Phim
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr  ng-repeat="link in links|filter:searchBox|startFrom:(currentPage-1)*pageSize|limitTo:pageSize">
        <td ng-cloak>@{{$index+1}}</td>
        <td ng-cloak>@{{link.name}}</td>
        <td ng-cloak>@{{link.link}}</td>
        <td ng-cloak>@{{link.chapter}}</td>        
        <td ng-cloak>
            <button type="button" class="btn btn-primary" ng-click="modal('edit',link.id)")>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>   Sửa
            </button>
            <button type="button" class="btn btn-danger" ng-click="confirmDelete(link.id)">
                <i class="fa fa-trash-o" aria-hidden="true"></i>   Xóa
            </button>
        </td>        
    </tr>
    </tbody>
</table>
</div>
<ul uib-pagination total-items="links.length" ng-model="currentPage" items-per-page="pageSize" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
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
        <form name="frmLinkAdd" class="form-horizontal" autocomplete="off">  
            <div class="form-group">
                <label>Loại phim</label>
                <small ng-show="frmLinkAdd.selectedItem.$error.required" class="form-text text-muted">Bạn chưa chọn loại phim</small>
                <select ng-options="size.name for size in sizes" name="selectedItem" ng-model="selectedItem" ng-change="update()" class="form-control"></select>
            </div>
            <div class="form-group">
                <label>Thể loại</label>
                <select ng-model="movie_data.type" ng-required="true" class="form-control" id="type" name="type" ng-change="updatePhim(movie_data.type)">
                    <option ng-repeat="lt in list_type" value=@{{lt.id}}>@{{lt.name}}</option>
                </select> 
            </div>
            <div class="form-group">
                <label>Phim</label>
                <select ng-model="movie_data.id_movie" ng-required="true" class="form-control" id="id_movie" name="id_movie" ng-change="">
                    <option ng-repeat="lp in list_phim" value=@{{lp.id}}>@{{lp.name}}</option>
                </select> 
            </div> 
            <div class="form-group" ng-show="selectedItem.code=='2'">
                <label>Tập</label>
                <input ng-model="movie_data.chapter" ng-required="selectedItem.code=='2'" id="chapter" ng-min=1 name="chapter" type="number" class="form-control">
                <small ng-show="frmLinkAdd.chapter.$error.required" class="form-text text-muted">Bạn chưa nhập số tập (1,2,3,...)</small>
                <small ng-show="frmLinkAdd.chapter.$error.number" class="form-text text-muted">Chế định hack tôi à?</small>
                <small ng-show="frmLinkAdd.chapter.$error.min" class="form-text text-muted">Tập phải lớn hơn 0</small>
            </div>   
            <div class="form-group">
                <label>Link</label>
                <input ng-model="movie_data.link" ng-required="true" id="link" name="link" type="text" class="form-control">
                <small ng-show="frmLinkAdd.link.$error.required" class="form-text text-muted">Bạn chưa nhập link phim</small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmLinkAdd.$invalid" ng-click="save(state,id)">Lưu</button>
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
        <form name="frmLinkEdit" class="form-horizontal" autocomplete="off">  
               
             <div class="form-group" ng-show="state=='edit'">
                <label>Tên phim</label>
                <input disabled ng-model="link_data[0].name" ng-required="true" id="name" name="name" type="text" class="form-control" autofocus="autofocus">
            </div> 
             
            <div class="form-group" ng-show="link_data[0].chapter!=null" >
                <label>Tập</label>
                <input disabled ng-model="link_data[0].chapter" id="chapter" ng-min=1 name="chapter" type="number" class="form-control" ng-required="link_data[0].chapter!=null">
                <small ng-show="frmLinkEdit.chapter.$error.required" class="form-text text-muted">Bạn chưa nhập số tập (1,2,3,...)</small>
                <small ng-show="frmLinkEdit.chapter.$error.number" class="form-text text-muted">Chế định hack tôi à?</small>
                <small ng-show="frmLinkEdit.chapter.$error.min" class="form-text text-muted">Tập phải lớn hơn 0</small>
            </div> 
            
            <div class="form-group" ng-show="state=='edit'">
                <label>Link</label>
                <input ng-model="link_data[0].link" ng-required="true" id="link" name="link" type="text" class="form-control">
                <small ng-show="frmLinkEdit.link.$error.required" class="form-text text-muted">Bạn chưa nhập link phim</small>
            </div> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-disabled="frmLinkEdit.$invalid" ng-click="save(state,id)">Lưu</button>
      </div>
    </div>
  </div>


</div>
</div>
@endsection