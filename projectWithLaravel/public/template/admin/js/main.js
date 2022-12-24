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
    console.log($(".search").val());
    $.ajax({
        type: "get",
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
