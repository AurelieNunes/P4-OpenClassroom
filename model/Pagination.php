<?php
namespace blog\model;

use \blog\model\Manager;
use PDO;

class Pagination extends Manager
{ 
	public function getTotalPosts() {
        $db = $this->dbConnect();
        $totalPosts = (int)$db->query('SELECT COUNT(id) FROM posts')->fetch(PDO::FETCH_NUM)[0];
        
        return $totalPosts;
    }

    public function getNbPages($totalPosts, $postsPerPage) {  
        
        //calcule le nbre de pages totales (ceil (au supérieur))
        $pages = ceil($totalPosts/$postsPerPage);

        return $pages;
    }
}