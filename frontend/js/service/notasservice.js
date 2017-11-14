class NotasService {
  constructor() {

  }

  findAllNotas() {
    return $.get(AppConfig.backendServer+'/rest/nota');
  }

  findNota(id) {
    return $.get(AppConfig.backendServer+'/rest/nota/' + id);
  }

  deleteNota(id) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/nota/' + id,
      method: 'DELETE'
    });
  }

  saveNota(nota) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/nota/' + nota.id,
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
