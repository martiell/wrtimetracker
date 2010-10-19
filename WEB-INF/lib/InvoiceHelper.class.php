<?php
/** WR Time Tracker
*
* Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
*
* LIBERAL FREEWARE LICENSE: This source code document may be used
* by anyone for any purpose, and freely redistributed alone or in
* combination with other software, provided that the license is obeyed.
*
* There are only two ways to violate the license:
*
* 1. To redistribute this code in source form, with the copyright
*    notice or license removed or altered. (Distributing in compiled
*    forms without embedded copyright notices is permitted).
*
* 2. To redistribute modified versions of this code in *any* form
*    that bears insufficient indications that the modifications are
*    not the work of the original author(s).
*
* This license applies to this document only, not any other software
* that it may be combined with.
*
* Contributors: Igor Melnik <igor.melnik at mail.ru>
*
*/

// $Id: InvoiceHelper.class.php,v 1.7 2008/12/29 01:50:53 nokuntseff Exp $

/**
 * Class InvoiceHelper for manipulation with the Invoice data
 * @package TimeTracker
 */
class InvoiceHelper {

    /**
     * Stores or updates Invoice data in database
     * @param User $user
     * @param string $fields
     * @return boolean
     */
	static function update($user, $fields)
    //$user, $number, $addr_your, $addr_cust, $comment, $tax, $fsubtotals, $discount)
  {
    $mdb2 = getConnection();

    $tax = str_replace(",",".",$fields['tax']);
    if ($tax=='') $tax = 0;

    $discount = $fields['discount'];
    $discount = str_replace(",",".",$discount);
    if ($discount=='') $discount = 0;

    if ($fsubtotals=='') $fsubtotals = 0;
    
    $sql = "replace into invoice_header
      set ih_user_id=".$user->getUserId().", ih_number=".$fields['number'].
      ", ih_addr_your=".mdb2_quote($mdb2, $fields['addr_your']).", ih_addr_cust=".mdb2_quote($mdb2, $fields['addr_cust']).
      ", ih_comment=".mdb2_quote($mdb2, $fields['comment']).", ih_tax = $tax, ih_fsubtotals = $fsubtotals, ih_discount = $discount";

    $affected = &$mdb2->exec($sql);
  	return PEAR::isError($affected) == 0;
  }

        /**
         * Finds data for invoice header
         * @param User $user
         * @return array
         */
	static function findByUser($user) {
		$mdb2 = getConnection();
    	$sql = "select * from invoice_header where ih_user_id = ".$user->getUserId();
    	$res = &$mdb2->query($sql);
    	if (PEAR::isError($res) == 0) {
	        if ($val = $res->fetchRow()) {
	        	return $val;
        	}
    	}
        return false;
	}

        /**
         * Stores Invoice data for ActionForm object
         * @param User $user
         * @param ActionForm $bean
         * @return boolean
         */
	static function saveInvoiceHeader($user, &$bean) {
		return InvoiceHelper::update($user, array(
			'number' => $bean->getAttribute("number"),
			'addr_your' => $bean->getAttribute("yourcoo"),
			'addr_cust' => $bean->getAttribute("custcoo"),
			'comment' => $bean->getAttribute("comment"),
			'tax' => $bean->getAttribute("tax"),
			'fsubtotals' => $bean->getAttribute("daily_subtotals"),
      'discount' => $bean->getAttribute("discount")
			));
	}

        /**
         * Loads Invoice data to ActionForm object.
         * @param User $user
         * @param ActionForm $bean
         * @return boolean
         */
	static function loadInvoiceHeader($user, &$bean) {
		$val = InvoiceHelper::findByUser($user);
        if ($val) {
        	$bean->setAttribute("number", $val["ih_number"]);
        	$bean->setAttribute("tax", $val["ih_tax"]);
        	$bean->setAttribute("yourcoo", $val["ih_addr_your"]);
        	$bean->setAttribute("custcoo", $val["ih_addr_cust"]);
        	$bean->setAttribute("comment", $val["ih_comment"]);
        	$bean->setAttribute("daily_subtotals", $val["ih_fsubtotals"]);
        	$bean->setAttribute("discount", $val["ih_discount"]);
        	return true;
    	}
        return false;
    }
}
?>