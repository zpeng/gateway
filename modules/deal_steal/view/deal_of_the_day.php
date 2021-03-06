<script id="html_deal_list_template" type="text/x-jquery-tmpl">
    <ul class="deals_list">
        {{each data}}
        <li id="${id}" class="deal_item" title="${tooltip}">${name}</li>
        {{/each}}
    </ul>
</script>

<script id="html_select_template" type="text/x-jquery-tmpl">
    <select id="supplier_dropdown" name="supplier_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if id === $item.selectedId}} selected="selected"{{/if}} value="${id}">${name}</option>
</script>

<h1 class="content_title">Deal of the Day</h1>
<div id="notification"></div>
<style>
    #left_holder {
        float: left;
        width: 150px;
    }

    #deals_list_div {
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
    }

    #trash_div {
        margin-top: 20px;
        width: 150px;
        height: 150px;
        border: 1px solid #ccc;
        background: url(../admin/images/trash_icon.png) no-repeat;
    }

    ul.deals_list {
        padding: 0;
        list-style: none;
    }

    .deal_item {
        /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
    }

    #calendar {
        width: 700px;
        margin: 10px;
        float: left;
    }
</style>
<div id="content">
    <div id='loading' style='display:none'>loading...</div>
    <div id="left_holder">
        <div id="deals_list_div">
            <h4> Available Deals</h4>
            <div id="supplier_dropdown_div"></div>
            <div id="deal_list_div"></div>
        </div>
        <div id="trash_div"></div>
    </div>

    <div id='calendar'></div>
</div>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "fullcalendar-css",
    "jquery-ui-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-tmpl",
    "fullcalendar-js")
    , $JS_DEPS)?>, function () {
        $(document).ready(function () {
            // enable jquery tooltip
            $(document).tooltip({
                content: function() {
                    return $( this ).attr( "title" );
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                events: {
                    url: SERVER_URL + 'modules/deal_steal/control/deal_of_the_day.php',
                    type: 'POST',
                    data: {
                        // The GET parameter names will be determined by the startParam and endParam options. ("start" and "end" by default).
                        operation_id: "load"
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                },

                //update a event to another day
                eventDrop: function (event, delta) {
                    $.ajax({
                            url: SERVER_URL + "modules/deal_steal/control/deal_of_the_day.php",
                            dataType: 'json',
                            data: {
                                dod_id: event.id,
                                dod_change_day: delta,
                                operation_id: "update"
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.status == "success") {
                                    jQuery("div#notification").html("<span class='info'>Deal of the Day has been updated successfully!</span>");
                                } else {
                                    jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                                }
                                $('#calendar').fullCalendar('rerenderEvents');
                            },
                            error: function (msg) {
                                ajaxFailMsg(msg);
                            }
                        }
                    );
                },

                //create a event
                drop: function (date, allDay) { // this function is called when something is dropped
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    Date.prototype.yyyymmdd = function () {
                        var yyyy = this.getFullYear().toString();
                        var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
                        var dd = this.getDate().toString();
                        return yyyy + (mm[1] ? mm : "0" + mm[0]) + (dd[1] ? dd : "0" + dd[0]); // padding
                    };

                    //now , update the database
                    $.ajax({
                            url: SERVER_URL + "modules/deal_steal/control/deal_of_the_day.php",
                            dataType: 'json',
                            data: {
                                deal_id: copiedEventObject.deal_id,
                                dod_date: copiedEventObject.start.yyyymmdd(),
                                operation_id: "create"
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.status == "success") {
                                    jQuery("div#notification").html("<span class='info'>Deal of the Day has been created successfully!</span>");
                                    copiedEventObject.id = data.id;
                                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                                } else {
                                    jQuery("div#notification").html("<span class='error'>Unable to create. Try again please!</span>");
                                }
                            },
                            error: function (msg) {
                                ajaxFailMsg(msg);
                            }
                        }
                    );

                },

                loading: function (bool) {
                    if (bool) {
                        $('#loading').show();
                    }
                    else {
                        $('#loading').hide();

                    }
                }
            });

            $("#trash_div").droppable({
                drop: function (event, ui) {
                    if (confirm('Are you sure you wish to delete this item?')) {
                        //console.log(ui.draggable.attr("id"));
                        //now , update the database
                        $.ajax({
                                url: SERVER_URL + "modules/deal_steal/control/deal_of_the_day.php",
                                dataType: 'json',
                                data: {
                                    dod_id: ui.draggable.attr("id"),
                                    operation_id: "delete"
                                },
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == "success") {
                                        jQuery("div#notification").html("<span class='info'>The item has been delete successfully!</span>");
                                        $('#calendar').fullCalendar('refetchEvents');
                                    } else {
                                        jQuery("div#notification").html("<span class='error'>Unable to delete this item. Try again please!</span>");
                                    }
                                },
                                error: function (msg) {
                                    ajaxFailMsg(msg);
                                }
                            }
                        );
                    }
                }
            });



            function fetch_supplier_dropdown_data() {
                $.ajax({
                    url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                    type: "POST",
                    data: {
                        operation_id: "fetch_supplier_dropdown_list",
                        active: "Y"
                    },
                    dataType: "json",
                    success: function (data) {
                        $("#html_select_template").tmpl(data).appendTo("#supplier_dropdown_div" );
                        fetch_deal_list_data();

                        //when the supplier  dropdown selection is changed
                        $("#supplier_dropdown").change(function(e) {
                            fetch_deal_list_data();
                        });
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
            }

            function fetch_deal_list_data() {
                $.ajax({
                    url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                    type: "POST",
                    data: {
                        operation_id: "fetch_deal_list",
                        supplier_id: $("#supplier_dropdown option:selected").val()
                    },
                    dataType: "json",
                    success: function (data) {
                        $("#deal_list_div").empty();
                        $("#html_deal_list_template").tmpl(data).appendTo("#deal_list_div");

                        $('#deals_list_div li.deal_item').each(function () {
                            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                            // it doesn't need to have a start or end
                            var eventObject = {
                                title: $.trim($(this).text()), // use the element's text as the event title
                                deal_id: $.trim($(this).attr("id")) //get the id from dom
                            };
                            // store the Event Object in the DOM element so we can get to it later
                            $(this).data('eventObject', eventObject);

                            // make the event draggable using jQuery UI
                            $(this).draggable({
                                zIndex: 999,
                                revert: true,      // will cause the event to go back to its
                                revertDuration: 0  //  original position after the drag,
                            });
                        });

                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
            }


            //when page rendering is completed
            $(document).ready(function () {
                fetch_supplier_dropdown_data();
            });
        });
    });
</script>
