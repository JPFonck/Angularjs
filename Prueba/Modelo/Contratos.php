<?php
 $connect = mysqli_connect("localhost", "root", "", "prueba");
 $output = array();
 $query = "SELECT *, cliente.Cliente FROM contratos INNER JOIN cliente on cliente.id=contratos.ClientId";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
      while($row = mysqli_fetch_array($result))
      {
           $output[] = $row;
      }
      echo json_encode($output);
 }
?>