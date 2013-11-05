<form action="securimage_process.php" method="post">
    <img id="captcha" src="../external/php/securimage/securimage_show.php" alt="CAPTCHA Image"/>
    <input type="text" name="captcha_code" size="10" maxlength="6"/>
    <a href="#"
       onclick="document.getElementById('captcha').src = '../external/php/securimage/securimage_show.php?' + Math.random(); return false">[
        Different Image ]</a>
    <input type="image" name="Submit" class="searchsubmit">
</form>
