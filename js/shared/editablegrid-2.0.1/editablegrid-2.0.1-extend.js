// function to render the paginator control
EditableGrid.prototype.updatePaginator = function () {
    var paginator = $("#paginator").empty();
    var nbPages = this.getPageCount();
    var ref_this = this;

    // get interval
    var interval = this.getSlidingPageInterval(20);
    if (interval == null) return;

    // get pages in interval (with links except for the current page)
    var pages = this.getPagesInInterval(interval, function (pageIndex, isCurrent) {
        if (isCurrent) {
            return "" + (pageIndex + 1);
        }
        return $("<a>").css("cursor", "pointer").html(pageIndex + 1).click(function (event) {
            ref_this.setPageIndex(parseInt($(this).html()) - 1);
        });
    });

    // "first" link
    var link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/gofirst.png") + "'/>&nbsp;");
    if (!this.canGoBack()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        ref_this.firstPage();
    });
    paginator.append(link);

    // "prev" link
    link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/prev.png") + "'/>&nbsp;");
    if (!this.canGoBack()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        ref_this.prevPage();
    });
    paginator.append(link);

    // pages
    for (p = 0; p < pages.length; p++) paginator.append(pages[p]).append(" | ");

    // "next" link
    link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/next.png") + "'/>&nbsp;");
    if (!this.canGoForward()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        ref_this.nextPage();
    });
    paginator.append(link);

    // "last" link
    link = $("<a>").html("<img src='" + (SERVER_URL + "js/shared/editablegrid-2.0.1/images/golast.png") + "'/>&nbsp;");
    if (!this.canGoForward()) link.css({ opacity: 0.4, filter: "alpha(opacity=40)" });
    else link.css("cursor", "pointer").click(function (event) {
        ref_this.lastPage();
    });
    paginator.append(link);
};

// this function will initialize our editable grid
EditableGrid.prototype.initializeGrid = function () {
    var ref_this = this;

    // update paginator whenever the table is rendered (after a sort, filter, page change, etc.)
    this.tableRendered = function () {
        ref_this.updatePaginator();
    };
    this.renderGrid();

    // set active (stored) filter if any
    _$('filter').value = this.currentFilter ? this.currentFilter : '';

    // filter when something is typed into filter
    _$('filter').onkeyup = function () {
        ref_this.filter(_$('filter').value);
    };

    // bind page size selector
    $("#pagesize").val(this.pageSize).change(function () {
        ref_this.setPageSize($("#pagesize").val());
    });
};

