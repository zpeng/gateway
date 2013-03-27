
<?php
require_once('../../included/class_loader.php') ;


$link_type_id = secureRequestParameter($_REQUEST["link_type_id"]);


if($link_type_id == 0) {
    //Customize Link
    echo "<table width='800' border='0' style='font:100%;' cellpadding='3'  >
        <tr>
            <td width='150' align='right' ><b>Customize Link</b></td>
            <td align='left'><input name='menu_link' style='width: 250px;'
            value='http://' ></td>

        </tr>
       </table>
     ";

}else {

    echo "<table width='800' border='0' style='font:100%;' cellpadding='3'  >
        <tr>
            <td width='150' align='right' valign='top' ><b>Contents:</b></td>
            <td align='left' style='border:1px solid gray'>";
    echo outputContentAsTreeNodeRadioBox();
    echo "</td>
        </tr>
       </table>";
}



?>
