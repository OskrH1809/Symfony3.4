function cambiarCatSelect(){
    $.getJSON( "http://127.0.0.1:8000/api/listarCategorias", function(data){
    var ultimaCategoria=data[data.length-1];
    $(tapa_categoria).append(new Option(ultimaCategoria["nombre"], ultimaCategoria["id"]));
    });
}

function nuevaCatAdd(){
    var ejecutarNuevaCat = $.post("http://127.0.0.1:8000/api/insertarCategoria/"+$(nuevaCat).val(),function(){
        $(nuevaCat).val("");
        cambiarCatSelect();
        alert("nueva categoria insertada");
    })
    .fail(function(){
        alert("fallo al guardar");
    });
}