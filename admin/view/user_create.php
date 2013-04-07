<h1 class="content_title">Create a New User</h1>
<div id="content">
    <?
    $module_code = secureRequestParameter($_REQUEST["module_code"]);
    ?>
    <br/>

    <form id="UserCreationForm" action="<?= SERVER_URL ?>admin/control/user_create.php" method="post"
          onsubmit="return checkUserCreateForm(this)">
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>User Email: </b></td>
                <td><input name="email" id="email" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td align="right"><b>Password: </b></td>
                <td><input name="password" id="password" type="password" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="right"><b>Subscribe Modules: </b></td>
                <td>
                    <?
                    $moduleManager = new ModuleManager();
                    echo $moduleManager->outputModuleListAsHtmlCheckboxList();
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input name='Create' id="update_btn" type='submit' value='Create' title="Create"/></td>
            </tr>
        </table>
    </form>
    <script>
        $("#update_btn").button();
    </script>
</div>
