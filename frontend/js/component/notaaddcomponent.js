class NotaAddComponent extends Fronty.ModelComponent {
  constructor(notasModel, usuarioModel, router) {
    super(Handlebars.templates.notaeditar, notasModel);
    this.notasModel = notasModel; // notas

    this.usuarioModel = usuarioModel; // global
    this.addModel('usuario', usuarioModel);
    this.router = router;

    this.notasService = new NotasService();

    this.addEventListener('click', '#botonGuardar', () => {
      var nuevaNota = {};
      nuevaNota.nombre = $('#nombre').val();
      nuevaNota.contenido = $('#contenido').val();
      nuevaNota.Usuario_idUsuario = this.usuarioModel.currentUsuario;
      this.notasService.addNota(nuevaNota)
        .then(() => {
          this.router.goToPage('notas');
        })
        .fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.notasModel.set(() => {
              this.notasModel.errors = xhr.responseJSON;
            });
          } else {
            alert('un error ha ocurrido durante la solicitud: ' + statusText + '.' + xhr.responseText);
          }
        });
    });
  }
}
