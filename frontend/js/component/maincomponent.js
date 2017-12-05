class MainComponent extends Fronty.RouterComponent {
  constructor() {
    super('frontyapp', Handlebars.templates.main, 'maincontent');

    // models instantiation
    // we can instantiate models at any place
    var usuarioModel = new UsuarioModel();
    var notasModel = new NotasModel();

    super.setRouterConfig({
      notas: {
        component: new NotasComponent(notasModel, usuarioModel, this),
        title: 'Notas'
      },
      'ver-nota': {
        component: new NotaVerComponent(notasModel, usuarioModel, this),
        title: 'Nota'
      },
      'editar-nota': {
        component: new NotaEditarComponent(notasModel, usuarioModel, this),
        title: 'Editar Nota'
      },
      'add-nota': {
        component: new NotaAddComponent(notasModel, usuarioModel, this),
        title: 'Añadir Nota'
      },
      'login': {
        component: new LoginComponent(usuarioModel, this),
        title: 'Login'
      },
      defaultRoute: 'notas'
    });

    Handlebars.registerHelper('currentPage', () => {
          return super.getCurrentPage();
    });

    var usuarioService = new UsuarioService();
    this.addChildComponent(this._createUsuarioBarComponent(usuarioModel, usuarioService));
    this.addChildComponent(this._createLanguageComponent());

  }

  _createUsuarioBarComponent(usuarioModel, usuarioService) {
    var usuariobar = new Fronty.ModelComponent(Handlebars.templates.usuario, usuarioModel, 'usuariobar');

    usuariobar.addEventListener('click', '#logoutbutton', () => {
      usuarioModel.logout();
      usuarioService.logout();
    });

    // do relogin
    usuarioService.loginWithSessionData()
      .then(function(logged) {
        if (logged != null) {
          usuarioModel.setLoggeduser(logged);
        }
      });

    return usuariobar;
  }

  _createLanguageComponent() {
    var languageComponent = new Fronty.ModelComponent(Handlebars.templates.language, this.routerModel, 'languagecontrol');
    // language change links
    languageComponent.addEventListener('click', '#englishlink', () => {
      I18n.changeLanguage('en');
      document.location.reload();
    });

    languageComponent.addEventListener('click', '#spanishlink', () => {
      I18n.changeLanguage('default');
      document.location.reload();
    });

    return languageComponent;
  }
}
