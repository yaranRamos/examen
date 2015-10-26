$(document).ready(function(){
	var base_url = 'http://localhost/examen/';
	var table = $('table').DataTable();
	$('.datepicker').datepicker({
	    language: 'es',
	    format: 'yyyy-mm-dd'
	});
	$('#form-agregar').submit(function(e){
		e.preventDefault();
		var formulario = $(this);
		var formData = new FormData(formulario[0]);
		$('.error').html('');
		$.ajax({
			async : true,
			type: 'POST',
			url: base_url+formulario.attr('action'),
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
			beforeSend: function(){
				formulario.find('button[type="submit"]').prop('disabled', true);
			},
			error: function(){
				formulario.find('button[type="submit"]').prop('disabled', false);
			},
			success: function(result){
				formulario.find('button[type="submit"]').prop('disabled', false);
				if(result.resp){
					$('#form-agregar').trigger('reset');
					$('.error').html('');
					table.row.add([
						result.data.nombre,
						result.data.fecha,
						result.data.nombre_empresa,
						'<i id="'+result.data.id+'" class="glyphicon glyphicon-th-list"></i>'
					]).draw();
				}else{
					if(result.error == 1){
						$.each(result.errors_array,function(key,value){
							$('#'+key).closest('.form-group').find('.error').html(value);
						});
					}else{

					}
				}
			}
		});
	});
	$('tbody').on('click','.glyphicon.glyphicon-th-list',function(){
		$.ajax({
			async : true,
			type: 'POST',
			url: base_url+'index.php/welcome/getProyecto',
			data: {id:$(this).attr('id')},
			dataType: 'json',
			success: function(result){
				var color = '';
				if(result.estado == 'Activo'){
					color = 'green';
				}else if(result.estado == 'Suspendido'){
					color = 'orange';
				}else{
					color = 'blue';
				}
				var html = '<div class="col-xs-12 col-sm-6 col md-6">'+
					'<p><strong>Nombre: </strong>'+result.nombre+'</p>'+
					'<p><strong>Estado: </strong><span style="color:'+color+'">'+result.estado+'</span></p>'+
					'<p><strong>Descripcion: </strong>'+result.descripcion+'</p>'+
					'<p><strong>Fecha: </strong>'+result.fecha+'</p>'+
					'<p><strong>Lider: </strong>'+result.lider+'</p>'+
					'<p><strong>Contraseña: </strong>'+result.password+'</p>'+
					'<p><strong>Empresa: </strong>'+result.nombre_empresa+'</p>'+
				'</div>'+
				'<div class="col-xs-12 col-sm-6 col md-6">'+
					'<p><figure style="width:400px;"><img src="resources/proyecto/'+result.imagen+'" style="width:100%;"></figure></p>'+
				'</div>'+
				'<div class="clearfix"></div>';
				$('#modal-detalle .modal-body').html(html);
				$('#modal-detalle').modal('show');
			}
		});
	})
});