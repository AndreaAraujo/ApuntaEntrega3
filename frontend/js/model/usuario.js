class UsuarioModel extends Fronty.Model {
  constructor() {
    super('UsuarioModel');
    this.isLogged = false;
  }

  setLoggedusuario(loggedUsuario) {
    this.set((self) => {
      self.currentUser = loggedUsuario;
      self.isLogged = true;
    });
  }

  logout() {
    this.set((self) => {
      delete self.currentUser;
      self.isLogged = false;
    });
  }
}
