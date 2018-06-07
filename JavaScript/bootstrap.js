$(function() {
    var $previewContainer = $('#comment-md-preview-container');
    $previewContainer.hide();
    var $md = $("#comment-md").markdown({
        autofocus: false,
        height: 270,
        iconlibrary: 'fa',
        onShow: function(e) {
            e.hideButtons('cmdPreview');
            //e.change(e);
        }
        /*onChange: function(e) {
            var content = e.parseContent();
            if (content === '') $previewContainer.hide();
            else $previewContainer.show().find('#comment-md-preview').html(content).find('table').addClass('table table-bordered table-striped table-hover');
        }*/
    });
});