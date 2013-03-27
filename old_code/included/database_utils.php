<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getConnection(){
    $hostname = "localhost";
    $user = "root";
    $pass = "19840617";
    $db = "rose_shoppingcart";

    $link = @mysql_connect($hostname, $user, $pass );
    if ( ! $link ) {
        die( "Couldn't connect to MySQL: ".mysql_error().$hostname. $user.$pass );
    }

    @mysql_select_db( $db,$link )
    or die ( "Couldn't open $db: ".mysql_error());

    // to support Chinese
    mysql_query("SET NAMES 'utf8'");
    
    return $link;
}

function closeConnection($link){
    mysql_close($link );
}

function executeNonUpdateQuery($link , $query , $location =""){
    $result = mysql_query($query, $link)  or die ( "<p>Database Execption: ".mysql_error(). " <p>Query: ".$query."</p><p> At: ".$location );
    return $result;
}

function executeUpdateQuery($link , $query , $location =""){
    mysql_query($query, $link)
    or die ( "<p>Database Execption: ".mysql_error(). " <p>Query: ".$query."</p><p> At: ".$location );
}

function secureRequestParameter($value){
    $value = trim($value);
    //$value = mysql_real_escape_string($value);
    return $value;
}



?>
