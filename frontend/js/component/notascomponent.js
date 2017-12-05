class NotasComponent extends Fronty.ModelComponent {
  constructor(notasModel, usuarioModel, router) {
    super(Handlebars.templates.notastable, notasModel, null, null);


    this.notasModel = notasModel;
    this.usuarioModel = usuarioModel;
    this.addModel('usuario', usuarioModel);
    this.router = router;

    this.notasService = new NotasService();

  }

  onStart() {
    this.updateNotas();
  }

  updateNotas() {
    this.notasService.findAllNotas().then((data) => {

      this.notasModel.setNotas(
        // create a Fronty.Model for each item retrieved from the backend
        data.map(
          (item) => new NotaModel(item.idNota, item.nombre, item.contenido, item.Usuario_idUsuario)
      ));
    });
  }

  // Override
  createChildModelComponent(className, element, id, modelItem) {
    return new NotaRowComponent(modelItem, this.usuarioModel, this.router, this);
  }
}

class NotaRowComponent extends Fronty.ModelComponent {
  constructor(notaModel, usuarioModel, router, notasComponent) {
    super(Handlebars.templates.notarow, notaModel, null, null);

    this.notasComponent = notasComponent;

    this.usuarioModel = usuarioModel;
    this.addModel('usuario', usuarioModel); // a secondary model

    this.router = router;

    this.addEventListener('click', '.remove-button', (event) => {
      if (confirm(I18n.translate('Are you sure?'))) {
        var notaId = event.target.getAttribute('item');
        this.notasComponent.notasService.deleteNota(idNota)
          .fail(() => {
            alert('note cannot be deleted')
          })
          .always(() => {
            this.notasComponent.updateNotas();
          });
      }
    });

    this.addEventListener('click', '.editar-button', (event) => {
      var idNota = event.target.getAttribute('item');
      this.router.goToPage('editar-nota?id=' + idNota);
    });
  }

}
