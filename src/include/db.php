<?php
/**
 * Configuration File. 
 * @author Vlachopoulos Dimitrios
 * @since v1.0.0.0
 */
try{
    $conn = new PDO(DNS, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    echo $e->getMessage();
}