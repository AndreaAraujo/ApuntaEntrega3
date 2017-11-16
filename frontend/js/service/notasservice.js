class NotasService {
  constructor() {

  }

  findAllNotas() {
    return $.get(AppConfig.backendServer+'/rest/nota');
  }

  findNota(idNota) {
    return $.get(AppConfig.backendServer+'/rest/nota/' + idNota);
  }

  deleteNota(idNota) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/nota/' + idNota,
      method: 'DELETE'
    });
  }

  saveNota(nota) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/nota/' + nota.idNota,
      method: 'PUT',
      data: JSON.stringify(nota),
      contentType: 'application/json'
    });
  }

  addNota(nota) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/nota',
      method: 'POST',
      data: JSON.stringify(nota),
      contentType: 'application/json'
    });
  }

  /*createComment(notaid, comment) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/nota/' + postid + '/comment',
      method: 'POST',
      data: JSON.stringify(comment),
      contentType: 'application/json'
    });
  }*/

}
