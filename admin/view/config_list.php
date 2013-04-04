<h1 class="content_title">Configuration List</h1>
<div id="content">
    <?
    $configManager = new ConfigurationManager();
    ?>
    <div id="data_table">
    </div>
</div>
<script>
    window.onload= function loadTable() {

        /** Columns definition */
        var columns = [
            { name: "configuration_module_name", label: "Module Name", cell: "string", editable: false },
            { name: "configuration_title", label: "Config Name", cell: "string", editable: false },
            { name: "configuration_key", label: "Config key", cell: "string", editable: false },
            { name: "configuration_value", label: "Config Value", cell: "string", editable: true },
            { name: "configuration_desc", label: "Description", cell: "string", editable: false },
            { name: "configuration_type", label: "Data Type", cell: "string", editable: false },
            { name: "configuration_operation", label: "Operation", cell: "string", editable: false }
        ];

        /** Model instance */
        var mdl = Backbone.Model.extend({});

        /** Collection instance */
        var col = Backbone.Collection.extend({
            model: mdl
        });

        /** Create the Grid */
        var grid = new Backgrid.Grid({
            columns: columns,
            collection: new col(jQuery.parseJSON('<?=$configManager->loadAllConfigAsJSON()?>'))
        });

        /** Add the Grid to the container */
        jQuery("#data_table").append(grid.render().$el);
    };
</script>