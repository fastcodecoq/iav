<?

require_once('../config.inc.php');


class update_db{

   private $db;
   private $col;

   public function  __construct(){

   	        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    	     $con = new MongoClient();
	 	     $db = $con->iav;
	 	     $this->col = $db->inmuebles;

   }


   public function get_inmuebles($params = Array()){

   			$what = isset($params["what"]) ? $params["what"] : "*";
   			$who =  isset($params["who"]) ? $params["who"] : "inmueble";
   			$where =  isset($params["where"]) ? $params["where"] : "";

   			$rs = $this->db->query("SELECT {$what} FROM {$who} {$where}");

   			return $rs;

   }


   public function RsToArray($rs){


   	   $rs_ = array();

   	   while ($row = mysqli_fetch_assoc($rs))
   	   	$rs_[] = $row;
   	   
   	   return $rs_;


   }


   public function num_pics($id){


   	   $rs = $this->db->query("SELECT id FROM `fotos_inm` WHERE cod_inm = {$id}");
   	   return $rs->num_rows;

   }

 
 public function fields_completed($data){
 	
 	$fields = 0;

 	 foreach($data as $field)
 	 	if(!empty($field) AND $field != NULL)
 	 		if(is_numeric($field) )
 	 		  if($field > 0)
 	 		    $fields++;
 	 		  else
 	 		  	$field++;

 	 	return $fields;

 }


 public function description_length($description){

 	  return strlen($description);

 }


 public function update(){
 	  
	  $rs = $this->get_inmuebles();
      $data = $this->RsToArray($rs); 

      foreach ($data as $inmueble) {      	
       
        $dl = $this->description_length($inmueble['comentarioUsuario']);
        $np = $this->num_pics($inmueble['codigo']);
        $fc = $this->fields_completed($inmueble);
        $id = $inmueble['id'];

        $query = "UPDATE `inmueble` SET description_length = {$dl}, num_pics = {$np}, fields_completed = {$fc} WHERE id={$id}";
        echo $query;



        $this->db->query($query) or die($this->db->error);

        	echo "ok ";

       } 

 }


}



$app = new update_db();
$app->update();

