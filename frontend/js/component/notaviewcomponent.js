class NotaViewComponent extends Fronty.ModelComponent {
  constructor(notasModel, usuarioModel, router) {
    super(Handlebars.templates.notaview, notasModel);

    this.notasModel = notasModel; // posts
    this.usuarioModel = usuarioModel; // global
    this.addModel('usuario', usuarioModel);
    this.router = router;

    this.notasService = new NotasService();

    // this.addEventListener('click', '#savecommentbutton', () => {
    //   var selectedIdNota = this.router.getRouteQueryParam('id');
    //   this.notasService.createComment(selectedIdNota, {
    //       contenido: $('#commentcontent').val()
    //     })
    //     .then(() => {
    //       $('#commentcontent').val('');
    //       this.loadPost(selectedIdNota);
    //     })
    //     .fail((xhr, errorThrown, statusText) => {
    //       if (xhr.status == 400) {
    //         this.postsModel.set(() => {
    //           this.postsModel.commentErrors = xhr.responseJSON;
    //         });
    //       } else {
    //         alert('an error has occurred during request: ' + statusText + '.' + xhr.responseText);
    //       }
    //     });
    // });
  }

  onStart() {
    var selectedId = this.router.getRouteQueryParam('id');
    this.loadNota(selectedId);
  }

  loadPost(idNota) {
    if (idNota != null) {
      this.notasService.findNota(idNota)
        .then((nota) => {
          this.notasModel.setSelectedNota(nota);
        });
    }
  }
}
