<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

/*********************************************************************************

 * Description:  Defines the English language pack for the base application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once "config.php";

global $sugar_config, $dbhost, $db_user_name, $db_password, $db_name, $dbport;

$configOptions = $sugar_config['dbconfig'];

$link = mysqli_connect($configOptions['db_host_name'],$configOptions['db_user_name'],$configOptions['db_password']);

$db=mysqli_select_db($link,$configOptions['db_name']) or die("failed");

$array = array(
		        "product_id1"=>$_POST["product_id"],

		        "product_quantity1"=>$_POST["product_quantity"]

	          );

                $product_idc=$array["product_id1"];

                $product_quantity_quantity=$array["product_quantity1"];


// connect db and store it in DB

$sql = "SELECT * FROM vd_volume_discount_cstm t1 LEFT JOIN vd_volume_discount t2 ON t1.id_C=t2.id WHERE t1.start_date_c<=now() AND t1.expiry_date_c>=now() AND  t1.aos_products_id_c='".$_POST["product_id"]."' AND t1.minimum_qty_c<=$product_quantity_quantity AND t1.maximum_qty_c>=$product_quantity_quantity  AND t2.deleted='0' ";

             $query=mysqli_query($link,$sql) or die(mysqli_error());


if(! $query )
{
            die('Could not get data: ' . mysqli_error());
}
while($row = mysqli_fetch_array($query, MYSQL_ASSOC)) 
{
            $product_product_id=$row['aos_products_id_c'];

	        $minimum_qty_c= $row['minimum_qty_c'];

			$maximum_qty_c= $row['maximum_qty_c'];

			$valuediscount= $row['discount_amount_c'];

			$discount_type=$row['discount_type_c'];

			$expiry_date=$row['expiry_date_c'];

}

 


if($product_product_id==$product_idc && $product_quantity_quantity>=$minimum_qty_c && $product_quantity_quantity<=$maximum_qty_c && $minimum_qty_c>=$minimum_qty_c && $minimum_qty_c<=$maximum_qty_c)
{

	        $array = array("discount" =>$valuediscount,
	        	           "discount_type"=>$discount_type
	        	           );
}
else

{
	        $array = array("discount" =>"");
}

echo json_encode($array);

?>


