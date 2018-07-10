
// Create and Edit page
function changeInput(val) {
    slug = val.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    console.log(slug)
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@'+slug+'@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    slug = slug.trim();
    $('#prefix').val(slug)
}

function removeDisabled(){
    if($('.region-select').removeAttr('disabled')){
        return true;
    }
    else return false;

}

function changeRegion(){
    var data = $('#category option:selected').val();
    $('.loader').attr('style','display:inline-block');
    if(data!=0){
        $('.region-select').prop('disabled',true);
        $.ajax({
            url: '/news/news_category/checkRegion',
            type: 'GET',
            data: {
                id: data
            },
            success: function (respond) {
                $('.loader').attr('style','display:none');
                var data = document.getElementsByClassName('region');
                for(var i=0; i<data.length;i++){

                    if(data[i].value == respond){
                        data[i].selected='selected';
                    }
                    else{
                        data[i].selected='';
                    }
                }
            }
        });

    }
    else{
        $('.loader').attr('style','display:none');
        $('.region-select').prop('disabled',false);
    }
}



// -------------
//     Index PAge
$('input').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
});

// var data;
// var array_className = ($('#checkHasChildren').parent().get(0).className).split(" ");
// if(typeof (array_className[1]) != 'undefined'){
//     if(array_className[1]=="checked"){
//         data = 1;
//     }
//     else {
//         data = 0;
//     }
// }
// else {
//     data =0;
// }
// console.log(data);
$(function() {
    table = $('#category_table').DataTable({
        processing: true,
        serverSide: true,
        bAutoWidth: true,
        searching: false,
        ajax: {
            url: 'news_category/get',
            type: 'get',
            data: function (d) {
                d.category = $('#category option:selected').val();
                d.checkHasChildren =$('input#checkHasChildren:checked').val();
                // d.checkTypeOrder =$('input#checkTypeOrder:checked').val();
            }
        },
        columns: [
            {data: 'id', sortable: false},
            {data: 'name',name:'news_categories.name'},
            {data: 'parent_id',name:'news_categories.parent_id'},
            {data: 'position',name:'news_categories.position'},
            {data: 'status',name:'news_categories.status'},
            {data: 'actions'}
        ],
        "language": {
        //     "lengthMenu": "Hiển thị _MENU_ bản ghi trên một trang",
        //     "zeroRecords": "Không tìm bản ghi phù hợp",
        //     "info": "Đang hiển thị trang _PAGE_ of _PAGES_",
        //     "infoEmpty": "Không có dữ liệu",
        //     "infoFiltered": "(lọc từ tổng số _MAX_ bản ghi)",
        //     "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ kết quả",
        //     "paginate": {
        //         "first":      "Đầu tiên",
        //         "last":       "Cuối cùng",
        //         "next":       "Sau",
        //         "previous":   "Trước"
        //     },
            "sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading'
        },
    });
});
function filter(){
    table.draw();
}