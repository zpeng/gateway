<?php
class City{
    public $city_id;
    public $city_name;

    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function setCityName($city_name)
    {
        $this->city_name = $city_name;
    }

    public function getCityName()
    {
        return $this->city_name;
    }

    public function load($id)
    {
        $link = getConnection();
        $query = " select   city_id,
                            city_name
                   from     ds_city
                   where    city_id =  ".$id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setCityId($newArray['city_id']);
            $this->setCityName($newArray['city_name']);
        }
    }

    public function delete()
    {
        $link = getConnection();
        $query = " delete
                   from   ds_city
                   WHERE  city_id =  ".$this->getCityId();
        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_city
                   (city_name)
                   VALUES ('".$this->getCityName()."')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update(){
        $link = getConnection();
        $query = " UPDATE ds_city
                   SET    city_name = '".$this->getCityName()."'
                   WHERE  city_id = " . $this->getCityId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

}


?>