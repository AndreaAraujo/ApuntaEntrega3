class NotasModel extends Fronty.Model {

  constructor() {
    super('NotasModel'); //call super

    // model attributes
    this.notas = [];
  }

  setSelectedNota(nota) {
    this.set((self) => {
      self.selectedNota = nota;
    });
  }

  setNotas(notas) {
    this.set((self) => {
      self.notas = notas;
    });
  }
}
