<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title"> Content List</span>
    </div>
    <div class="button_block">
        <a href="index.php?view=admin_content_add">
            <img src="images/add_24.png" alt="New Content" title="New Content" border="0" />
        </a>
        <br/>
        <b>New Content</b>
    </div>
</fieldset>
<?
include_once 'admin_msg_view.php';
?>
<fieldset class="content_fieldset">
    <br/>

    <div id="tablewrapper">
        <div id="tableheader">
            <div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
                <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                <div><a href="javascript:sorter.reset()">reset</a></div>
            </span>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th><h3>ID</h3></th>
                    <th><h3>Content Title</h3></th>
                    <th><h3>Author</h3></th>
                    <th><h3>Create Date</h3></th>
                    <th><h3>Last Modify By</h3></th>
                    <th><h3>Last Modify Date</h3></th>
                    <th width="100"><h3>Operations</h3></th>
                </tr>
            </thead>
            <tbody>
                <?
                require_once('../included/class_loader.php') ;
                $contentManager = new ContentManager();
                $contentList = $contentManager->getContentList();

                if (sizeof($contentList) > 0 ) {
                    foreach($contentList as $content) {
                        $author = new Administrator();
                        $lastModifyUser = new Administrator();
                        $author = $content->get_author();

                        $content_description = new ContentDescription();
                        $content_description = $content->get_first_content_description();
                        
                        $lastModifyUser = $content_description->get_last_modify_by();


                        echo "
                                    <tr>
                                    <td>".$content->get_content_id()."</td>
                                    <td>".$content_description->get_title()."</td>
                                    <td>".$author->get_admin_name()."</td>
                                    <td>".$content_description->get_create_date()."</td>
                                    <td>".$lastModifyUser->get_admin_name()."</td>
                                    <td>".$content_description->get_last_modify_date()."</td>
                                    <td width='90px'>
                                    <a href='process/admin_content_delete_process.php?content_id=".$content->get_content_id()."'
                                    onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this content')."</a>
                                    <a href='index.php?view=admin_content_update&content_id=".$content->get_content_id()."' 
                                    >".displayEditIcon(15,15,'Edit this content')."</a>
                                    </td>
                                    </tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <div id="tablefooter">
            <div id="tablenav">
                <div>
                    <img src="images/sorttable/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/sorttable/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/sorttable/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/sorttable/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                    <select id="pagedropdown"></select>
                </div>
                <div>
                    <a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
            <div id="tablelocation">
                <div>
                    <select onchange="sorter.size(this.value)">
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
    <script type="text/javascript" src="js/sortedTable.js"></script>
    <script type="text/javascript">
        var sorter = new TINY.table.sorter('sorter','table',{
            headclass:'head',
            ascclass:'asc',
            descclass:'desc',
            evenclass:'evenrow',
            oddclass:'oddrow',
            evenselclass:'evenselected',
            oddselclass:'oddselected',
            paginate:true,
            size:15,
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
</fieldset>
