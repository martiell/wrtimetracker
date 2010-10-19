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

/**
 * Class ClientHelper for manipulation with the Client data
 * @package TimeTracker
 */
class ClientHelper {

	/**
         * Finds all client data belonging to the user with specified $owner_id
         * @param int $owner_id
         * @return array
         */
	static function findAllClients($owner_id) {
		$result = array();
		$mdb2 = getConnection();

   		$sql = "SELECT * FROM clients WHERE clnt_id_um = $owner_id AND clnt_status = 1 ORDER BY clnt_name";
  		$res = &$mdb2->query($sql);
  		if (PEAR::isError($res) == 0) {
    		while ($val = $res->fetchRow()) {
      			$result[] = $val;
      		}
      		$result = mu_sort($result,"clnt_name");
  		}

  		return $result;
	}

        /**
         * Finds client data by it ID. Returns array of data.
         * @param User $user
         * @param int $id
         * @return array
         */
	static function findClientById($user, $id) {
    $mdb2 = getConnection();

	  $sql = "select * from clients
        where clnt_id_um = ".$user->getOwnerId()." and clnt_id = $id and clnt_status = 1";
  	  $res = &$mdb2->query($sql);
	  if (PEAR::isError($res) == 0) {
    		$val = $res->fetchRow();
		    if ($val['clnt_id'] != '') {
      			return $val;
    		} else {
      			return false;
    		}
	  }
	  return false;
    }


    /**
     * Inserts record about client into database. Returns ID of new record.
     * @param User $user
     * @param array $fields
     * @return int
     */
    static function insert($user, $fields)
    {
      $mdb2 = getConnection();

      $name = $fields['name'];
      $address = $fields['address'];
      $tax = $fields['tax'];
      $discount = $fields['discount'];
      $addr_you = $fields['addr_you'];
      $comment = $fields['comment'];
      $fsubtotals = $fields['fsubtotals'];

      $tax = str_replace(",",".",$tax);
      if ($tax=='') $tax = 0;

      $discount = str_replace(",",".",$discount);
      if ($discount=='') $discount = 0;
      
      if ($fsubtotals=='') $fsubtotals = 0;

      $sql = "insert into clients (clnt_id_um, clnt_name, clnt_addr_your, clnt_addr_cust,
        clnt_comment, clnt_tax, clnt_fsubtotals, clnt_discount) values (".$user->getOwnerId().
        ", ".mdb2_quote($mdb2, $name).", ".mdb2_quote($mdb2, $addr_you).", ".mdb2_quote($mdb2, $address).
        ", ".mdb2_quote($mdb2, $comment).", $tax, $fsubtotals, $discount)";
      
      $affected = $mdb2->exec($sql);
      return PEAR::isError($affected) == 0;
  	}

    /**
     * Updates client data in database
     * @param User $user
     * @param array $fields
     * @return int
     */
  	static function update($user, $fields)
    {
      $mdb2 = getConnection();

      $id = $fields['id'];
      $name = $fields['name'];
      $address = $fields['address'];
      $tax = $fields['tax'];
      $discount = $fields['discount'];
      $addr_you = $fields['addr_you'];
      $comment = $fields['comment'];
      $fsubtotals = $fields['fsubtotals'];

      $tax = str_replace(",",".",$tax);
  		if ($tax=='') $tax = 0;

      $discount = str_replace(",",".",$discount);
  	  if ($discount=='') $discount = 0;

  	  if ($fsubtotals=='') $fsubtotals = 0;
  	        
      $sql = "update clients set clnt_name = ".mdb2_quote($mdb2, $name).", clnt_addr_your = ".mdb2_quote($mdb2, $addr_you).
        ", clnt_addr_cust = ".mdb2_quote($mdb2, $address).", clnt_comment = ".mdb2_quote($mdb2, $comment).
        ", clnt_tax = $tax, clnt_fsubtotals = $fsubtotals, clnt_discount = $discount
        where clnt_id_um = ".$user->getOwnerId()." and clnt_id = ".$id;
      $affected = $mdb2->exec($sql);
      if (PEAR::isError($affected) == 0) {
		return $id;
  	  }
      return false;
	}

	/**
         * Deletes client data from database. Returns of boolean result of action.
         * @param User $user
         * @param int $id
         * @return boolean
         */
	static function delete($user, $id) {
		$mdb2 = getConnection();

		$sql = "update clients set clnt_status = 0 where clnt_id = $id and clnt_id_um = ".$user->getOwnerId();
		$affected = &$mdb2->exec($sql);
		return PEAR::isError($affected) == 0;
	}

        /**
         * Fills ActionForm object by client data
         * @param User $user
         * @param int $client_id
         * @param ActionForm $bean
         */
	static function fillBean($user, $client_id, &$bean) {
		$client_arr = ClientHelper::findClientById($user, $client_id);
		$bean->setAttribute("yourcoo",$client_arr["clnt_addr_your"]);
		$bean->setAttribute("custcoo",$client_arr["clnt_name"]."\n".$client_arr["clnt_addr_cust"]);
		$bean->setAttribute("comment",$client_arr["clnt_comment"]);
		$bean->setAttribute("tax",$client_arr["clnt_tax"]);
		$bean->setAttribute("daily_subtotals",$client_arr["clnt_fsubtotals"]);
		$bean->setAttribute("discount",$client_arr["clnt_discount"]);
	}

}
?>