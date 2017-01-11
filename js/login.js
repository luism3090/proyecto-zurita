$(document).ready(function()
{
     // cambio Luis 
	$('#MDomicilio').jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1000, width: 700, height: 210 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    
    $('#MDomicilioJefe').jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1000, width: 700, height: 210 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    // cambio Luis 
    $("#MdlRelClienteObra").jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1200, width: 1200, height: 260 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    
    $('#MdlMostrarClientes').jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1000, width: 1200, height: 500 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    
    $('#MdlMostrarTiposDeObra').jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1000, width: 1200, height: 500 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    
    $('#MdlRegimenObra').jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1000, width: 1200, height: 500 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    
    $('#MdlDetallesObra').jqxWindow({ theme: 'modal_theme', resizable: false, maxWidth: 1150, width: 1150, height:300 , autoOpen: false, isModal: true, modalOpacity: 0.3 });
    

    $("input").attr("maxlength","50");
    $("input[id*='telefono'], input[id*='rfc']").attr("maxlength","15");
    $("input[id*='numero']").attr("maxlength","15");
	
	$("#login").on("click",function()
	{
            
		$usuario = $("#usuario").val();
		$contra = $("#contra").val();
		
		
		 $.ajax(
            {
                url: "login.php",
                type: "POST",
                data: {usuario: $usuario, contra : $contra},
                success: function (data)
                {
                   data = data.trim();
                   
                   $("#bienvenido").show();
                        $("#principal").hide();
                        $(".nav-collapse>.navbar-form").hide();
                        $("#menuSuperior").show();
//                        
//                        
//                    if(data!="error")
//                    {
//                        $("#bienvenido").show();
//                        $("#principal").hide();
//                        $(".nav-collapse>.navbar-form").hide();
//                        $("#menuSuperior").show();
//                    }
//                    else
//                    {
//                        alert("Nombre de usuario o contraseña incorrectos ");
//                    }
                  
                    
                    
//                     if(data.indexOf("error§@") == -1)
//                        {
//                            
//                            
//                            
////                            $("#tipo-obra-tabla table #tipo-obra-filas").empty();
////                        
////                            $("#tipo-obra-tabla table #tipo-obra-filas").append(data);
//                        }
//                        else
//                        {
//                            alert("ocurrio un error al almacenar los datos");
//                            //alert(data); tipo de error
//                        }
                        
                    
                    
                }
            });

        
        $("body").on("click",".btnSeguimientoObra",function(){
            ocultar();
            $("#seguimientoObra").show();
            
            var id = $(this).attr("id").split("_")[1];
            $.ajax({
                type: "POST",
                data:{variable: "crearFormulario", idObra: id},
                url:"seguimiento_obra.php",
                success: function(data)
                {
                    
                    $("#seguimientoObra").empty();
                    $("#seguimientoObra").append(data);
                }
            });
        });

		$("body").on("click","#btnMdlAceptarClienteObra",function(){
            $('#MdlRelClienteObra').jqxWindow('close');
        });
		$("body").on("click",".btnObraCliente",function(){
           var id = $(this).attr("id").split("_")[1];
           var nombre = $(this).parent().siblings().eq(2).text();
           var paterno = $(this).parent().siblings().eq(3).text();
           var materno = $(this).parent().siblings().eq(4).text();
           $.ajax({
            type: "POST",
            data:{variable: "modalObraCliente", id_cliente: id},
            url:"clientes.php",
            success: function(data){
                if(data.trim()!="no")
                {
                    $('#MdlRelClienteObra').jqxWindow('open');
                   $("#MdlRelClienteObra .clientesObra-filas").empty(); 
                   $("#MdlRelClienteObra .clientesObra-filas").append(data);
                }
                else
                {
                    
                    alert("El cliente "+nombre+" "+paterno+" "+materno+" no tiene ninguna obra.");
                }
            }
        });

        });

	});

    function ocultar()
    {
        $("#bienvenido").hide();

        $("#form-cliente").hide();
        $("#clientes-tabla").hide();

        $("#materiales-tabla").hide();
        $("#form-materiales").hide();

        $("#unidad_medida-tabla").hide();
        $("#form-unidad_medida").hide();

        $("#jefe_obra-tabla").hide();
        $("#form-jefe_obra").hide();

        $("#tipo_obra-tabla").hide();
        $("#form-tipo_obra").hide();

        $("#crear_obra-tabla").hide();
        $("#form-crear_obra").hide();

        $("#tipo-obra-tabla").hide();
        $("#form-tipo-obra").hide();

        $("#seguimientoObra").hide();
        
         $(".h3ModificarObra").hide();
        $(".h3CrearObra").hide();

        $("#btn-modificar-crear_obra").hide();
        $("#btn-guardar-crear_obra").hide();

        $("#form-cliente").find("input").val("");
        $("#form-materiales").find("input").val("");
        $("#form-unidad_medida").find("input").val("");
        $("#form-jefe_obra").find("input").val("");
        $("#form-tipo_obra").find("input").val("");
        $("#form-crear_obra").find("input").val("");
        $("#form-crear_obra").find("textarea").val("");
        $("#form-tipo-obra").find("input").val("");

        $("#form-materiales select").find("option:first-child").prop("selected", true);
    }
    

    function crearTr(link, tbody, opt)
    {
        $.ajax({
            type: "POST",
            data:{option: opt},
            url:link,
            success: function(data){
                $("#"+tbody).empty();
                $("#"+tbody).append(data);
            }
        });
    }

    $("#opt-crear_obra").on("click",function(){
        $.ajax({
            type: "POST",
            data:{variable: "mostrarTiposObras"},
            url:"crear_obra.php",
            success: function(data){
                $("#obras-filas").empty();
                $("#obras-filas").append(data);
            }
        });
    })
    $("body").on("click",".btnSeguimientoCancelar",function(){
        $("#opt-crear_obra").trigger("click");
    });
    $("#btn-clientes").on("click",function(){
        ocultar(); 
        cargarClientes();
        $("#clientes-tabla").show();
    });
    $("#crear-cliente").on("click",function(){
        ocultar(); 
        $(".h1ModificarCliente").hide(); // Luis 2
        $(".h1CrearCliente").show(); // Luis 2
        $("#btn-guardar-clientes").show(); // cambio Luis
        $("#btn-modificar-clientes").hide(); // cambio Luis
        $("#form-cliente").show();   
        
        
        
    }); 
    $("#btn-cancel-clientes").on("click",function(){
        $("#btn-clientes").trigger("click");
    });

    $("#opt-materiales").on("click",function(){
        ocultar(); 
        crearTr("materiales.php", "materiales-filas", 3);
        $("#materiales-tabla").show();
    });
    $("#crear-material").on("click",function(){    
        ocultar(); 
        $("#form-materiales").show();
        $.ajax({
                type: "POST",
                data:{option: 1},
                url:"materiales.php",
                success: function(data){
                  $("#sl-material-unidad_medida").append(data);
                }
            });
    });
    $("#btn-cancel-materiales").on("click",function(){
        $("#opt-materiales").trigger("click");
    });

    $("#opt-unidad_medida").on("click",function(){
        ocultar(); 
        crearTr("unidades_medida.php", "unidad_medida-filas", 2);
        $("#unidad_medida-tabla").show();
    });
    $("#crear-unidad_medida").on("click",function(){    
        ocultar();
        $("#btn-guardar-unidad_medida").show();
        $("#btn-modificar-unidad_medida").hide();
        $("#form-unidad_medida").show();
    });
     $("#btn-cancel-unidad_medida").on("click",function(){
        $("#opt-unidad_medida").trigger("click");
    });

     $("#opt-jefe_obra").on("click",function(){
        ocultar(); 
        $("#jefe_obra-tabla").show();
        cargarJefesObra(); // Luis 2
    });
    $("#crear-jefe_obra").on("click",function(){    
        ocultar(); 
        $("#form-jefe_obra").show(); // LLuis 2
        $(".h3CrearJefeObra").show(); // Luis 2
        $(".h3ModificarJefeObra").hide(); // Luis 2
        $("#btn-guardar-jefe_obra").show(); // Luis 2
        $("#btn-modificar-jefe_obra").hide(); // Luis 2
    });
     $("#btn-cancel-jefe_obra").on("click",function(){
        $("#opt-jefe_obra").trigger("click");
    });

    $("#opt-tipo_obra").on("click",function(){
        ocultar(); 
        $("#tipo_obra-tabla").show();
    });
    $("#crear-tipo_obra").on("click",function(){    
        ocultar(); 
        $("#form-tipo_obra").show();
    });
     $("#btn-cancel-tipo_obra").on("click",function(){
        $("#opt-tipo_obra").trigger("click");
    });

    $("#opt-crear_obra").on("click",function(){
        ocultar(); 
        $("#crear_obra-tabla").show();
    });
    $("#crear-crear_obra").on("click",function(){    
        ocultar(); 
        $("#form-crear_obra").show();
         $(".h3CrearObra").show();
        $("#btn-guardar-crear_obra").show();
    });
     $("#btn-cancel-crear_obra").on("click",function(){
        $("#opt-crear_obra").trigger("click");
    });

     /*Cambio José*/

     $("#btn-guardar-unidad_medida").on("click",function(){
        var unidad_medida = $("#undad_medida-unidad_medida").val().trim();
        $.ajax({
            type: "POST",
            data:{unidad_medida: unidad_medida, option: 1},
            url:"unidades_medida.php",
            success: function(data){
                alert(data);
                $("#opt-unidad_medida").trigger("click");
            }
        });
     });

$("body").on("click","#crear-tipo-obra",function()  // Luis 2
    {
        ocultar();
        $("#form-tipo-obra").show();
        $("#h3CrearTipoObra").show();
        $("#h3ModificarTipoObra").hide();
        
        $("#btn-modificar-tipo-obra").hide();
        $("#btn-guardar-tipo-obra").show();
        
    });
    $("#btn-guardar-crear_obra").on("click",function()  // Luis 3
  {
      
      var valida="";
      
      valida = validaFormularioCrearObra();
      if(valida!="error")
      {
        valida = validarFechaInicioYFechaFin()
      }
      
      
      
      if(valida!="error")
      {
          valida = validarFechasDistanciaMinimaUnMes();
      }
    
    
    
    
    
    
  });
    $("#seleccionar-cliente").on("click",function()  // Luis 3
  {
     $('#MdlMostrarClientes').jqxWindow('open');
     mostrarClientesSeleccionarObra();
     
  });
  
 
  $("body").on("click",".rd-id-cliente",function() // Luis 3
  {
      var id= $(this).attr("data-id-cliente");
      var nombre= $(this).attr("data-nombre");
      
     $("#obra-cliente").val(nombre);
     $("#obra-cliente").attr("data-id-cliente",id);
     
  });
  
   $("#btnMdlAceptarSeleccionarCliente").on("click",function()  // Luis 3
  {
     
     var contador = false;
     
     $(".rd-id-cliente").each(function()
     {
      
         if( $(this).is(':checked') ) 
         {
            contador = true;
         }
       
     });
     
     if(contador==false)
     {
         alert("Debe seleccionar un cliente");
     }
     else
     {
         
         $('#MdlMostrarClientes').jqxWindow('close');
         
     }
     
     
  });
  
 
 $("#seleccionar-tipo-obra").on("click",function()  // Luis 3
  {
     $('#MdlMostrarTiposDeObra').jqxWindow('open');
     cargarModalTiposDeObra();
     
  });
  
  
     $("#btnMdlAceptarTipoDeObra").on("click",function()  // Luis 3
  {
     
     var contador = false;
     
     $(".rd-id-tipo-obra").each(function()
     {
      
         if( $(this).is(':checked') ) 
         {
            contador = true;
         }
       
     });
     
     if(contador==false)
     {
         alert("Debe seleccionar un tipo de obra");
     }
     else
     {
         
         $('#MdlMostrarTiposDeObra').jqxWindow('close');
         
     }
     
     
  });
  
  
  
   $("body").on("click",".rd-id-tipo-obra",function() // Luis 3
  {
      
      
      var id= $(this).attr("data-id-tipo-obra");
      var nombre= $(this).attr("data-nombre-obra");
      
     $("#sl-tipo-obra").val(nombre);
     $("#sl-tipo-obra").attr("data-id-tipo-obra",id);
     
  });
 
 
  $("#seleccionar-regimen").on("click",function() // Luis 3
  {
     
     cargarModalRegimenContratacionObra();
     $('#MdlRegimenObra').jqxWindow('open'); 
   
  });
 
 $("#btnMdlRegimenObra").on("click",function() // Luis 3
  {
     $('#MdlRegimenObra').jqxWindow('close');
   
  });
  
  $("#btnMdlAceptarRegimenObra").on("click",function()  // Luis 3
  {
     
     var contador = false;
     
     $(".rd-seguimiento-obra").each(function()
     {
      
         if( $(this).is(':checked') ) 
         {
            contador = true;
         }
       
     });
     
     if(contador==false)
     {
         alert("Debe seleccionar un tipo de regimen de contratación");
     }
     else
     {
         
         $('#MdlRegimenObra').jqxWindow('close');
         
     }
     
     
  });
  
     $("body").on("click",".rd-seguimiento-obra",function() // Luis 3
  {
      
      
      var id= $(this).attr("data-id-seguimiento-obra");
      var nombre= $(this).attr("data-nombre-seguimiento");
      
     $("#sl-regimen-contratacion").val(nombre);
     $("#sl-regimen-contratacion").attr("data-id-regimen",id);
     
  });
    $("body").on("click",".btnDomicilioCliente",function() // cambio Luis 
    {
        var id_cliente="";
        
        id_cliente = $(this).attr("id").split("_")[1];
        
            $.ajax(
            {
                url: "clientes.php",
                type: "POST",
                data: {variable: 'cargarDomicilio',id_cliente: id_cliente},
                success: function (data)
                {
                    data = data.trim();
                    
                    vector = data.split(";@");
                  
                    
                    $("#MDomicilio table .clientes-filas").empty();
                    
                    $("#MDomicilio table .clientes-filas").append(vector[0]);
                    
                    $("#MDomicilio .mdlDomicilioTitulo span").text(vector[1]);
                    
                }
            });
            
            
        
         $('#MDomicilio').jqxWindow('open');
         
           
    });
    
    
    
     $("body").on("click","#btnMdlAceptarDomicilio",function() // cambio Luis 
    {
       $('#MDomicilio').jqxWindow('close');
         
    });
    
    
 $("body").on("click","#btn-guardar-clientes",function() // cambio Luis 
    {
       
       var titulo_cliente = $("#cliente-titulo").val();
       var nombre_cliente = $("#cliente-nombre").val();
       var paterno_cliente = $("#cliente-apellidop").val();
       var materno_cliente = $("#cliente-apellidom").val();
       var razon_cliente = $("#cliente-razon_social").val();
       var rfc_cliente = $("#cliente-rfc").val();
       var estado_cliente = $("#cliente-estado").val();
       var municipio_cliente = $("#cliente-municipio").val();
       var colonia_cliente = $("#cliente-colonia").val();
       var calle_cliente = $("#cliente-calle").val();
       var numero_cliente = $("#cliente-numero").val();
       var telefono_cliente = $("#cliente-telefono").val();

       var patronRfc = /^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/;
       var patronTelefono = /^[0-9]{10,13}$/;
       
       valida = validarFormularioClientes();
       
     if(valida != "error")
     {

        if(patronRfc.test(rfc_cliente))
        {
          if(patronTelefono.test(telefono_cliente))
          {


            $.ajax(
                {
                    url: "clientes.php",
                    type: "POST",
                    data: {variable: 'insertarClientes', titulo_cliente: titulo_cliente, nombre_cliente:nombre_cliente,
                           paterno_cliente:paterno_cliente ,materno_cliente:materno_cliente ,razon_cliente:razon_cliente,
                           rfc_cliente: rfc_cliente,estado_cliente:estado_cliente,municipio_cliente:municipio_cliente,
                           colonia_cliente:colonia_cliente,calle_cliente:calle_cliente,numero_cliente:numero_cliente,
                           telefono_cliente:telefono_cliente
                       },
                    success: function (data)
                    {
                        alert(data);
                        $("#btn-clientes").trigger("click");
                    }
                }); 
          }
          else
          {
             alert("El telefono debe contener entre 10 y 13 digitos");
            $("#cliente-telefono").focus();
          }
        }
        else
        {
          alert("Datos incorrectos. El Formato del RFC debe ser primero de 4 letras seguido de 6 digitos y puede o no llevar despues 3 o 4 letras ");
          $("#cliente-rfc").focus();
        }
      }        
       
        
    }); 
         
        
    
    $("body").on("click","#btn-guardar-jefe_obra",function()  // Luis 2
    {
       
       valida = validaFormularioJefeObra();
       
       if(valida!="error")
       {
            var titulo = $("#jefe-titulo").val();
            var nombre = $("#jefe-nombre").val();
            var paterno = $("#jefe-apellidop").val();
            var materno = $("#jefe-apellidom").val();
            var estado = $("#jefe-estado").val();
            var municipio = $("#jefe-municipio").val();
            var colonia = $("#jefe-colonia").val();
            var calle = $("#jefe-calle").val();
            var telefono = $("#jefe-telefono").val();
            
           
       
           $.ajax(
                {
                    url: "jefe_obra.php",
                    type: "POST",
                     data: { titulo: titulo, nombre:nombre,
                           paterno:paterno ,materno:materno ,
                           estado:estado,municipio:municipio,
                           colonia:colonia,calle:calle,telefono:telefono,variable:"InsertarJefes"
                       },
                    success: function (data)
                    {
                        
                        alert(data);
                        $("#opt-jefe_obra").trigger("click");
                        
                    }
                });
       }
       
        
    });
    
    
    
 $("body").on("click",".btnDomicilioJefe",function()  // Luis 2
{
    var id="";
    
    
    
    id = $(this).attr("id").split("_")[1];
    
        $.ajax(
        {
            url: "jefe_obra.php",
            type: "POST",
            data: {variable: 'cargarDomicilio',id: id},
            success: function (data)
            {
                data = data.trim();
                
                vector = data.split(";@");
              
                
                $("#MDomicilioJefe table .clientes-filas").empty();
                
                $("#MDomicilioJefe table .clientes-filas").append(vector[0]);
                
                $("#MDomicilioJefe .mdlDomicilioTituloJefe span").text(vector[1]);
                
            }
        });
        
        
    
     $('#MDomicilioJefe').jqxWindow('open');
     
       
});

$("body").on("click","#btnMdlAceptarDomicilioJefe",function()  // Luis 2
{
    $('#MDomicilioJefe').jqxWindow('close');
});


 $("body").on("click",".modificar-jefe",function()  // Luis 2
{
     ocultar(); 
    id= $(this).attr("id").split("_")[1];
    
    $("#btn-guardar-jefe_obra").hide();
    $("#btn-modificar-jefe_obra").show();
    $("#btn-modificar-jefe_obra").attr("data-idJefe",id);
    $("#form-jefe_obra").show();  
    $(".h3ModificarJefeObra").show(); // Luis 2
    $(".h3CrearJefeObra").hide(); // Luis 2
    
    
    var id_jefe= $(this).attr("id").split("_")[1];
    
    
     $.ajax(
        {
            url: "jefe_obra.php",
            type: "POST",
            data: {variable: 'cargarDatosJefeObra',id_jefe: id_jefe},
            success: function (data)
            {
                data = data.trim();
                
                var vector=[];
               
                vector = data.split("@;");
              
                $("#jefe-titulo").val(vector[0]);
                $("#jefe-nombre").val(vector[1]);
                $("#jefe-apellidop").val(vector[2]);
                $("#jefe-apellidom").val(vector[3]);
                $("#jefe-estado").val(vector[4]);
                $("#jefe-municipio").val(vector[5]);
                $("#jefe-colonia").val(vector[6]);
                $("#jefe-calle").val(vector[7]);
                $("#jefe-telefono").val(vector[8]);
       
                
            }
        });
    
    
});
$("body").on("click","#btn-modificar-jefe_obra",function() 
    {
        
        var titulo = $("#jefe-titulo").val();
       var nombre = $("#jefe-nombre").val();
       var paterno = $("#jefe-apellidop").val();
       var materno = $("#jefe-apellidom").val();
       
       var estado = $("#jefe-estado").val();
       var municipio = $("#jefe-municipio").val();
       var colonia = $("#jefe-colonia").val();
       var calle = $("#jefe-calle").val();
       
       var telefono = $("#jefe-telefono").val();
       
       var id = $(this).attr("data-idjefe");
        
        var valida = validaFormularioJefeObra();
        
        
       
       if(valida != "error")
       {
       
            $.ajax(
                {
                    url: "jefe_obra.php",
                    type: "POST",
                    data: {variable: 'ModificarJefe', titulo: titulo, nombre:nombre,
                           paterno:paterno ,materno:materno ,estado:estado,municipio:municipio,
                           colonia:colonia,calle:calle,
                           telefono:telefono,id:id
                       },
                    success: function (data)
                    {
                        alert(data);
                       $("#opt-jefe_obra").trigger("click");
                    }
                });
            
        }  
        
        
    });
$("#opt-tipo_obra").on("click",function()
    {
        ocultar();
        cargarTiposDeObra()
        $("#tipo-obra-tabla").show();
    });
     $("body").on("click","#crear-tipo-obra",function()  // Luis 2
    {
        ocultar();
        $("#form-tipo-obra").show();
        $("#h3CrearTipoObra").show();
        $("#h3ModificarTipoObra").hide();
        
        $("#btn-modificar-tipo-obra").hide();
        $("#btn-guardar-tipo-obra").show();
        
    });
     $("#btn-cancel-tipo-obra").on("click",function(){ // Luis 2
        $("#opt-tipo_obra").trigger("click");
    });
     $("#btn-guardar-tipo-obra").on("click",function(){ // Luis 2
         
         valida = validaFormularioTipoDeObra()
         
         if(valida !="error")
         {
             insertarTipoObra();
         }
         
        
    });
     $("body").on("click",".eliminar-tipo-obra",function(){
         var idTipoObra = $(this).attr("id").split("_")[1];
//         var nombre = $(this).parent().parent().find("td").eq(1).text();
         var eliminar = confirm("¿Desea eliminar el tipo de obra: "+nombre+"?");
        if (eliminar) 
        {
          $.ajax({
                 type: "POST",
                 data:{variable: "eliminarTipoObra", id_unidad: idTipoObra},
                 url:"tipo_obra.php",
                 success: function(data){
                   alert(data);
                   $("#btn-cancel-tipo-obra").trigger("click");
                 }
             });    
        }
     });
     $("body").on("click",".modificar-tipo-obra",function()  // Luis 2
    {
        ocultar();
        $("#form-tipo-obra").show();
        $("#btn-modificar-tipo-obra").show();
        $("#btn-guardar-tipo-obra").hide();
      
        $("#h3CrearTipoObra").hide();
        $("#h3ModificarTipoObra").show();
        
        id = $(this).attr("id").split("_")[1];
        
        $("#btn-modificar-tipo-obra").attr("data-id-obra",id);
        
        var nombre = $(this).parent().parent().find("td").eq(1).text()
        
        $("#tipo-obra").val(nombre);
        
        
    });
     $("body").on("click","#btn-modificar-tipo-obra",function()  // Luis 2
    {
        valida = validaFormularioTipoDeObra()
        id = $(this).attr("data-id-obra");
         
         if(valida !="error")
         {
             modificarTipoObra(id);
         }
         
    });
     function cargarJefesObra() // Luis 2
{
       $.ajax(
            {
                url: "jefe_obra.php",
                type: "POST",
                data: {variable: 'cargarJefes'},
                success: function (data)
                {
                    data = data.trim();
                    
                    
                    
                    if(data!="error")
                    {
                        $("#jefe_obra-tabla table #clientes-filas").empty();
                        
                        $("#jefe_obra-tabla table #clientes-filas").append(data);
                    }
                    else
                    {
                        
                    }
                    
                    
                    
                    
                }
            });
}function cargarTiposDeObra() // Luis 2
{
    $.ajax(
                {
                    url: "tipo_obra.php",
                    type: "POST",
                    data: {variable: 'cargarTipoObras'
                       },
                    success: function (data)
                    {    
                        data = data.trim();
                        
                        
                  
                        if(data.indexOf("error§@") == -1)
                        {
                            $("#tipo-obra-tabla table #tipo-obra-filas").empty();
                        
                            $("#tipo-obra-tabla table #tipo-obra-filas").append(data);
                        }
                        else
                        {
                            alert("ocurrio un error al almacenar los datos");
                            //alert(data); tipo de error
                        }
                         
                    }
                });
}
function validaFormularioJefeObra()
{
     var valida = "";
     
      if($("#jefe-titulo").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el titulo del jefe de obra");
           $("#jefe-titulo").focus();
           return valida;
       }
       if($("#jefe-nombre").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el nombre del jefe obra");
           $("#jefe-nombre").focus();
           return valida;
       }
       if($("#jefe-apellidop").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el apellido paterno del jefe de obra");
           $("#jefe-apellidop").focus();
           return valida;
       }
       if($("#jefe-apellidom").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el apellido materno del jefe de obra");
           $("#jefe-apellidom").focus();
           return valida;
       }
     
     if($("#jefe-estado").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el estado del jefe de obra");
           $("#jefe-estado").focus();
           return valida;
       }
       
        if($("#jefe-municipio").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el municipio del jefe de obra");
           $("#jefe-municipio").focus();
           return valida;
       }
        if($("#jefe-colonia").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar la colonia del jefe de obra");
           $("#jefe-colonia").focus();
           return valida;
       }
        if($("#jefe-calle").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar la calle del jefe de obra");
           $("#jefe-calle").focus();
           return valida;
       }
         if($("#jefe-telefono").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el telefono del jefe de obra");
           $("#jefe-telefono").focus();
           return valida;
       }
     
}
function validaFormularioTipoDeObra()
{
    var valida = "";
     
      if($("#tipo-obra").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el tipo de obra");
           $("#tipo-obra").focus();
           return valida;
       }
}
function insertarTipoObra()  // Luis 2
{
    var nombre = $("#tipo-obra").val();
    
     $.ajax(
                {
                    url: "tipo_obra.php",
                    type: "POST",
                    data: {variable: 'insertarTipoObra', nombre:nombre 
                       },
                    success: function (data)
                    {
                        if(data.indexOf("error§@") == -1)
                        {
                            alert(data);
                            $("#opt-tipo_obra").trigger("click");
                        }
                        else
                        {
                            alert("ocurrio un error al almacenar los datos");
                            //alert(data); tipo de error
                        }
                        
                       
                    }
                });
}
function modificarTipoObra(id)  // Luis 2
{
    var nombre = $("#tipo-obra").val();
    
    
     $.ajax(
                {
                    url: "tipo_obra.php",
                    type: "POST",
                    data: {variable: 'modificarTipoObra', nombre:nombre ,id:id
                       },
                    success: function (data)
                    {
                      
                       
                       if(data.indexOf("error§@") == -1)
                        {
                            alert(data);
                            $("#opt-tipo_obra").trigger("click");
                        }
                        else
                        {
                            //alert("ocurrio un error al almacenar los datos");
                            alert(data);// tipo de error
                        }
                        
                    }
                });
}
     $("body").on("click",".modificar-cliente",function() // cambio Luis 
    {
        ocultar(); 
        id= $(this).attr("id").split("_")[1];
        $("#btn-guardar-clientes").hide();
        $("#btn-modificar-clientes").show();
        $("#btn-modificar-clientes").attr("data-idcliente",id);
        $("#form-cliente").show();  
        $(".h1ModificarCliente").show(); // Luis 2
        $(".h1CrearCliente").hide(); // Luis 2
        
        
        var id_cliente= $(this).attr("id").split("_")[1];
        
        
        
        $.ajax(
            {
                url: "clientes.php",
                type: "POST",
                data: {variable: 'cargarDomicilioModificar',id_cliente: id_cliente},
                success: function (data)
                {
                    data = data.trim();
                    
                    var vector=[];
                   
                    vector = data.split("@;");
                  
                    $("#cliente-titulo").val(vector[0]);
                    $("#cliente-nombre").val(vector[1]);
                    $("#cliente-apellidop").val(vector[2]);
                    $("#cliente-apellidom").val(vector[3]);
                    $("#cliente-razon_social").val(vector[4]);
                    $("#cliente-rfc").val(vector[5]);
                    $("#cliente-estado").val(vector[6]);
                    $("#cliente-municipio").val(vector[7]);
                    $("#cliente-colonia").val(vector[8]);
                    $("#cliente-calle").val(vector[9]);
                    $("#cliente-numero").val(vector[10]);
                    $("#cliente-telefono").val(vector[11]);
           
                    
                }
            });
            
                   
       
        
    });
    
    
    $("body").on("click","#btn-modificar-clientes",function() // cambio Luis 
    {
        
        var titulo_cliente = $("#cliente-titulo").val();
       var nombre_cliente = $("#cliente-nombre").val();
       var paterno_cliente = $("#cliente-apellidop").val();
       var materno_cliente = $("#cliente-apellidom").val();
       var razon_cliente = $("#cliente-razon_social").val();
       var rfc_cliente = $("#cliente-rfc").val();
       var estado_cliente = $("#cliente-estado").val();
       var municipio_cliente = $("#cliente-municipio").val();
       var colonia_cliente = $("#cliente-colonia").val();
       var calle_cliente = $("#cliente-calle").val();
       var numero_cliente = $("#cliente-numero").val();
       var telefono_cliente = $("#cliente-telefono").val();
       
       var id_cliente=$(this).attr("data-idCliente");


        //var patronRfc = /^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/;
        var patronRfc = /^[a-zA-Z]{4}(\d{6})((\D|\d){3})?$/;
        var patronTelefono = /^[0-9]{10,13}$/;
        
        var valida = validarFormularioClientes();
        
        
       
       if(valida != "error")
       {
        if(patronRfc.test(rfc_cliente))
        {
          if(patronTelefono.test(telefono_cliente))
          {
       
            $.ajax(
                {
                    url: "clientes.php",
                    type: "POST",
                    data: {variable: 'ModificarClientes', titulo_cliente: titulo_cliente, nombre_cliente:nombre_cliente,
                           paterno_cliente:paterno_cliente ,materno_cliente:materno_cliente ,razon_cliente:razon_cliente,
                           rfc_cliente: rfc_cliente,estado_cliente:estado_cliente,municipio_cliente:municipio_cliente,
                           colonia_cliente:colonia_cliente,calle_cliente:calle_cliente,numero_cliente:numero_cliente,
                           telefono_cliente:telefono_cliente,id_cliente:id_cliente
                       },
                    success: function (data)
                    {
                        alert(data);
                        $("#btn-clientes").trigger("click");
                    }
                });
            }
          else
          {
            alert("El telefono debe contener entre 10 y 13 digitos");
            $("#cliente-telefono").focus();
          }
        }
        else
        {
          alert("Datos incorrectos. El Formato del RFC debe ser primero de 4 letras seguido de 6 digitos y puede o no llevar despues 3 o 4 letras ");
          $("#cliente-rfc").focus();
        }
            
        }  
        
        
    });
    
    
//    
//    $("body").on("click","#btn-modificar-clientes",function() // cambio Luis 
//    {
//        
//        var titulo_cliente = $("#cliente-titulo").val();
//       var nombre_cliente = $("#cliente-nombre").val();
//       var paterno_cliente = $("#cliente-apellidop").val();
//       var materno_cliente = $("#cliente-apellidom").val();
//       var razon_cliente = $("#cliente-razon_social").val();
//       var rfc_cliente = $("#cliente-rfc").val();
//       var estado_cliente = $("#cliente-estado").val();
//       var municipio_cliente = $("#cliente-municipio").val();
//       var colonia_cliente = $("#cliente-colonia").val();
//       var calle_cliente = $("#cliente-calle").val();
//       var numero_cliente = $("#cliente-numero").val();
//       var telefono_cliente = $("#cliente-telefono").val();
//       
//       var id_cliente=$(this).attr("data-idCliente");
//        
//        var valida = validarFormularioClientes();
//        
//        
//       
//       if(valida != "error")
//       {
//       
//            $.ajax(
//                {
//                    url: "clientes.php",
//                    type: "POST",
//                    data: {variable: 'ModificarClientes', titulo_cliente: titulo_cliente, nombre_cliente:nombre_cliente,
//                           paterno_cliente:paterno_cliente ,materno_cliente:materno_cliente ,razon_cliente:razon_cliente,
//                           rfc_cliente: rfc_cliente,estado_cliente:estado_cliente,municipio_cliente:municipio_cliente,
//                           colonia_cliente:colonia_cliente,calle_cliente:calle_cliente,numero_cliente:numero_cliente,
//                           telefono_cliente:telefono_cliente,id_cliente:id_cliente
//                       },
//                    success: function (data)
//                    {
//                        alert(data);
//                        $("#btn-clientes").trigger("click");
//                    }
//                });
//            
//        }  
//        
//        
//    });
    
    
    
    
    $("body").on("click",".eliminar-cliente",function() // cambio Luis 
    {
        var id_cliente=$(this).attr("id").split("_")[1];
        
        $("#eliminar-cliente_1").parent().parent().find("td").eq(2).text()
        
        var nombre = $(this).parent().parent().find("td").eq(2).text();
        var paterno = $(this).parent().parent().find("td").eq(3).text()
        var materno = $(this).parent().parent().find("td").eq(4).text();
        
        var eliminar = confirm("¿Desea eliminar el cliente: "+nombre+" "+paterno+" "+materno+"?");
        
        if (eliminar) 
        {
             $.ajax(
                {
                    url: "clientes.php",
                    type: "POST",
                    data: {variable: 'eliminarClientes' , id_cliente:id_cliente },
                    success: function (data)
                    {
                        alert(data);
                        $("#btn-clientes").trigger("click");
                        
                    }
                });
        } 
       

        
        
        
       
        
        
    });
    
        
  $("body").on("click",".modificar-unidad_medida",function(){
    $("#crear-unidad_medida").trigger("click");
    var idUnidad = $(this).attr("id").split("_")[2];
     $.ajax({
            type: "POST",
            data:{option: 3, id_unidad: idUnidad},
            url:"unidades_medida.php",
            success: function(data){
                
              $("#btn-modificar-unidad_medida").attr("data-id",idUnidad);
              $("#btn-guardar-unidad_medida").hide();
              $("#btn-modificar-unidad_medida").show();
              $("#undad_medida-unidad_medida").val(data);
            }
        });

  });

  $("body").on("click",".eliminar-unidad_medida",function(){
    var idUnidad = $(this).attr("id").split("_")[2];
    var nombre = $(this).parent().parent().find("td").eq(1).text();
    var eliminar = confirm("¿Desea eliminar la unidad de medida: "+nombre+"?");      
   if (eliminar) 
   {
     $.ajax({
            type: "POST",
            data:{option: 4, id_unidad: idUnidad},
            url:"unidades_medida.php",
            success: function(data){
              alert(data);
              $("#btn-cancel-unidad_medida").trigger("click");
            }
        });    
   }

  });
  $("#btn-modificar-unidad_medida").on("click",function(){
    var idUnidad = $(this).attr("data-id");
    var nombre = $("#undad_medida-unidad_medida").val();
    $.ajax({
            type: "POST",
            data:{option: 5, id_unidad: idUnidad, nombre: nombre},
            url:"unidades_medida.php",
            success: function(data){
              alert(data);
              $("#btn-cancel-unidad_medida").trigger("click");
            }
        });
  });

  $("#btn-guardar-materiales").on("click",function(){
    var idUnidad = $("#sl-material-unidad_medida>option:selected").attr("values");
    var nombre = $("#material-material").val();
    var precio = $("#material-precio").val();
    $.ajax({
            type: "POST",
            data:{option: 2, id_unidad: idUnidad, nombre: nombre, precio: precio},
            url:"materiales.php",
            success: function(data){
              alert(data);
              
            }
      });
  });
  
  
  $("body").on("click",".btnSeguimientoAceptar",function(){ // Luis 4
    
    var id = $(this).attr("id").split("_")[1];
    
    var valida = validarInsertSeguimientoObra(id);
    
    if(valida !="error")
    {
    
    var id_obra = $(this).attr("data-id_obra");
    var descripcion = $("#descripcionSeguimiento_"+id).val();
    var costo = $("#costoSeguimiento_"+id).val();
    
    var mes_anio = $(".mes-anio_"+id).text();
    
    var id_seguimiento = $(this).attr("data-id-seguimiento");
    
    var imagen="";
    
    var dato="0";
    
    
    
    
    //var imagen = $("#imagenSeguimiento_"+id).val().substring(12);
    
    if($(".imagen_"+id).length==0) // si la imagen NO existe
    {
         imagen = $("#imagenSeguimiento_"+id).val().substring(12);
          dato="1";
        
    }
   else // si la imagen SI existe 
   {
       
       if($("#imagenSeguimiento_"+id).val()=="") // si el boton file esta SIN imagen seleccinada
       {
            imagen = "";
       }
       else // si el boton file esta CON imagen seleccionada
       {
            imagen = $("#imagenSeguimiento_"+id).val().substring(12);
             dato="1";
       }
   }
    
    
    
    
    
    $.ajax({
            url:"seguimiento_obra.php",
            type: "POST",
            
            data:{variable: "insertSeguimientoObra", id_obra: id_obra,descripcion:descripcion ,imagen: imagen,costo:costo,mes_anio:mes_anio,id_seguimiento:id_seguimiento},
           
            success: function(data)
            {
                alert(data)
                
                if(dato == "1"){
    
    var archivos = document.getElementById("imagenSeguimiento_"+id);//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
    var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
		//Creamos una instancia del Objeto FormDara.
    var archivos = new FormData();
		/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
		Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
		indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
    for(i=0; i<archivo.length; i++)
    {
        archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
    }
   
     $.ajax({
            url:"subir.php?id="+id_seguimiento+"",
            type: "POST",
            contentType:false, //Debe estar en false para que pase el objeto sin procesar
            data:archivos,
            processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
            cache:false, //Para que el formulario no guarde cache
            success: function(msg)
            {
                
                MensajeFinal(msg)
                $("#btnSeguimientoObra_"+id_obra).trigger("click");
            }
        });


        function MensajeFinal(msg){
            $('.mensage_'+id).html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
            $('.mensage_'+id).show('slow');//Mostramos el div.
       }
        
        
      }
                
                
            }
        });
        
    
//    if(dato == "1"){
//    
//    var archivos = document.getElementById("imagenSeguimiento_"+id);//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
//    var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
//		//Creamos una instancia del Objeto FormDara.
//    var archivos = new FormData();
//		/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
//		Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
//		indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
//    for(i=0; i<archivo.length; i++)
//    {
//        archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
//    }
//   
//     $.ajax({
//            url:"subir.php?id="+id_seguimiento+"",
//            type: "POST",
//            contentType:false, //Debe estar en false para que pase el objeto sin procesar
//            data:archivos,
//            processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
//            cache:false, //Para que el formulario no guarde cache
//            success: function(msg)
//            {
//                
//                MensajeFinal(msg)
//                $("#btnSeguimientoObra_"+id_obra).trigger("click");
//            }
//        });
//
//
//        function MensajeFinal(msg){
//            $('.mensage_'+id).html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
//            $('.mensage_'+id).show('slow');//Mostramos el div.
//       }
//        
//        
//      }
       
       
    }
  
  });
  
  
  $("body").on("click",".modificar-obra",function()   // Luis 4
  {
       ocultar(); 
        
      
      
      var id_obra = $(this).attr("id").split("_")[1];
      
      cargarObrasModificar(id_obra)
      
      $("#form-crear_obra").show();
        $(".h3ModificarObra").show();
        $("#btn-modificar-crear_obra").show();
        $(this).attr("data-id-obra",id_obra);
     
      
    
  });
  
  $("body").on("click","#btn-modificar-crear_obra",function()   // Luis 4
  {
       
       var valida="";
      
      valida = validaFormularioCrearObra();
      if(valida!="error")
      {
        valida = validarFechaInicioYFechaFin()
      }
      
      
      
      if(valida!="error")
      {
          var id_obra = $(this).attr("data-id-obra");
          
          valida = validarFechasDistanciaMinimaUnMesUpdate(id_obra);
      }
      
      
//                
//      
//                var nombre = $("#crear_obra-nombre").val();
//                var estado = $("#crear_obra-estado").val();
//                var municipio = $("#crear_obra-municipio").val();
//                var ciudad = $("#crear_obra-ciudad").val();
//                var fechaInicio = $("#fec-inicio-obra").val();
//                var fechaFin = $("#fec-fin-obra").val();
//                var id_tipoObra = $("#sl-tipo-obra").attr("data-id-tipo-obra");
//                var id_cliente = $("#obra-cliente").attr("data-id-cliente");
//                var id_regimen = $("#sl-regimen-contratacion").attr("data-id-regimen");
//                var descripcion = $("#crear_obra-descripcion").val();
//                
//                
//                var cadena = nombre+"§@"+estado+"§@"+municipio+"§@"+ciudad+"§@"+fechaInicio+"§@"+fechaFin+"§@"+id_tipoObra+"§@"+id_cliente+"§@"+id_regimen+"§@"+descripcion;
//                
//                  $.ajax({
//                type: "POST",
//                data:{variable: "modificarObra", id_obra: id_obra,cadena:cadena},
//                url:"crear_obra.php",
//                success: function(data)
//                {
//                    alert(data);
//                    
//                    $("#opt-crear_obra").trigger("click");
//                    
//                }
//            });
                
                
                
       
    
  });
  
  $("body").on("click",".btnDetallesObra",function()   // 
  {
      var id_obra = $(this).attr("id").split("_")[1];
      
      debugger;
      
       $.ajax(
            {
                url: "crear_obra.php",
                type: "POST",
                data: {variable: 'cargarDetallesObra',id_obra:id_obra},
                success: function (data)
                {
                    data = data.trim();
                    
                    
                
                   
                        $("#MdlDetallesObra #tblDetallesObra .cuerpo-detalles-obra").empty();
                        
                        $("#MdlDetallesObra #tblDetallesObra .cuerpo-detalles-obra").append(data);
                        
                        $('#MdlDetallesObra').jqxWindow('open');
                   
                        
                }
            });
	   
  });
  
  $("body").on("click","#btnMdlAceptarDetallesObra",function()   // 
  {
        $('#MdlDetallesObra').jqxWindow('close');
  
  });
  
  
  $("body").on("click",".eliminar-obra",function()   // 
  {
      var nombre = $(this).parent().parent().find("td").eq(1).text();
      
        var id_obra = $(this).attr("id").split("_")[1];
        
         var eliminar = confirm("¿Esta seguro que desea eliminar la obra: "+nombre+"?");
         
        if (eliminar) 
        {
          
          $.ajax({
                 type: "POST",
                 data:{variable: "eliminarLaObra", id_obra: id_obra},
                 url:"crear_obra.php",
                 success: function(data){
                   alert(data);
                   $("#opt-crear_obra").trigger("click");
                 }
             });   
             
             
             
             
        }
        
        
        
  
  });
  
  
  $("body").on("click",".btnReporteObra",function()   // 
  {
      var id_obra = $(this).attr("id").split("_")[1];
      
       window.open("reporte_obra.php?id_obra="+id_obra);
      
      
  });
  
  
  
  
  
  
  

}); // Fin del REady




function validarInsertSeguimientoObra(id)
{
    var valida ="";
    
    var fotoyaCargada= $(".imagen_"+id).length;
    
    var fotoDelBoton = $("#imagenSeguimiento_"+id).val();
    var descripcion = $("#descripcionSeguimiento_"+id).val();
    var costo = $("#costoSeguimiento_"+id).val();
    
    
    
    
    if(id!=0)
    {
        var before = id-1;
        
        if($(".imagen_"+before).length==0)
        {
            valida = "error";
           alert("Primero debe ingresar los datos del registro anterior");
           $("#imagenSeguimiento_"+before).focus();
           return valida;
        }
        
        
        
    }
    
   
    
    
    if(fotoyaCargada==0) // si no existe la imagen valida que se cargue la foto del boton, la descripcion y el costo
    {
        if(fotoDelBoton.trim()=="")
        {
           valida = "error";
           alert("Debe seleccionar una imagen");
           $("#imagenSeguimiento_"+id).focus();
           return valida;
        }
        if(descripcion.trim()=="")
        {
           valida = "error";
           alert("Debe ingresar la descripción");
           $("#descripcionSeguimiento_"+id).focus();
           return valida;
        }
         var patronNumero = /^[0-9]{1,50}$/;
        
        if(costo.trim()=="")
        {
           valida = "error";
           alert("Debe ingresar el costo");
           $("#costoSeguimiento_"+id).focus();
           return valida;
        }
        
       else
       {
            if(!patronNumero.test(costo))
           {
               valida = "error";
                alert("El campo Costro solo acepta digitos ");
                $("#costoSeguimiento_"+id).focus();
                return valida;
           }
       }
    }
    else  // si la imagen existe solo valida descripcion y costo
    {
        if(descripcion.trim()=="")
        {
           valida = "error";
           alert("Debe ingresar la descripción");
           $("#descripcionSeguimiento_"+id).focus();
           return valida;
        }
        
        var patronNumero = /^[0-9]{1,50}$/;
        
        if(costo.trim()=="")
        {
           valida = "error";
           alert("Debe ingresar el costo");
           $("#costoSeguimiento_"+id).focus();
           return valida;
        }
        
       else
       {
            if(!patronNumero.test(costo))
           {
               valida = "error";
                alert("El campo Costro solo acepta digitos ");
                $("#costoSeguimiento_"+id).focus();
                return valida;
           }
       }
        
    }
    
    
}


	
  
function cargarClientes() // cambio Luis
{

		 $.ajax(
            {
                url: "clientes.php",
                type: "POST",
                data: {variable: 'cargarClientes'},
                success: function (data)
                {
                    data = data.trim();
                    
                    
                    
                    if(data!="error")
                    {
                        $("#clientes-tabla table #clientes-filas").empty();
                        
                        $("#clientes-tabla table #clientes-filas").append(data);
                    }
                    else
                    {
                        
                    }
                    
                    
                    
                    
                }
            });
		
                
                
                
                
}




// funciones de validacion de formularios 





function validarFormularioClientes()
{
    
       var valida = "";
       
       if($("#cliente-titulo").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el titulo del cliente");
           $("#cliente-titulo").focus();
           return valida;
       }
       if($("#cliente-nombre").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el nombre del cliente");
           $("#cliente-nombre").focus();
           return valida;
       }
       if($("#cliente-apellidop").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el apellido paterno del cliente");
           $("#cliente-apellidop").focus();
           return valida;
       }
       if($("#cliente-apellidom").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el apellido materno del cliente");
           $("#cliente-apellidom").focus();
           return valida;
       }
       if($("#cliente-razon_social").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar la razon social del cliente");
           $("#cliente-razon_social").focus();
           return valida;
       }
       if($("#cliente-rfc").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el RFC del cliente");
           $("#cliente-rfc").focus();
           return valida;
       }
       
        if($("#cliente-estado").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el estado del cliente");
           $("#cliente-estado").focus();
           return valida;
       }
       
        if($("#cliente-municipio").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el municipio del cliente");
           $("#cliente-municipio").focus();
           return valida;
       }
        if($("#cliente-colonia").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar la colonia del cliente");
           $("#cliente-colonia").focus();
           return valida;
       }
        if($("#cliente-calle").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar la calle del cliente");
           $("#cliente-calle").focus();
           return valida;
       }
       
       
       
       var patronNumero = /^[0-9]{1,50}$/;
       
        if($("#cliente-numero").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar numero del cliente");
           $("#cliente-numero").focus();
           return valida;
       }
       else
       {
            if(!patronNumero.test($("#cliente-numero").val()))
           {
               valida = "error";
                alert("El campo Numero solo acepta digitos ");
                $("#cliente-numero").focus();
                return valida;
           }
       }
       
       
       if($("#cliente-telefono").val().trim()== "")
       {
           valida = "error";
           alert("Debe ingresar el telefono del cliente");
           $("#cliente-telefono").focus();
           return valida;
       }
       

       
}
function mostrarClientesSeleccionarObra() //Luis 3
{
    $.ajax(
            {
                url: "crear_obra.php",
                type: "POST",
                data: {variable: 'cargarClientesSeleccionObra'},
                success: function (data)
                {
                    data = data.trim();
                   
                    if(data!="error")
                    {
                        $("#MdlMostrarClientes table .clientes-filas").empty();
                        
                        $("#MdlMostrarClientes table .clientes-filas").append(data);
                    }
                    else
                    {
                        
                    }
                  
                }
            });
}
function cargarModalTiposDeObra() // Luis 3
{
    $.ajax(
                {
                    url: "crear_obra.php",
                    type: "POST",
                    data: {variable: 'cargarTipoObras'
                       },
                    success: function (data)
                    {    
                        data = data.trim();
                        
                        
                  
                        if(data.indexOf("error§@") == -1)
                        {
                           
                            $("#MdlMostrarTiposDeObra table .tipo-obra-filas").empty();
                        
                            $("#MdlMostrarTiposDeObra table .tipo-obra-filas").append(data);
                            
                        }
                        else
                        {
                            alert("ocurrio un error al almacenar los datos");
                            //alert(data); tipo de error
                        }
                         
                    }
                });
}

function validaFormularioCrearObra() // Luis 3
{
    var valida = "";
    
     if($("#crear_obra-nombre").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el nombre de la obra");
           $("#crear_obra-nombre").focus();
           return valida;
       }
       
       if($("#crear_obra-estado").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el estado donde se va a crear la obra");
           $("#crear_obra-estado").focus();
           return valida;
       }
       
        if($("#crear_obra-municipio").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el municipio donde se va a crear la obra");
           $("#crear_obra-municipio").focus();
           return valida;
       }
       
        if($("#crear_obra-ciudad").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar el ciudad donde se va a crear la obra");
           $("#crear_obra-ciudad").focus();
           return valida;
       }
       
       
       
       var regularExp = /(19|20)\d\d([-/.])(0?[1-9]|1[012])\2(0?[1-9]|[12][0-9]|3[01])/;
       
        if(!regularExp.test($("#fec-inicio-obra").val()))
       {
           //if($("#fec-inicio-obra").val() != "" || $("#fec-inicio-obra").val() !== undefined || $("#fec-inicio-obra").val() !== null )
           if($("#fec-inicio-obra").val() !== undefined)
           {
                  
                var longitud = $("#fec-inicio-obra").val().split("-")[0];
                 if (longitud.length > 4)
                 {
                     valida = "error";
                      alert("La fecha de inicio tiene formato incorrecto");
                      $("#fec-inicio-obra").focus();
                      return valida;
                 } 
            
            }
           valida = "error";
           alert("La fecha de inicio tiene formato incorrecto");
           $("#fec-inicio-obra").focus();
           return valida;
       }
      
     
     if(!regularExp.test($("#fec-fin-obra").val()))
       {
           //if($("#fec-inicio-obra").val() != "" || $("#fec-inicio-obra").val() !== undefined || $("#fec-inicio-obra").val() !== null )
           if($("#fec-fin-obra").val() !== undefined)
           {
                  
                var longitud = $("#fec-fin-obra").val().split("-")[0];
                 if (longitud.length > 4)
                 {
                     valida = "error";
                      alert("La fecha de fin tiene formato incorrecto");
                      $("#fec-fin-obra").focus();
                      return valida;
                 } 
            
            }
           valida = "error";
           alert("La fecha de fin tiene formato incorrecto");
           $("#fec-fin-obra").focus();
           return valida;
       }
       
       
       
       
    if($("#sl-tipo-obra").val().trim() == "")
       {
           valida = "error";
           alert("Debe Selecionar el tipo de obra");
           $("#seleccionar-tipo-obra").focus();
           return valida;
       }
       
       if($("#obra-cliente").val().trim() == "")
       {
           valida = "error";
           alert("Debe Seleccionar el cliente que pide la obra");
           $("#seleccionar-cliente").focus();
           return valida;
       }
    
     if($("#sl-regimen-contratacion").val().trim() == "")
       {
           valida = "error";
           alert("Debe Seleccionar el regimen de contratacion de la obra");
           $("#seleccionar-regimen").focus();
           return valida;
       }
       
        if($("#crear_obra-descripcion").val().trim() == "")
       {
           valida = "error";
           alert("Debe ingresar la descripcion de la obra");
           $("#crear_obra-descripcion").focus();
           return valida;
       }
 }

function validarFechaInicioYFechaFin() // Luis 3
{
    var fecha_inicio = $("#fec-inicio-obra").val();
    var fecha_fin = $("#fec-fin-obra").val();
    
    var valida="";
            
    if(fecha_inicio > fecha_fin)
    {
        valida="error";
        alert("La fecha de inicio no puede ser mayor a la fecha de fin");
        $("#fec-inicio-obra").focus();
        return valida;
    }
    
    if(fecha_fin < fecha_inicio)
    {
        valida="error";
        alert("La fecha de fin no puede ser menor a la fecha de inicio");
        $("#fec-fin-obra").focus();
        return valida;
    }
    
    if(fecha_fin == fecha_inicio)
    {
        alert("La fecha de inicio y la fecha de fin no pueden ser iguales");
        valida="error";
        $("#fec-inicio-obra").focus();
        return valida;
    }
    
}

function validarFechasDistanciaMinimaUnMes() // Luis 3
{
    
    
    var fecha_inicio = $("#fec-inicio-obra").val();
    var fecha_fin = $("#fec-fin-obra").val();
    
    var valida="";
     
    $.ajax(
                {
                    url: "crear_obra.php",
                    type: "POST",
                    data: {variable: 'validaDistanciaMinimaUnMes',fecha_inicio:fecha_inicio,fecha_fin:fecha_fin
                       },
                    success: function (data)
                    {    
                        data = data.trim();
                        data = parseInt(data);
                        
                        
                        if(data<=0)
                        {
                            valida="error";
                             
                            alert("Debe haber mínimo un mes de diferencia entre la fecha de inicio y la fecha de fin de la obra")
                            $("#fec-inicio-obra").focus();
                            return valida;

                        }
                        else
                        {
                            
                            var nombre = $("#crear_obra-nombre").val();
                            var estado = $("#crear_obra-estado").val();
                            var municipio = $("#crear_obra-municipio").val();
                            var ciudad = $("#crear_obra-ciudad").val();
                            var fechaInicio = $("#fec-inicio-obra").val();
                            var fechaFin = $("#fec-fin-obra").val();
                            var tipoObra = $("#sl-tipo-obra").attr("data-id-tipo-obra");
                            var cliente = $("#obra-cliente").attr("data-id-cliente");
                            var regimen = $("#sl-regimen-contratacion").attr("data-id-regimen");
                            var descripcion = $("#crear_obra-descripcion").val();
                            
                            
                            
                            var cadena = nombre+"§@"+descripcion+"§@"+estado+"§@"+municipio+"§@"+ciudad+"§@"+tipoObra+"§@"+regimen+"§@"+fechaInicio+"§@"+fechaFin+"§@"+cliente;
                            
                            $.ajax({
                                url:"crear_obra.php",
                                type: "POST",
                                data:{variable: "InsertarObras",cadena:cadena},
                                success: function(data){
                                  
                                    alert(data);
                                    
                                    $("#opt-crear_obra").trigger("click");
                                  
                                }
                            }); 
                        }
                        
                        
                        
                         
                    }
                });
         
}



function validarFechasDistanciaMinimaUnMesUpdate(id_obra) // Luis 3
{
    
    
    var fecha_inicio = $("#fec-inicio-obra").val();
    var fecha_fin = $("#fec-fin-obra").val();
    
    var valida="";
     
    $.ajax(
                {
                    url: "crear_obra.php",
                    type: "POST",
                    data: {variable: 'validaDistanciaMinimaUnMes',fecha_inicio:fecha_inicio,fecha_fin:fecha_fin
                       },
                    success: function (data)
                    {    
                        data = data.trim();
                        data = parseInt(data);
                        
                        
                        if(data<=0)
                        {
                            valida="error";
                             
                            alert("Debe haber mínimo un mes de diferencia entre la fecha de inicio y la fecha de fin de la obra")
                            $("#fec-inicio-obra").focus();
                            return valida;

                        }
                        else
                        {
                            
                            //var id_obra = $(this).attr("data-id-obra");
      
                                var nombre = $("#crear_obra-nombre").val();
                                var estado = $("#crear_obra-estado").val();
                                var municipio = $("#crear_obra-municipio").val();
                                var ciudad = $("#crear_obra-ciudad").val();
                                var fechaInicio = $("#fec-inicio-obra").val();
                                var fechaFin = $("#fec-fin-obra").val();
                                var id_tipoObra = $("#sl-tipo-obra").attr("data-id-tipo-obra");
                                var id_cliente = $("#obra-cliente").attr("data-id-cliente");
                                var id_regimen = $("#sl-regimen-contratacion").attr("data-id-regimen");
                                var descripcion = $("#crear_obra-descripcion").val();


                                var cadena = nombre+"§@"+estado+"§@"+municipio+"§@"+ciudad+"§@"+fechaInicio+"§@"+fechaFin+"§@"+id_tipoObra+"§@"+id_cliente+"§@"+id_regimen+"§@"+descripcion;

                                  $.ajax({
                                type: "POST",
                                data:{variable: "modificarObra", id_obra: id_obra,cadena:cadena},
                                url:"crear_obra.php",
                                success: function(data)
                                {
                                    alert(data);

                                    $("#opt-crear_obra").trigger("click");

                                }
                            });
                        }
                        
                        
                        
                         
                    }
                });
         
}






function cargarModalRegimenContratacionObra()
{

            $.ajax(
            {
                url: "crear_obra.php",
                type: "POST",
                data: {variable: 'cargarRegimenContratacionObras'},
                success: function (data)
                {
                    data = data.trim();
                    
                    
                    
                    if(data!="error")
                    {
                        $("#MdlRegimenObra table .tipo-regimen-obra").empty();
                        
                        $("#MdlRegimenObra table .tipo-regimen-obra").append(data);
                    }
                    else
                    {
                        
                    }
                     
                }
            });
        
              
}

function cargarObrasModificar(id_obra)  
{
    
     $.ajax({
            url:"crear_obra.php",
            type: "POST",
            data:{variable: "cargarObrasUpdate", id_obra: id_obra},
            success: function(data)
            {
                data = data.trim();
                
                var matriz = [];
                 matriz = data.split("§@");
                
                $("#crear_obra-nombre").val(matriz[0]);
                $("#crear_obra-estado").val(matriz[1]);
                 $("#crear_obra-municipio").val(matriz[2]);
                 $("#crear_obra-ciudad").val(matriz[3]);
                 $("#fec-inicio-obra").val(matriz[4]);
                 $("#fec-fin-obra").val(matriz[5]);
                 $("#sl-tipo-obra").val(matriz[6]);
                $("#obra-cliente").val(matriz[7]);
                $("#sl-regimen-contratacion").val(matriz[8]);
                $("#crear_obra-descripcion").val(matriz[9]);
                
                $("#sl-tipo-obra").attr("data-id-tipo-obra",matriz[10]);
                $("#obra-cliente").attr("data-id-cliente",matriz[12]);
                $("#sl-regimen-contratacion").attr("data-id-regimen",matriz[11]);
                $("#btn-modificar-crear_obra").attr("data-id-obra",id_obra)
                
              
                
            }
        });
}