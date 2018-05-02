var app = angular.module("my-app", ['ui.bootstrap','ngFileUpload']).constant("API", "http://localhost/phim24/public/phim24_admin/");
app.filter('startFrom', function () {
    return function (data, start) {
        return data.slice(start);
    }
});

app.controller("CateController", function ($scope, $http, API) {
    $http.get(API + "category/list").then(function (response) {
        $scope.cate = response.data;
    });

    $scope.modal = function (state, id) {
        $scope.state = state;
        switch (state) {
            case "add":
                $scope.frmtitle = "Thêm Thể Loại";
                break;
            case "edit":
                $scope.frmtitle = "Sửa Thể Loại";
                $scope.id = id;
                $http.get(API + "category/edit/" + id).then(function (response) {
                    $scope.category = response.data;
                    console.log($scope.category);
                });
                break;
            default:
        }
        $("#myModal").modal("show");
    }
    $scope.save = function (state, id) {
        if (state == "add") {
            var url = API + "category/add";
            var data = $.param($scope.category);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
                .then(function (response) {
                    console.log(response);
                    location.reload();
                })
                .catch(function (response) {
                    console.log(response);
                    alert("Xảy ra lỗi!");
                });
        }
        if (state == "edit") {
            var url = API + "category/edit/" + id;
            $scope.id = id;
            var data = $.param($scope.category);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
                .then(function (response) {
                    location.reload();
                })
                .catch(function (response) {
                    alert("Xảy ra lỗi!");
                });
        }
    }
    $scope.confirmDelete = function (id) {
        if (confirm("Bạn có muốn xóa bản ghi này không?"))
            $http.get(API + "category/delete/" + id).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
    }
});
app.controller("NationController", function ($scope, $http, API) {

    $http.get(API + "nation/list").then(function (response) {
        $scope.list = response.data;
    });

    $scope.modal = function (state, id) {
        $scope.state = state;
        switch (state) {
            case "add":
                $scope.frmtitle = "Thêm Quốc Gia";
                break;
            case "edit":
                $scope.frmtitle = "Sửa Quốc Gia";
                $scope.id = id;
                $http.get(API + "nation/edit/" + id).then(function (response) {
                    $scope.nation = response.data;
                    // console.log($scope.nation);
                });
                break;
            default:
        }
        $("#myModal").modal("show");
    }
    $scope.save = function (state, id) {
        if (state == "add") {
            var url = API + "nation/add";
            var data = $.param($scope.nation);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
                .then(function (response) {
                    // console.log(response);
                    location.reload();
                })
                .catch(function (response) {
                    console.log(response);
                    alert("Xảy ra lỗi!");
                });
        }
        if (state == "edit") {
            var url = API + "nation/edit/" + id;
            $scope.id = id;
            var data = $.param($scope.nation);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
                .then(function (response) {
                    location.reload();
                })
                .catch(function (response) {
                    alert("Xảy ra lỗi!");
                });
        }
    }
    $scope.confirmDelete = function (id) {
        if (confirm("Bạn có muốn xóa bản ghi này không?"))
            $http.get(API + "nation/delete/" + id).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
    }
});
app.controller("MovieController", function ($scope, $http, API) {
    $scope.pageSize = 10;
    $scope.currentPage = 1;
    $scope.movie = [];
    $scope.sizes = [{
        code: 1,
        name: "Phim lẻ"
    }, {
        code: 2,
        name: "Phim bộ"
    }];
    
    $http.get(API + "nation/list").then(function (response) {
        $scope.list_nation = response.data;
    })

    $http.get(API + "movie/list").then(function (response) {
        $scope.movie = response.data;
        // console.log($scope.movie);
    });
    $http.get(API + "category/list").then(function (response) {
        $scope.cate = response.data;
    });
    $scope.modal = function (state, id) {
        $scope.state = state;
        switch (state) {
            case "add":
                $scope.frmtitle = "Thêm Phim";
                $scope.movie_data = null;
                $("#myModal").modal("show");
                break;
            case "edit":
                $scope.frmtitle = "Sửa Phim";
                $scope.id = id;
                $http.get(API + "movie/edit/" + id).then(function (response) {
                    $scope.movie_data_edit = response.data;
                    console.log($scope.movie_data_edit);
                    $scope.selectedItem=$scope.movie_data_edit[0].theloai;
                    $http.get(API + "category/type/" + $scope.selectedItem).then(function (response) {
                        $scope.list_type = response.data;
                    })
                    // console.log($scope.selectedItem);
                })
                $("#myModalEdit").modal("show");
                break;
            default:
        }
        
    }
    $scope.save = function (state, id) {
        if (state == "add") {
            var url = API + "movie/add";
            var data = $.param($scope.movie_data);
            console.log($scope.movie_data);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
        }
        if (state == "edit") {
            var url = API + "movie/edit/" + id;
            var data = $.param($scope.movie_data_edit[0]);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
        }
    }
    $scope.confirmDelete = function (id) {
        if (confirm("Bạn có muốn xóa bản ghi này không?"))
            $http.get(API + "movie/delete/" + id).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
    }
});
app.controller("LinkController", function ($scope, $http, API) {
    $scope.pageSize = 10;
    $scope.currentPage = 1;
    $scope.links = [];
    $scope.sizes = [{
        code: 1,
        name: "Phim lẻ"
    }, {
        code: 2,
        name: "Phim bộ"
    }];

    $http.get(API + "link/list").then(function (response) {
        $scope.links = response.data;
        // console.log($scope.links);
    });

    $scope.modal = function (state, id) {
        $scope.state = state;
        switch (state) {
            case "add":
                $scope.frmtitle = "Thêm Link";
                $("#myModalAdd").modal("show");
                break;
            case "edit":
                $scope.frmtitle = "Sửa link";
                $scope.id = id;

                $http.get(API + "link/edit/" + id).then(function (response) {
                    $scope.link_data = response.data;
                    // console.log($scope.link_data[0].id);
                });
                $("#myModalEdit").modal("show");
                break;
            default:
        }
    }
    $scope.update = function () {
        $http.get(API + "category/type/" + $scope.selectedItem.code).then(function (response) {
            $scope.list_type = response.data;
            // console.log($scope.list_type);
        })
    }
    $scope.updatePhim = function (id) {
        $scope.id = id;
        if ($scope.selectedItem.code == 1) {
            $http.get(API + "link/listPhimLe/" + id).then(function (response) {
                $scope.list_phim = response.data;
            })
        }
        else {
            $http.get(API + "link/listPhimBo/" + id).then(function (response) {
                $scope.list_phim = response.data;
            })
        }
    }
    $scope.save = function (state, id) {
        if (state == "add") {
            var url = API + "link/add";
            var data = $.param($scope.movie_data);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
        }
        if (state == "edit") {
            var url = API + "link/edit/" + id;
            var data = $.param($scope.link_data[0]);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
        }
    }

    $scope.confirmDelete = function (id) {
        if (confirm("Bạn có muốn xóa bản ghi này không?"))
            $http.get(API + "link/delete/" + id).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
    }
});
app.controller("InfoController",  function ($scope, $http, API, Upload, $timeout) {
    $scope.pageSize = 10;
    $scope.currentPage = 1;
    $scope.info = [];
   
    $http.get(API + "info/movieNotExists").then(function (response) {
        $scope.list_type = response.data;
    });
    $http.get(API + "info/list").then(function (response) {
        $scope.info = response.data;

        // console.log($scope.info);
    });
    // $http.get(API + "category/list").then(function (response) {
    //     $scope.cate = response.data;
    // });
    $scope.modal = function (state, id) {
        $scope.state = state;
        switch (state) {
            case "add":
                $scope.frmtitle = "Thêm Thông Tin Phim";
                $("#myModalAdd").modal("show");
                break;
            case "edit":
                $scope.frmtitle = "Sửa Thông Tin Phim";
                $scope.id = id;
                console.log(id);
                $http.get(API + "info/edit/" + id).then(function (response) {
                    $scope.movie_data = response.data[0];
                    // console.log($scope.movie_data);
                })
                $("#myModalSave").modal("show");
                break;
            default:
        }

    }
    $scope.save = function (state, id, file) {
        if (state == "add") {
            file.upload = Upload.upload({
                url: API + "info/add",
                data: {info: $scope.movie_data_add, file: file},
            });
            file.upload.then(function (response) {
                $timeout(function () {
                    location.reload();
                });
            });
        }
        if (state == "edit") {
            // var url = API + "info/edit/" + id;
            // var data = $.param($scope.movie_data);
            // $http({
            //     method: "POST",
            //     url: url,
            //     data: data,
            //     headers: {
            //         "Content-Type": "application/x-www-form-urlencoded"
            //     }
            // }).then(function (response) {
            //     location.reload();
            // }).catch(function (response) {
            //     alert("Xảy ra lỗi!");
            // });
            file.upload = Upload.upload({
                url: API + "info/edit/" + id,
                data: {info: $scope.movie_data, file: file},
            });
            file.upload.then(function (response) {
                $timeout(function () {
                    location.reload();
                });
            });
        }
    }
    $scope.confirmDelete = function (id) {
        if (confirm("Bạn có muốn xóa bản ghi này không?"))
            $http.get(API + "info/delete/" + id).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
    }
});
app.controller("UserController", function ($scope, $http, API) {

    $scope.sizes = [{
        code: 1,
        name: "Boss"
    }, {
        code: 2,
        name: "Admin"
    }];



    $http.get(API + "user/list").then(function (response) {
        $scope.users = response.data;
    });

    $scope.modal = function (state, id) {
        $scope.state = state;
        switch (state) {
            case "add":
                $scope.frmtitle = "Thêm Admin";
                break;
        }
        $("#myModal").modal("show");
    }
    $scope.save = function (state, id) {
        if (state == "add") {
            var url = API + "user/add";
            var data = $.param($scope.user);
            console.log($scope.user);
            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
                .then(function (response) {
                    console.log(response);
                    location.reload();
                })
                .catch(function (response) {
                    console.log(response);
                    alert("Xảy ra lỗi!");
                });
        }
    }
    $scope.confirmDelete = function (id) {
        if (confirm("Bạn có muốn thu hồi quyền của admin này không?"))
            $http.get(API + "user/delete/" + id).then(function (response) {
                location.reload();
            }).catch(function (response) {
                alert("Xảy ra lỗi!");
            });
    }
});