//mảng extension hop le để input file
var arr_extension=['png', 'jpg', 'gif', 'pdf', 'psd', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'ods', 'odt', 'zip', 'rar'];
var file_max_size = 10485760;

var validate_fileinput = function (select){
    validated = true;
    for(var i=$(select).length -1; i >= 0; i-- ){
        that = $(select).eq(i);
        if(that.find('input').val()==""){
            //neu file input = trống thi xóa phần bao input đó đi
            that.remove();
        } else {
            that.find('.control-group .control-group label.error').remove();
            ext = that.find('input').val().split('.').pop().toLowerCase();
            // Test neu extension khong hop le
            if($.inArray(ext,arr_extension) == -1 
                    && that.find('input').val()!="") {
                //xóa label lỗi trước khi add label lỗi ko hợp lệ
                that.find('.control-group .control-group label.error').remove();
                // thêm label lỗi khi input file ko hop lệ
                that.find('.control-group .control-group')
                    .append('<label class="error ext" style="display: block !important">Định dạng tài liệu đính kèm không được hỗ trợ.</label>');
                // focus về phần input lỗi
                that.find('.control-group .control-group input').focus();
                validated = false;
            } else {
                // input file hợp lệ thì xóa những label ko hợp lệ đi
                that.find('.control-group .control-group label.error.ext').remove();
            }
            if(parseInt(that.find('input').attr('file_size')) > file_max_size){
                that.find('.control-group .control-group')
                    .append('<label class="error size" style="display: block !important">Kích thước file quá lớn.</label>');
                validated = false;
            } else {
                // input file hợp lệ thì xóa những label ko hợp lệ đi
                that.find('.control-group .control-group label.error.size').remove();
            }
        }    
    };
    return validated;
};

//   không fomat text.
function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
};
