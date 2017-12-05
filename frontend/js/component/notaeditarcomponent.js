class NotaEditarComponent extends Fronty.ModelComponent {
  constructor(notasModel, usuarioModel, router) {
    super(Handlebars.templates.notaeditar, notasModel);
    this.notasModel = notasModel; // posts
    this.usuarioModel = userModel; // global
    this.addModel('usuario', usuariopModel);
    this.router = router;

    this.notasService = new NotasService();

    this.addEventListener('click', '#savebutton', () => {
      this.notasModel.selectedNota.nombre = $('#nombre').val();
      this.notasModel.selectedNota.contenido = $('#contenido').val();
      this.notasService.saveNota(this.notasModel.selectedNota)
        .then(() => {
          this.notasModel.set((model) => {
            model.errors = []
          });
          this.router.goToPage('notas');
        })
        .fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.notasModel.set((model) => {
              model.errors = xhr.responseJSON;
            });
          } else {
            alert('un error ha ocurrido durante la solicitud: ' + statusText + '.' + xhr.responseText);
          }
        });

    });
  }

  onStart() {
    var selectedId = this.router.getRouteQueryParam('id');
    if (selectedId != null) {
      this.notasService.findNota(selectedId)
        .then((nota) => {
          this.notasModel.setSelectedPost(post);
        });
    }
  }
}
