<h1 class="content_title">Tags</h1>
<div id="content">
    <input name="deal_tags" id="deal_tags" />
</div>
<script>
    $.ajax({
        url: SERVER_URL + "modules/deal_steal/admin/control/tags.php",
        dataType: 'json',
        data: {
            operation: "load_tags"
        },
        success:function (data){
            jQuery("input#deal_tags").val(data);

            $('#deal_tags').tagsInput({
                width:'700px',
                height:'300px',
                onAddTag: function (value) {
                    $.ajax({
                        url: SERVER_URL + "modules/deal_steal/admin/control/tags.php",
                        dataType: 'json',
                        data: {
                            operation: "add_tag",
                            tag_value: value
                        },
                        success:function (data){
                            jQuery("input#deal_tags").val(data);
                        }});
                },
                onRemoveTag: function(value){
                    $.ajax({
                        url: SERVER_URL + "modules/deal_steal/admin/control/tags.php",
                        dataType: 'json',
                        data: {
                            operation: "delete_tag",
                            tag_value: value
                        },
                        success:function (data){
                            jQuery("input#deal_tags").val(data);
                        }});
                }
            });
        }
    });


</script>
