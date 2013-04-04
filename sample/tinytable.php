<?php
include_once("../includes/bootstrap.php");
$configManager = new ConfigurationManager(1);

//print_r($GLOBAL_DEPS["CORE"]["js_frontend_list"]);
?>


<?= outputHTMLStartFrontend($GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]["js_frontend_list"], $GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]["css_frontend_list"], $configManager) ?>

<div class='content'>

    <?
    $userManager = new UserManager();
    $userList = $userManager->getUserList();
    ?>

    <div id="tiny_table_wrapper">
        <div id="tableheader">
            <div class="search">
                <select id="columns" onchange="SorterTable.search('query')"></select>
                <input type="text" id="query" onkeyup="SorterTable.search('query')" />
            </div>
            <span class="details">
                <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                <div><a href="javascript:SorterTable.reset()">reset</a></div>
            </span>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead >
            <tr>
                <th><h3>&nbsp;ID</h3></th>
                <th><h3>Administrator Email</h3></th>
                <th width="100"><h3>Operations</h3></th>
            </tr>
            </thead>
            <tbody>
            <?
            if (sizeof($userList) > 0 ) {
                foreach($userList as $user) {
                    echo "  <tr>
                                <td>".$user->get_user_id()."</td>
                                <td>".$user->get_user_name()."</td>
                                <td>
                                <a href='process/admin_admin_delete_process.php?admin_id=".$user->get_user_id()."'
                                onclick='return confirmDeletion()'>".displayAdminDeleteIcon(15,15,'Delete this user account')."</a>
                                <a href='index.php?view=admin_admin_password_update&admin_id=".$user->get_user_id()."'
                                >".displayAdminEditIcon(15,15,'Update password')."</a>
                                </td>
                                </tr> ";
                }
            }
            ?>
            </tbody>
        </table>

        <div id="tablefooter">
            <div id="tablenav">
                <div>
                    <img src="<?=SERVER_URL?>js/shared/tiny_table/images/first.gif" width="16" height="16" alt="First Page" onclick="SorterTable.move(-1,true)" />
                    <img src="<?=SERVER_URL?>js/shared/tiny_table/images/previous.gif" width="16" height="16" alt="First Page" onclick="SorterTable.move(-1)" />
                    <img src="<?=SERVER_URL?>js/shared/tiny_table/images/next.gif" width="16" height="16" alt="First Page" onclick="SorterTable.move(1)" />
                    <img src="<?=SERVER_URL?>js/shared/tiny_table/images/last.gif" width="16" height="16" alt="Last Page" onclick="SorterTable.move(1,true)" />
                </div>
                <div>
                    <select id="pagedropdown"></select>
                </div>
                <div>
                    <a href="javascript:SorterTable.showall()">view all</a>
                </div>
            </div>
            <div id="tablelocation">
                <div>
                    <select onchange="SorterTable.size(this.value)">
                        <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>

    </div>
</div>


<?= outputHTMLEnd() ?>
<script type="text/javascript">
    var SorterTable = new TINY.table.sorter('SorterTable ','table',{
        headclass:'head',
        ascclass:'asc',
        descclass:'desc',
        evenclass:'evenrow',
        oddclass:'oddrow',
        evenselclass:'evenselected',
        oddselclass:'oddselected',
        paginate:true,
        size:1,
        colddid:'columns',
        currentid:'currentpage',
        totalid:'totalpages',
        startingrecid:'startrecord',
        endingrecid:'endrecord',
        totalrecid:'totalrecords',
        hoverid:'selectedrow',
        pageddid:'pagedropdown',
        navid:'tablenav',
        sortcolumn:0,
        sortdir:0,
        columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
        init:true
    });
</script>