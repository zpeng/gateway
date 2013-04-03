<?php


/* this function resize the photo size */

/*** HTML fucntion ***/
function resizeImage($Dir, $Image, $NewDir, $NewImage, $MaxWidth, $MaxHeight, $Quality)
{
    list($ImageWidth, $ImageHeight, $TypeCode) = getimagesize($Dir . $Image);
    $ImageType = ($TypeCode == 1 ? "gif" : ($TypeCode == 2 ? "jpeg" :
        ($TypeCode == 3 ? "png" : FALSE)));
    $CreateFunction = "imagecreatefrom" . $ImageType;
    $OutputFunction = "image" . $ImageType;
    if ($ImageType) {
        $Ratio = ($ImageHeight / $ImageWidth);
        $ImageSource = $CreateFunction($Dir . $Image);
        if ($ImageWidth > $MaxWidth || $ImageHeight > $MaxHeight) {
            if ($ImageWidth > $MaxWidth) {
                $ResizedWidth = $MaxWidth;
                $ResizedHeight = $ResizedWidth * $Ratio;
            } else {
                $ResizedWidth = $ImageWidth;
                $ResizedHeight = $ImageHeight;
            }
            if ($ResizedHeight > $MaxHeight) {
                $ResizedHeight = $MaxHeight;
                $ResizedWidth = $ResizedHeight / $Ratio;
            }
            $ResizedImage = imagecreatetruecolor($ResizedWidth, $ResizedHeight);
            imagecopyresampled($ResizedImage, $ImageSource, 0, 0, 0, 0, $ResizedWidth,
                $ResizedHeight, $ImageWidth, $ImageHeight);
        } else {
            $ResizedWidth = $ImageWidth;
            $ResizedHeight = $ImageHeight;
            $ResizedImage = $ImageSource;
        }
        $OutputFunction($ResizedImage, $NewDir . $NewImage, $Quality);
        return true;
    } else
        return false;
}

function uploadImage($tempFile, $tempFileName, $finalDir, $finalFilename)
{
    $result = false;

    $targetFile = $finalDir . basename($tempFileName);

    $originalFileName = basename($tempFileName);


    if (!(move_uploaded_file($tempFile, $targetFile))) {
        $result = false;
        echo "failure";
    } else {
        // rezie the photo
        resizeImage($finalDir, $originalFileName, $finalDir, $finalFilename, 350, 350, 100);

        // delete the old photo
        unlink($targetFile);

        $result = true;
    }
    return $result;
}


function deleteImageFromServer($targetFile)
{
    if (is_file($targetFile)) {
        unlink($targetFile);
        return true;
    } else {
        return false;
    }
}

function generateCustomerPassword()
{
    $str = md5(time());
    $new_password = substr($str, 0, 8);
    return $new_password;
}

function generateOrderCode($customerID)
{
    return time() . $customerID;
}

function setup_configuration_in_session()
{
    if (!isset ($_SESSION['configuration'])) {
        $s_configManager = new ConfigurationManager();
        unset ($_SESSION['$configManager']);
        $_SESSION['configuration'] = serialize($s_configManager);

    } else {
        $str = unserialize($_SESSION['configuration']);
        $s_configManager = ConfigurationManager::cast($str);

        unset ($_SESSION['configuration']);
        $_SESSION['configuration'] = serialize($s_configManager);
    }
}


?>