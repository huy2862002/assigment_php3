
var del = document.querySelectorAll('#btn-delete');
del.forEach(function(item){
    item.onclick = function () {
        var result = confirm("Bạn Có Chắc Chắn Muốn Xóa Không ?");
        if (result == true) {
            return true;
        }
        else {
           return false;
        }
    }
});


