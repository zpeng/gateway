<?php
class CityManager{
    public function loadCityAsMap(){
        $city_map = array();
        $link = getConnection();
        $query = "select city_id,  city_name
                  from	 ds_city ";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $city_map[$newArray['city_id']] = $newArray['city_name'];
        }
        return $city_map;
    }

    public function outputCitiesAsHtmlTable($id = "", $class = "")
    {
        $htmlTable = "<table id='$id' class='$class'>";
        $htmlTable = $htmlTable . "<tr>
                                    <th>ID</th>
                                    <th>City Name</th>
                                    <th>Action</th>
                                    </tr>";

        $city_map = $this->loadCityAsMap();

        if (sizeof($city_map) > 0) {
            foreach ($city_map as $key=>$value) {
                $htmlTable = $htmlTable . " <tr>
                                <td>" . $key . "</td>
                                <td>" . $value . "</td>
                                <td>
                                <a class='icon_delete' title='Delete this city' href='" . SERVER_URL . "modules/deal_steal/admin/control/city_delete.php?city_id=" .
                    $key . "&module_code=" . $_REQUEST['module_code'] . "'
                        onclick='return confirmDeletion()'></a>
                                <a class='icon_edit' title='Update City' href='" . SERVER_URL . "admin/main.php?view=city_update&city_id=" .
                    $key . "&module_code=" . $_REQUEST['module_code'] . "' ></a>
                                </td>
                                </tr> ";
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }
}

?>