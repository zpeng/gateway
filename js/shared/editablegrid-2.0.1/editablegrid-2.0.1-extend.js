var SERVER_URL = "http://" + window.location.hostname + "/gateway/";

// function to render the paginator control
EditableGrid.prototype.updatePaginator = function () {
    var paginator = $("#paginator").empty();
    var nbPages = this.getPageCount();

    // get interval
    var interval = this.getSlidingPageInterval(20);
    if (interval == null) return;

    // get pages in interval (with links except for the current page)
    var pages = this.getPagesInInterval(interval, function (pageIndex, isCurrent) {
        if (isCurrent) return "" + (pageIndex + 1);
        return $("<a>").css("cursor", "pointer").html(pageIndex + 1).click(function (event) {
            editableGrid.setPageIndex(parseInt($(this).html()) - 1);
        });
    });

    // "first" link
    var link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/gofirst.png") + "'/>&nbsp;");
    if (!this.canGoBack()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        editableGrid.firstPage();
    });
    paginator.append(link);

    // "prev" link
    link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/prev.png") + "'/>&nbsp;");
    if (!this.canGoBack()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        editableGrid.prevPage();
    });
    paginator.append(link);

    // pages
    for (p = 0; p < pages.length; p++) paginator.append(pages[p]).append(" | ");

    // "next" link
    link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/next.png") + "'/>&nbsp;");
    if (!this.canGoForward()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        editableGrid.nextPage();
    });
    paginator.append(link);

    // "last" link
    link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/golast.png") + "'/>&nbsp;");
    if (!this.canGoForward()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        editableGrid.lastPage();
    });
    paginator.append(link);
};

// this function will initialize our editable grid
EditableGrid.prototype.initializeGrid = function () {
    with (this) {
        // register the function that will handle model changes
        modelChanged = function (rowIndex, columnIndex, oldValue, newValue, row) {
            displayMessage("Value for '" + this.getColumnName(columnIndex) + "' in row " + this.getRowId(rowIndex) + " has changed from '" + oldValue + "' to '" + newValue + "'");
            if (this.getColumnName(columnIndex) == "continent") this.setValueAt(rowIndex, this.getColumnIndex("country"), ""); // if we changed the continent, reset the country
            this.renderCharts();
        };

        // update paginator whenever the table is rendered (after a sort, filter, page change, etc.)
        editableGrid.tableRendered = function () {
            this.updatePaginator();
        };

        // set active (stored) filter if any
        _$('filter').value = currentFilter ? currentFilter : '';

        // filter when something is typed into filter
        _$('filter').onkeyup = function () {
            editableGrid.filter(_$('filter').value);
        };

        // bind page size selector
        $("#pagesize").val(pageSize).change(function () {
            editableGrid.setPageSize($("#pagesize").val());
        });

        editableGrid.renderGrid();

    }
};