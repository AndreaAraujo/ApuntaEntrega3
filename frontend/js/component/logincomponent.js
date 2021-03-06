class LoginComponent extends Fronty.ModelComponent {
  constructor(usuarioModel, router) {
    super(Handlebars.templates.login, usuarioModel);
    this.usuarioModel = usuarioModel;
    this.usuarioService = new UsuarioService();
    this.router = router;

    this.addEventListener('click', '#nombreLogin', (event) => {
      this.usuarioService.login($('#login').val(), $('#password').val())
        .then(() => {
          this.router.goToPage('notas');
          this.usuarioModel.setLoggedusuario($('#login').val());
        })
        .catch(() => {
          this.usuarioModel.logout();
        });
    });

    this.addEventListener('click', '#btnNuevoRegistro', () => {
      this.usuarioModel.set(() => {
        this.usuarioModel.registerMode = true;
      });
    });

    this.addEventListener('click', '#btnRegistro', () => {
      this.usuarioService.register({
          login: $('#registroNombre').val(),
          password: $('#registroPassword').val(),
          email: $('#registroEmail').val()
        })
        .then(() => {
          alert(I18n.translate('Usuario registrado! logeate'));
          this.usuarioModel.set((model) => {
            model.registerErrors = {};
            model.registerMode = false;
          });
        })
        .fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.usuarioModel.set(() => {
              this.usuarioModel.registerErrors = xhr.responseJSON;
            });
          } else {
            alert('un error ha ocurrido durante la solicitud: ' + statusText + '.' + xhr.responseText);
          }
        });
    });
  }
}
