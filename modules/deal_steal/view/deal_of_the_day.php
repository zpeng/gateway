<h1 class="content_title">Deal of the Day</h1>
<div id="notification"></div>
<style>
    #calendar {
        width: 700px;
        margin: 10px;
        float: left;
    }

    #deals_list_div {
        float: left;
        width: 150px;
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
    }

    ul.deals_list {
        padding: 0;
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
</style>
<div id="content">
    <div id='loading' style='display:none'>loading...</div>

    <div id="deals_list_div">
        <h4>Available Deals<h4>
                <?
                use modules\deal_steal\includes\classes\DealManager;
                $dealManager = new DealManager();
                echo createList("", "deals_list", "deal_item", $dealManager->getDealsListDataSource());
                ?>
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
    "fullcalendar-js")
    , $JS_DEPS)?>, function () {
        $(document).ready(function () {
            /* initialize the external events
             -----------------------------------------------------------------*/

            $('#deals_list_div li.deal_item').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    id: $.trim($(this).attr("id")) //get the id from dom
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });

            $('#calendar').fullCalendar({
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                events: SERVER_URL + "modules/deal_steal/control/deal_of_the_day_load.php",

                eventDrop: function (event, delta) {
                    $.ajax({
                        url: SERVER_URL + "modules/deal_steal/control/deal_of_the_day_change.php",
                        dataType: 'json',
                        data: {
                            dod_id: event.id,
                            dod_change_day: delta
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.status == "success") {
                                jQuery("div#notification").html("<span class='info'>Deal of the Day has been updated successfully!</span>");
                            } else {
                                jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                            }
                        },
                        error: function () {
                            jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                        }}
                    );
                },

                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    Date.prototype.yyyymmdd = function() {
                        var yyyy = this.getFullYear().toString();
                        var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
                        var dd  = this.getDate().toString();
                        return yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]); // padding
                    };

                    //now , update the database
                    $.ajax({
                            url: SERVER_URL + "modules/deal_steal/control/deal_of_the_day_create.php",
                            dataType: 'json',
                            data: {
                                deal_id: copiedEventObject.id,
                                dod_date: copiedEventObject.start.yyyymmdd()
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.status == "success") {
                                    jQuery("div#notification").html("<span class='info'>Deal of the Day has been created successfully!</span>");
                                } else {
                                    jQuery("div#notification").html("<span class='error'>Unable to create. Try again please!</span>");
                                }
                            },
                            error: function () {
                                jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                            }}
                    );

                },

                loading: function (bool) {
                    if (bool) $('#loading').show();
                    else $('#loading').hide();
                }
            });

        });
    });
</script>
