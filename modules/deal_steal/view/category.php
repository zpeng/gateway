<h1 class="content_title">Deal Category</h1>
<div id="notification"></div>
<div id="content">
    <div id="category_tree"></div>


</div>
<script>
    $("#category_tree").jstree({
        "json_data": {
            "ajax": {
                "url": SERVER_URL + "modules/deal_steal/control/category.php",
                "data": function (n) {
                    return {
                        "operation": "load_category",
                        "id": n.attr ? n.attr("id") : 0
                    };
                }
            }
        },
        "plugins": [ "themes", "json_data" , "crrm", "cookies", "dnd", "hotkeys" , "ui", "contextmenu"]
    }).bind("create.jstree", function (e, data) {
            $.post(
                SERVER_URL + "modules/deal_steal/control/category.php",
                {
                    "operation": "create_category",
                    "parent_id": data.rslt.parent.attr("id"),
                    "name": data.rslt.name
                },
                function (r) {
                    if (r.status) {
                        $(data.rslt.obj).attr("id", r.id);
                    }
                    else {
                        $.jstree.rollback(data.rlbk);
                    }
                }
            );
        })
        .bind("remove.jstree", function (e, data) {
            data.rslt.obj.each(function () {
                $.ajax({
                    async : false,
                    type: 'POST',
                    url: SERVER_URL + "modules/deal_steal/control/category.php",
                    data : {
                        "operation" : "remove_category",
                        "id" : this.id
                    },
                    success : function (r) {
                        if(!r.status) {
                            data.inst.refresh();
                        }
                    }
                });
            });
        })
        .bind("rename.jstree", function (e, data) {
            $.post(
                SERVER_URL + "modules/deal_steal/control/category.php",
                {
                    "operation" : "rename_category",
                    "id" : data.rslt.obj.attr("id"),
                    "name" : data.rslt.new_name
                },
                function (r) {
                    if(!r.status) {
                        $.jstree.rollback(data.rlbk);
                    }
                }
            );
        }).bind("move_node.jstree", function (e, data) {
            data.rslt.o.each(function (i) {
                $.ajax({
                    async : false,
                    type: 'POST',
                    url: SERVER_URL + "modules/deal_steal/control/category.php",
                    data : {
                        "operation" : "move_category",
                        "id" : $(this).attr("id").replace("node_",""),
                        "parent_id" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id")
                    },
                    success : function (r) {
                        if(!r.status) {
                            $.jstree.rollback(data.rlbk);
                        }
                        else {
                            $(data.rslt.oc).attr("id", r.parent_id);
                        }
                    }
                });
            });
        });;


</script>