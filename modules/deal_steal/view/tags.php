<h1 class="content_title">Tags</h1>
<div id="notification"></div>
<div id="content">
    <input name="deal_tags" id="deal_tags"/>
</div>
<script>
    // load css
    head.js(<?=outputDependencies(
    array("jquery-tag-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array("jquery-tag")
    , $JS_DEPS)?>, function () {
        $.ajax({
            url: SERVER_URL + "modules/deal_steal/control/tags.php",
            dataType: 'json',
            data: {
                operation: "load_tags"
            },
            success: function (data) {
                jQuery("input#deal_tags").val(data);

                $('#deal_tags').tagsInput({
                    width: '700px',
                    height: '300px',
                    onAddTag: function (value) {
                        $.ajax({
                            url: SERVER_URL + "modules/deal_steal/control/tags.php",
                            dataType: 'json',
                            data: {
                                operation: "add_tag",
                                tag_value: value
                            },
                            success: function (data) {
                                jQuery("input#deal_tags").val(data);
                            },
                            error: function (msg) {
                                ajaxFailMsg(msg);
                            }
                        });
                    },
                    onRemoveTag: function (value) {
                        $.ajax({
                            url: SERVER_URL + "modules/deal_steal/control/tags.php",
                            dataType: 'json',
                            data: {
                                operation: "delete_tag",
                                tag_value: value
                            },
                            success: function (data) {
                                jQuery("input#deal_tags").val(data);
                            },
                            error: function (msg) {
                                ajaxFailMsg(msg);
                            }
                        });
                    }
                });
            }
        });
    });
</script>
