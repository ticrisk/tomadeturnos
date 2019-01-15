

		$("#pais").change(function(event){
			$.get("regiones/"+event.target.value+"",function(response,town){
				//console.log(response);
				
				$("#region").empty();
				$("#comuna_id").empty();
				$('#region').append('<option value="">Selecciona una Región</option>');
				$('#comuna_id').append('<option value="">Selecciona una Comuna</option>');
				for(i=0; i<response.length; i++)
				{
					$('#region').append('<option value="'+response[i].id+'">'+response[i].nombre+'</option>');
				}
				
			});
		});


		$("#region").change(function(event){
			$.get("comunas/"+event.target.value+"",function(response,town){
				//console.log(response);
				
				$("#comuna_id").empty();
				$('#comuna_id').append('<option value="">Selecciona una Comuna</option>');
				for(i=0; i<response.length; i++)
				{
					$('#comuna_id').append('<option value="'+response[i].id+'">'+response[i].nombre+'</option>');
				}
				
			});
		});


		$("#cadena").change(function(event){
			$.get("locales/"+event.target.value+"",function(response,town){
				//console.log(response);
				
				$("#local_id").empty();
				$('#local_id').append('<option value="">Selecciona un Local</option>');
				for(i=0; i<response.length; i++)
				{
					$('#local_id').append('<option value="'+response[i].id+'">'+response[i].nombre+'</option>');
				}
				
			});
		});
