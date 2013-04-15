<?php
class Location{
    public $location_id;
    public $location_parent_id;
    public $location_name;

    public function setLocationId($location_id)
    {
        $this->location_id = $location_id;
    }

    public function getLocationId()
    {
        return $this->location_id;
    }

    public function setLocationName($location_name)
    {
        $this->location_name = $location_name;
    }

    public function getLocationName()
    {
        return $this->location_name;
    }

    public function setLocationParentId($location_parent_id)
    {
        $this->location_parent_id = $location_parent_id;
    }

    public function getLocationParentId()
    {
        return $this->location_parent_id;
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_location
                   (location_parent_id, location_name)
                   VALUES (".$this->getLocationParentId().", '".$this->getLocationName()."')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update(){
        $link = getConnection();
        $query = " UPDATE ds_location
                   SET    location_parent_id = ".$this->getLocationParentId().",
                          location_name = '".$this->getLocationName()."'
                   WHERE  location_id = " . $this->getLocationId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

}