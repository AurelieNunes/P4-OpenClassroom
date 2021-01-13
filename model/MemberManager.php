<?php

namespace blog\model;

use \blog\model\Manager;

class MemberManager extends Manager
{
    public function loginMember($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pass, isAdmin FROM members WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $member = $req->fetch();

        return $member;
    }

    public function checkPseudo($pseudo) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT pseudo FROM members WHERE pseudo = ?');
		$req->execute(array($pseudo));
		$usernameValidity = $req->fetch();

		return $usernameValidity;
	}

	public function checkMail($mail) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT email FROM members WHERE mail = ?');
		$req->execute(array($mail));
		$mailValidity = $req->fetch();

		return $mailValidity;
	}

    public function createMember($pseudo, $pass, $mail)
    {
        $db = $this->dbConnect();
        $newMember = $db->prepare('INSERT INTO members(pseudo, pass, email, subscribe_date, isAdmin) VALUES (?, ?, ?, CURDATE(),0)');
        $newMember->execute(array($pseudo, $pass, $mail));

        return $newMember;
    }

    public function getMembers() {
        $db = $this->dbConnect();
        $members = $db->query('SELECT id, pseudo, DATE_FORMAT(subscribe_date, "%d/%m/%Y") AS date_sub FROM members ORDER BY id');

        return $members;
    }

    public function deleteMember($memberId) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM members WHERE id = ?');
        $deletedMember = $req->execute(array($memberId));

        return $deletedMember;
    }

    public function getSecretKey() {
        $secretKey = '6LfJ9SoaAAAAANOjkJ85Iz6S9QX-C2Q16ptQWrWW';

        return $secretKey;
    }

    public function getReCaptcha($token) {
        $secretKey = $this->getSecretKey();
        $request = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $token . '');
        $response = json_decode($request);

        return $response;
    }
}