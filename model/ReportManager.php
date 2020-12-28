<?php
namespace blog\model;

use \blog\model\Manager;

class ReportManager extends Manager
{
	    public function postReports($commentId) {
    	$db = $this->dbConnect();
    	$req = $db->prepare('UPDATE comments SET reported =1 WHERE id=?');
      $reported = $req->execute(array($commentId));
      
    	return $reported;
    }

    public function getReports() {
      $db = $this->dbConnect();
      $reports = $db->query('SELECT * FROM comments WHERE reported >0');

      return $reports;
    }

}