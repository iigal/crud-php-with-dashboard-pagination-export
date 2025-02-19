<html>
<head>
<!--
Project Name : CRUD with PHP, MySQL and Bootstrap
Author		 : Hendra Setiawan
Website		 : http://www.hendrasetiawan.net
Email	 	 : hendrabpp[at]gmail.com
-->
<?php 
include "module/header.php";
include "module/alerts.php";
include "config/connect.php"; 

session_start();





$sql = mysqli_query($mysqli,"SELECT id_usarios, dni, nombres, apellidos, fecha_tramite, categoria, estado from usuarios  ORDER BY id_usarios DESC");
?>
<script type="text/javascript">
window.apex_search = {};
apex_search.init = function (){
	this.rows = document.getElementById('data').getElementsByTagName('TR');
	this.rows_length = apex_search.rows.length;
	this.rows_text =  [];
	for (var i=0;i<apex_search.rows_length;i++){
        this.rows_text[i] = (apex_search.rows[i].innerText)?apex_search.rows[i].innerText.toUpperCase():apex_search.rows[i].textContent.toUpperCase();
	}
	this.time = false;
}
apex_search.lsearch = function(){
	this.term = document.getElementById('S').value.toUpperCase();
	for(var i=0,row;row = this.rows[i],row_text = this.rows_text[i];i++){
		row.style.display = ((row_text.indexOf(this.term) != -1) || this.term  === '')?'':'none';
	}
	this.time = false;
}
apex_search.search = function(e){
    var keycode;
    if(window.event){keycode = window.event.keyCode;}
    else if (e){keycode = e.which;}
    else {return false;}
    if(keycode == 13) { apex_search.lsearch(); } else { return false; }
}
</script>
<title>Usuarios</title>
</head>

<body onload="apex_search.init();">
<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Lista de Usuarios</h1>
        </div>
    </div>
</div>

<p>
<div class="row">
<div class="col-lg-4">
    <div class="input-group">
	<input type="text" size="30" class="form-control" maxlength="1000" value="" id="S" onkeyup="apex_search.search(event);" />
	<span class="input-group-btn">
	<input type="button" class="btn btn-default" value="Buscar" onclick="apex_search.lsearch();"/>
	</span>
	</div>
</div>

<div class="col-lg-4">
<a href="export.php" class="btn btn-success"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Exportar a Excel</a>
</div>
</div>

<br />

<div class="row">
	<div class="col-md-12">
	<p>
		<table class="table table-hover table-bordered" >
			<thead>
				<tr>
					<th width="5%"><center>NO</center></th>
					<th>DNI</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Fecha tramite</th>
					<th>Categoria</th>
					<th>Estado</th>
					<th width="15%"><center>ACTION</center></th>
				</tr>
			</thead>
			<tbody id="data">
			<?php $no=1; while ($row = mysqli_fetch_array($sql,MYSQLI_BOTH)) { ?>
				<tr>
					<td align="center"><?php echo $no; ?></td>
					<td><?php echo $row['dni']; ?></td>
					<td><?php echo $row['nombres']; ?></td>
					<td><?php echo $row['apellidos']; ?></td>
					<td><?php echo $row['fecha_tramite']; ?></td>
					<td><?php echo $row['categoria']; ?>
						
						<td ><?php 
							switch ($row['estado']) {
							    case 'Pendiente':
							        echo "<font color='red'>Pendiente</font>";
							        break;
							    case 'Entregado':
							        echo "<font color='blue'>Entregado</font>";
							        break;
							   
							} ?> </td>

					</td>
					<td align="center">
					<a href="edit.php?id=<?php echo $row['id_usarios']; ?>"><img src="img/update.png" width="30" height="30" ></a> 
					| 
					<a href="del.php?id=<?php echo $row['id_usarios']; ?>" onclick ="if (!confirm('DESEA ELIMINAR ESTE USUARIO')) return false;"><img src="img/drop.png" width="30" height="30" ></a>
					</td>
				</tr>
			<?php $no++; } ?>	
			</tbody>
		</table>
	</p>	
	</div>
</div>	

</div>
<?php include "module/footer.php"; ?>
</body>
</html>
