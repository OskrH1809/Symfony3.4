function controlBorrado(path,reserva){
    swal({
        title: "Esta seguro?",
        text: "Eliminar la fecha de reserva "+reserva,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.replace(path);
        }
      });
return false;
}