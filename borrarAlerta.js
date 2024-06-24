function alertaBorrar(){
    Swal.fire({
        title: "¿Estás seguro de borrar estos datos?",
        text: "No podrás revertir los cambios si los borras!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, bórralo!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Eliminado!",
            text: "Los datos han sido eliminados correctamente.",
            icon: "success"
          });
        }
      });
}

function editar(){
  window.location.href="pantallaEditar.php";
}

function ver(){
  window.location.href="pantallaVer.php";
}

function regresar(){
  window.location.href="dataTable.php"
}

function agregar(){
  window.location.href="pantallaEditar.php"
}