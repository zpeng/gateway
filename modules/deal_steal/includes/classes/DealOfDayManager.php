<?php
namespace modules\deal_steal\includes\classes;

class DealOfDayManager
{
    private function loadDealsOfTheDays($start, $end)
    {
        $deal_list = array();
        $link = getConnection();
        $query = " SELECT     ds_deal_of_day.id,
                              ds_deal.deal_id,
                              CONCAT(ds_supplier.supplier_name, ' - ', ds_deal.deal_title) as deal_title,
                              ds_deal_of_day.date
                            FROM
                              ds_deal,
                              ds_supplier,
                              ds_deal_of_day
                            WHERE deal_archived = 'N'
                              AND ds_supplier.supplier_id = ds_deal.supplier_id
                              AND ds_deal_of_day.deal_id = ds_deal.deal_id
                              AND ds_deal_of_day.date > '" . $start . "'
                              AND ds_deal_of_day.date < '" . $end . "'";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $dod = new DealOfDay();
            $dod->setId($newArray['id']);
            $dod->setDealId($newArray['deal_id']);
            $dod->setTitle($newArray['deal_title']);
            $dod->setDate($newArray['date']);
            array_push($deal_list, $dod);
        }
        return $deal_list;
    }

    public function getDealOfTheDayDataSource($start, $end)
    {
        $deal_list = $this->loadDealsOfTheDays($start, $end);
        $dataSource = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $dod) {
                array_push($dataSource, array(
                    'id' => $dod->getId(),
                    'title' => $dod->getTitle(),
                    'start' => $dod->getDate(),
                    'url' => ""
                ));
            }
        }
        return $dataSource;
    }
}

?>