class LoginComponent extends Fronty.ModelComponent {
  constructor(usuarioModel, router) {
    super(Handlebars.templates.login, usuarioModel);
    this.userModel = usuarioModel;
    this.usuarioService = new UsuarioService();
    this.router = router;

    this.addEventListener('click', '#loginbutton', (event) => {
      this.usuarioService.login($('#login').val(), $('#password').val(), $('email'))
        .then(() => {
          this.router.goToPage('notas');
          this.usuarioModel.setLoggeduser($('#login').val());
        })
        .catch(() => {
          this.usuarioModel.logout();
        });
    });

    this.addEventListener('click', '#registerlink', () => {
      this.usuarioModel.set(() => {
        this.usuarioModel.registerMode = true;
      });
    });

    this.addEventListener('click', '#registerbutton', () => {
      this.usuarioService.register({
          usuario: $('#registerusername').val(),
          contraseña: $('#registerpassword').val(),
          email: $('#registeremail').val()
        })
        .then(() => {
          alert(I18n.translate('Usuario registrado! Por favor, inicia sesión'));
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
            alert('un error ha ocurrido durante la solicitud:' + statusText + '.' + xhr.responseText);
          }
        });
    });
  }
}
