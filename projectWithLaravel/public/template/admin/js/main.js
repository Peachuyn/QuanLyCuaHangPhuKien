$(document).keypress(function (e) {
    if (e.which == 13) {
        $(".btn-search").click();
    }
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function removeRow(id, url) {
    if (confirm("Xóa mà không thể khôi phục. Bạn có chắc ?")) {
        $.ajax({
            type: "DELETE",
            datatype: "JSON",
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message);
                }
            },
        });
    }
}

function search(url) {
    var data = $(".search").val();
    $.ajax({
        type: "GET",
        datatype: "JSON",
        data: { data },
        url: url,
        success: function (result) {
            console.log(result);
            $("tbody").html(result);
        },
    });
}
function thongke(url) {
    let d = new Date($(".thangnam").val());
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    $.ajax({
        type: "get",
        datatype: "JSON",
        data: { month, year },
        url: url,
        success: function (result) {
            $("tbody").html(result);
        },
    });
}
function thongkecp(url) {
    let d = new Date($(".thangnamcp").val());
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    $.ajax({
        type: "get",
        datatype: "JSON",
        data: { month, year },
        url: url,
        success: function (result) {
            $("tbody").html(result);
        },
    });
}
