<?php
class Users {

    private $dbh;
    
    public function __construct() {
        //creamos una instancia del php document object y la conexion con la base de datos
        $this->dbh = new PDO("mysql:host=localhost;dbname=inmaventa", "inmaventa", "Inm@venta2013");
    }
   
    //FUNCION AUTOCOMPLETADO PARA LA WEB CON PDO
    public function autocompletar($buscar)
    {
        //si el primer carácter a buscar es * lo cogemos todo de la base de datos
        if($buscar{0}=="*"){
        $consulta = $this->dbh->prepare("select "
					."  nombreMunicipio , idmunicipio "
					." from "
					." municipio "
					." where "
					." nombreMunicipio like :buscar "
                                        ." and "
					." nombreMunicipio <> :buscar ");
	}else{
        //en otro caso hacemos la busqueda normal
	$consulta = $this->dbh->prepare("select "
					."  nombreMunicipio , idmunicipio "
					." from "
					." municipio "
					." where "
					." nombreMunicipio like :buscar "
					." and "
					." nombreMunicipio <> :buscar ");
			}
                        //de esta forma podemos pasar la consulta parametrizada correctamente
                        $consulta->execute(array(':buscar' => '%'.$buscar.'%'));
                        while($fila = $consulta->fetch())
			{
			$dato=$fila["nombreMunicipio"];
                        $id=$fila["idmunicipio"];
                        echo "<a class='resultado' href=\"javascript:selectItem
                        (".$id.",'".$dato."')\">".$dato."</a><br>";
                        }
                      ?>
                <!--este script necesitamos tenerlo aquí, de lo contrario
        al cambiar el autocmpletado dejaría de funcionar, perdería el hilo
        de la ejecución-->
        <script type="text/javascript">
            $(document).ready(function(){
                $(".resultado").click(function(){
                    $("#sugerencia").hide(); 
                }); 
            });
        </script>
<?php
        }
    //FIN AUTOCOMPLETADO
}
