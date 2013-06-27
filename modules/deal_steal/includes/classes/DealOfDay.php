<?php
namespace  modules\deal_steal\includes\classes;

class DealOfDay
{
    public $id;
    public $deal_id;
    public $title;
    public $date;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDealId($deal_id)
    {
        $this->deal_id = $deal_id;
    }

    public function getDealId()
    {
        return $this->deal_id;
    }

    public function update($day_change){
    $link = getConnection();
    $query = "  UPDATE ds_deal_of_day
                    SET date = DATE(DATE_ADD(date, INTERVAL ".$day_change." DAY))
                    WHERE id  = " . $this->getId();

    executeUpdateQuery($link, $query);
    closeConnection($link);
}

    public function insert(){
        $link = getConnection();
        $query = " INSERT INTO   ds_deal_of_day
                    (  deal_id,
                       date)
                   VALUES ( '" . $this->getDealId() . "',
                            '" . $this->getDate() . "')";

        executeUpdateQuery($link, $query);
        $last_insert_id = mysql_insert_id();
        closeConnection($link);
        return $last_insert_id;
    }

    public function delete($id){
        $link = getConnection();
        $query = " DELETE FROM   ds_deal_of_day
                   WHERE id = ".$id;
        executeUpdateQuery($link, $query);
        closeConnection($link);
    }


}

?>