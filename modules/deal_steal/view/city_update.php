<h1 class="content_title">City Detail</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\City;
    $city_id = secureRequestParameter($_REQUEST["city_id"]);
    $city = new City();
    $city->load($city_id);
    ?>
    <br/>

    <form id="CityUpdateForm">
        <input type="hidden" value="<?= $city_id ?>" name="city_id" id="city_id"/>
        <table class="general_table">
            <tr>
                <td width="150" align="right"><b>Original Value: </b></td>
                <td id="original_vale"><? echo $city->getCityName()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>New Value: </b></td>
                <td><input name="city_name" id="city_name" type="text" style="width: 200px;"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input name='update' id="update_btn" type='submit' value='Update' title="update"/>
                    <a class='confirm_delete' id="delete_link" title='Delete this city'
                       href='<?=SERVER_URL?>modules/deal_steal/control/city_delete.php?city_id=<?=$city_id?>&module_code=<?=$_REQUEST["module_code"]?>'>Delete</a>
                </td>
            </tr>
        </table>
    </form>
    <script>
        // load css
        head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

        // load js
        head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-form-validate")
    , $JS_DEPS)?>, function () {
            $("#update_btn").button();

            $("#delete_link").button();

            //form validation
            jQuery("input#city_name").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter the city name"
            });

            jQuery('form#CityUpdateForm').validated(function () {
                var city_id = $("#city_id").val();
                var city_name = $("#city_name").val();

                $.ajax({
                    url: SERVER_URL + "modules/deal_steal/control/city_update.php",
                    type: "POST",
                    data: {city_id: city_id,
                        city_name: city_name
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            jQuery("div#notification").html("<span class='info'>Value has been updated successfully!</span>");
                            jQuery("#original_vale").html(city_name);
                        } else {
                            jQuery("div#notification").html("<span class='error'>Unable to update this city. Try again please!</span>");
                        }
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
                return false;
            });

            // Add Confirmation dialogs for all Deletes
            jQuery("a.confirm_delete").click(function (event) {
                return confirm('Are you sure you want to delete this record?');
            });

        });
    </script>
</div>
