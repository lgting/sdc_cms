var admin = {};

admin.response = function(url, method, form, successCallback, errorCallback) {
    $.ajax({
        url: url,
        type: method,
        data: form,
        success: successCallback,
        error: errorCallback
    });
};

admin.eachErrors = function(xhr) {
    var context = xhr.responseJSON;
    $.each(context.errors, function(index, obj) {
        layer.msg(obj[0], { icon: 5 });
    });
};

admin.successUpdatedCallback = function(res) {
    if (res.status == 201) {
        layer.alert(res.message, { icon: 6 }, function() {
            // 获得frame索引
            var index = parent.layer.getFrameIndex(window.name);
            //关闭当前frame
            parent.layer.close(index);
            parent.location.reload();
        });
    } else {
        layer.msg(res.message);
    }
};

admin.errorUpdateCallback = function(xhr) {
    admin.eachErrors(xhr);
};

admin.item_update = function(form, url) {
    form.on("submit(update)", function(data) {
        var form = data.field;
        form._method = "PATCH";
        //发异步，把数据提交给php
        admin.response(
            url,
            "POST",
            form,
            admin.successCreatedCallback,
            admin.errorUpdateCallback
        );
        return false;
    });
};

admin.successCreatedCallback = function(res) {
    if (res.status == 200) {
        layer.alert(res.message, { icon: 6 }, function() {
            // 获得frame索引
            var index = parent.layer.getFrameIndex(window.name);
            //关闭当前frame
            parent.layer.close(index);
            parent.location.reload();
        });
    } else {
        layer.msg(res.message);
    }
};

admin.errorCreateCallback = function(xhr) {
    admin.eachErrors(xhr);
};

admin.item_create = function(form, url) {
    form.on("submit(add)", function(data) {
        var form = data.field;
        form._method = "POST";
        admin.response(
            url,
            "POST",
            form,
            admin.successUpdatedCallback,
            admin.errorCreateCallback
        );
        //发异步，把数据提交给php
        return false;
    });
};

admin.successDeletedCallback = function(res) {
    if (res.status == 204) {
        layer.msg(res.message, { icon: 1, time: 1000 });
        location.reload();
    } else {
        layer.msg(res.message, { icon: 5 });
        return;
    }
};
admin.errorDeleteCallback = function(xhr) {
    admin.eachErrors(xhr);
};

admin.item_del = function(obj, url) {
    layer.confirm("确认要删除吗？", function(index) {
        admin.response(
            url,
            "POST",
            { _method: "DELETE" },
            admin.successDeletedCallback,
            admin.errorDeleteCallback
        );
    });
};

admin.deleteFileCollback = function(res) {
    console.log(res.message);
};

admin.deleteFileErrorRollback = function(xhr) {
    admin.eachErrors(xhr);
};

admin.delete_file = function(url, file_name) {
    admin.response(
        url,
        "POST",
        { file_name },
        admin.deleteFileCollback,
        admin.deleteFileErrorRollback
    );
};

admin.loginCollback = function(res) {
    if (res.status == 404) {
        layer.msg(res.message, { icon: 5 });
    }
    if (res.status == 201) {
        layer.msg(res.message, { icon: 1 }, function() {
            location.href = res.redirect_url;
        });
    }
};

admin.loginErrorCollback = function(xhr) {
    admin.eachErrors(xhr);
};

admin.login = function(url, form) {
    form.on("submit(login)", function(data) {
        var form = data.field;
        admin.response(
            url,
            "POST",
            form,
            admin.loginCollback,
            admin.loginErrorCollback
        );
        return false;
    });
};

admin.userUpdateCallback = function(res) {
    layer.msg(res.message, { icon: 1 }, function() {
        var index = parent.layer.getFrameIndex(window.name);
        //关闭当前frame
        parent.layer.close(index);
        parent.location.href = res.redirect_url;
    });
};

admin.userUpdateErrorCallback = function(xhr) {
    admin.eachErrors(xhr);
};

admin.user_update = function(form, url) {
    form.on("submit(update)", function(data) {
        var form = data.field;
        admin.response(
            url,
            "POST",
            form,
            admin.userUpdateCallback,
            admin.userUpdateErrorCallback
        );
        return false;
    });
};
