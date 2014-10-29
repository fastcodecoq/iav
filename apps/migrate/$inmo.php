<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/apps/config.inc.php");
require_once(dirname(__FILE__) . "/libs/db.controller.php");

         
		  $db = $this->db = new mysqlity;
          $id = $db->compile( $_GET["u"] . "{{d}}");
  	  	  $query = " WHERE identificacion = ? LIMIT 1";
  	  	  $rss = $db->find(null, "usuarios", $query)[0];

  	  	  var_dump($rss);