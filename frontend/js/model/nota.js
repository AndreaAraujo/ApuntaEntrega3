class  NotaModel extends Fronty.Model {

  constructor(idNota, nombre, contenido,Usuario_idUsuario) {
    super('NotaModel'); //call super

    if (idNota) {
      this.idNota = idNota;
    }

    if (nombre) {
      this.nombre = nombre;
    }

    if (contenido) {
      this.contenido = contenido;
    }

    if (Usuario_idUsuario) {
      this.Usuario_idUsuario = Usuario_idUsuario;
    }
  }

  setNombre(nombre) {
    this.set((self) => {
      self.nombre = nombre;
    });
  }

  setContenido(contenido) {
    this.set((self) => {
      self.contenido = contenido;
    });
  }

  setUsuario_idUsuario(Usuario_idUsuario) {
    this.set((self) => {
      self.Usuario_idUsuario = Usuario_idUsuario;
    });
  }
}
