<?php
namespace modules\deal_steal\includes\classes;


class CityManager
{
    public function loadCityAsMap()
    {
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

    public function loadCityList()
    {
        $city_list = array();
        $link = getConnection();
        $query = "select city_id,  city_name
                  from	 ds_city ";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $city = new City();
            $city->setCityId($newArray['city_id']);
            $city->setCityName($newArray['city_name']);
            array_push($city_list, $city);
        }
        return $city_list;
    }

    public function getCityTableDataSource()
    {
        $city_map = $this->loadCityAsMap();
        $dataSource = array();
        if (sizeof($city_map) > 0) {
            foreach ($city_map as $key => $value) {
                array_push($dataSource, array(
                    "id" => $key,
                    "name" => $value,
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }

    public function getCityListDataSource()
    {
        $city_map = $this->loadCityAsMap();
        $data = array();
        if (sizeof($city_map) > 0) {
            foreach ($city_map as $key => $value) {
                array_push($data, array(
                    "id" => $key,
                    "name" => $value
                ));
            }
        }
        $dataSource = array(
            "data" => $data,
            "selected_value" => ""
        );
        return $dataSource;
    }
}

?>