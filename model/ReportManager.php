<?php
namespace blog\model;

use \blog\model\Manager;

class ReportManager extends Manager
{
	public function getIdReports($memberId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT comment_id FROM reports WHERE member_id = ?');
        $req->execute(array($memberId));
        $reports = $req->fetchAll(\PDO::FETCH_ASSOC);
       	$idComment = array();
       	foreach ($reports as $value) {
       		$idComment[] = $value['comment_id'];
       	}

        return $idComment;
    }

    public function postReports($commentId, $memberId) {
    	$db = $this->dbConnect();
    	$req = $db->prepare('INSERT INTO reports(comment_id, member_id, report_date) VALUES(?, ?, NOW())');
    	$reported = $req->execute(array($commentId, $memberId));

    	return $reported;
    }

    public function getReports() {
      $db = $this->dbConnect();
      $reports = $db->query('SELECT * FROM comments WHERE reported >1');

      return $reports;
    }

}