<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="UTF-8">
	<title>Examen - Inicio</title>
	<link rel="stylesheet" href="resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="resources/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="resources/css/bootstrap-datepicker.min.css">
	<style>
		.form-group{
			position: relative;
		}
		.error{
			margin-top: 0;
			font-size: 10px;
			color: red;
			position: absolute;
		}
		.error p{
			margin: 0;
			padding: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="well">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<form action="index.php/welcome/agrega_proyecto" class="panel panel-default" id="form-agregar">
						<div class="panel-heading">
							<h4 class="">Registro de proyectos</h4>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<label for="">Nombre del proyecto</label>
										<input type="text" class="form-control" name="nombre" id="nombre">
										<span class="help-block error"></span>
									</div>
									<div class="form-group">
										<label for="">Estado</label>
										<select name="estado" id="estado" class="form-control">
											<option value="">Seleccione una opcion</option>
											<option value="Activo">Activo</option>
											<option value="Suspendido">Suspendido</option>
											<option value="Terminado">Terminado</option>
										</select>
										<span class="help-block error"></span>
									</div>
									<div class="form-group">
										<label for="">Descripcion del proyecto</label>
										<textarea name="descripcion" id="descripcion" cols="30" rows="4" class="form-control"></textarea>
										<span class="help-block error"></span>
									</div>
									<div class="form-group">
										<label for="">Fecha de creacion</label>
										<input type="text" class="form-control datepicker" name="fecha" id="fecha">
										<span class="help-block error"></span>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<label for="">Lider del proyecto</label>
										<input type="text" class="form-control" name="lider" id="lider">
										<span class="help-block error"></span>
									</div>
									<div class="form-group">
										<label for="">Contraseña del proyecto</label>
										<input type="text" class="form-control" name="password" id="password">
										<span class="help-block error"></span>
									</div>
									<div class="form-group">
										<label for="">Empresa</label>
										<select name="empresa" id="empresa" class="form-control">
											<option value="">Seleccione una opcion</option>
											<?php foreach($empresas as $emp){ ?>
											<option value="<?php echo $emp->id; ?>"><?php echo $emp->nombre; ?></option>
											<?php } ?>
										</select>
										<span class="help-block error"></span>
									</div>
									<div class="form-group">
										<label for="">Imagen</label>
										<input type="file" class="filestyle" data-buttonText="Buscar Imagen" accept="image/x-png, image/gif, image/jpeg" name="imagen" id="imagen">
										<span class="help-block error"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<button type="submit" class="btn btn-primary pull-right">Guardar</button>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="">Listado de proyectos</h4>
						</div>
						<div class="panel-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Fecha de creacion</th>
										<th>Empresa del proyecto</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($proyectos as $pro){ ?>
									<tr>
										<td><?php echo $pro->nombre; ?></td>
										<td><?php echo $pro->fecha; ?></td>
										<td><?php echo $pro->nombre_empresa; ?></td>
										<td><i id="<?php echo $pro->id; ?>" class="glyphicon glyphicon-th-list"></i></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-detalle">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Detalle del proyecto</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<script src="resources/js/jquery.min.js"></script>
	<script src="resources/js/bootstrap.min.js"></script>
	<script src="resources/js/jquery.dataTables.min.js"></script>
	<script src="resources/js/dataTables.bootstrap.min.js"></script>
	<script src="resources/js/bootstrap-filestyle.min.js"></script>
	<script src="resources/js/bootstrap-datepicker.min.js"></script>
	<script src="resources/js/bootstrap-datepicker.es.min.js"></script>
	<script src="resources/js/app.js"></script>
</body>
</html>