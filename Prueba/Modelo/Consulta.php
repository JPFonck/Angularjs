<?php
$connect = mysqli_connect("localhost", "root", "", "prueba");
$data = json_decode(file_get_contents("php://input"));
$output = array();
if(!empty($data))
{
	$f_inicio = $data->f_inicio;
	$f_fin = $data->f_fin;
	$query = "SELECT SUM(Montos) AS Total, cliente.Cliente FROM contratos
	INNER JOIN cliente on cliente.id=contratos.ClientId
	WHERE Fecha BETWEEN '$f_inicio' AND '$f_fin'
	GROUP BY ClientId";
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$output[] = $row;
		}
		echo json_encode($output);
	}
	else
	{
		echo 'Error en la consulta';
	}
}
else
{
	echo "DATA VACIA";
}
?>