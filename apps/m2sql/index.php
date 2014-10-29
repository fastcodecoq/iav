<?php 

require_once("../libs/db.controller.php");


class m2sql{
	 
		protected $db;
		protected $col;

	 public function __construct(){
	     	
	 	     $this->db = new mysqlity;

	 	     $con = new MongoClient();
	 	     $db = $con->iav;
	 	     $this->col = $db->inmuebles;

	 }


	 public function merge(){

	 	$inmbls = iterator_to_array($this->col->find());
  	 	$coun = 0;

	 	foreach($inmbls as $inm){
  	 	
  	 	$codigo = $this->db->compile( $inm["codigo"] . "{{d}}");
        $query = " WHERE codigo = ? LIMIT 1";
  	 	

  	 	$must_saved = (count($this->db->find(null, "inmueble", $query)) > 0) ? false : true;

  	    	if($must_saved )
  	    		{	

  	    			$values = $vars = array();

  	    			foreach($inm as $key => $val)
  	    			{

  	    				$val = $val . "";

  	    				switch ($key) {
  	    					   
  	    			         case 'codigo':   	    			         
  	    			         case 'tipo_neg': 
  	    			         case 'ciudad': 
  	    			         case 'barrio': 
  	    			         case 'tipo_inm': 
  	    			         case 'plan': 
  	    			         case 'numvisitas': 
  	    			         case 'estado': 
  	    			         case 'destacado':
  	    						 $val = (empty($val)) ? 0 : (int) $val;
  	    					break;

  	    					default:
  	    					  $val = "'{$val}'";  
  	    					break;	    					
  	    					  	    					
  	    				}

  	    				if($key != "_id" AND $key != "id" AND $key != "image")
  	    				 {
  	    				$vars[] = "`" . $key . "`";
  	    				$values[] = $val;
  	    				 }

  	    			}


  	    			$vars = implode(",", $vars);
  	    			$values = implode(",", $values);

                    $query = "INSERT INTO `inmueble` ({{vars}}) VALUES ({{values}})";

                    $query = str_replace("{{vars}}", $vars, $query);
                    $query = str_replace("{{values}}", $values, $query);

                    echo addslashes($query);

                    $this->db->db->query($query) or die($this->db->db->error);

                    echo $this->db->db->affected_rows;

                  

  	    		}

  	 	}






	 }


}



try{
	$app = new m2sql;
	$app->merge();
}
catch(Exception $e){
	  json_encode(array("error" => $e->getMessage()));
}