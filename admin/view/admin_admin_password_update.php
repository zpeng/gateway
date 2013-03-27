<?
require_once("../included/class_loader.php") ;

$admin_id = secureRequestParameter($_REQUEST["admin_id"]);
$admin = new Administrator();
$admin->loadByID($admin_id);
?>

<form id="userPasswordUpdateForm"  action='process/admin_admin_password_update_process.php' method='post'
      onsubmit='return checkFormAdminPasswordUpdate(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Administrator Password Update</span>
        </div>
        <div class="button_block">
            <a>
                <input name='update' type='image'  value='update' title="update" src="images/save_24.png"  />
            </a><br/>
            <b>Update</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_admin_list">
                <img src="images/go_back_24.png" />
                <br/>
                <b>Go Back</b>
            </a>            
        </div>
    </fieldset>
    <?
    include_once 'admin_msg_view.php';
    ?>
    <fieldset class="content_fieldset">
        <br/>
        <input type="hidden" value="<? echo $admin_id ?>" name="admin_id" />
        <table width="800" border="0" class="dialogTable" >
            <tr >
                <td width="150" align="right"><b>Admin Name: </b></td>
                <td><? echo $admin->get_admin_name()?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>New Password: </b></td>
                <td><input name="password" id="password" type="password" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
    </fieldset>
</form>
