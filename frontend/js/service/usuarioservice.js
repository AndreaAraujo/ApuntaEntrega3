class UsuarioService {
  constructor() {

  }

  loginWithSessionData() {
    var self = this;
    return new Promise((resolve, reject) => {
      if (window.sessionStorage.getItem('login') &&
        window.sessionStorage.getItem('pass') && window.sessionStorage.getItem('email')) {
        self.login(window.sessionStorage.getItem('login'), window.sessionStorage.getItem('pass'), window.sessionStorage.getItem('email'))
          .then(() => {
            resolve(window.sessionStorage.getItem('login'));
          })
          .catch(() => {
            reject();
          });
      } else {
        resolve(null);
      }
    });
  }

  login(login, pass, email) {
    return new Promise((resolve, reject) => {

      $.get({
          url: AppConfig.backendServer+'/rest/usuario/' + login,
          beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa(login + ":" + pass + ":" + email));
          }
        })
        .then(() => {
          //keep this authentication forever
          window.sessionStorage.setItem('login', login);
          window.sessionStorage.setItem('pass', pass);
          window.sessionStorage.getItem('email', email);
          $.ajaxSetup({
            beforeSend: (xhr) => {
              xhr.setRequestHeader("Authorization", "Basic " + btoa(login + ":" + pass + ":" + email));
            }
          });
          resolve();
        })
        .fail(() => {
          window.sessionStorage.removeItem('login');
          window.sessionStorage.removeItem('pass');
          window.sessionStorage.removeItem('email');
          $.ajaxSetup({
            beforeSend: (xhr) => {}
          });
          reject();
        });
    });
  }

  logout() {
    window.sessionStorage.removeItem('login');
    window.sessionStorage.removeItem('pass');
    window.sessionStorage.removeItem('email');
    $.ajaxSetup({
      beforeSend: (xhr) => {}
    });
  }

  register(usuario) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/usuario',
      method: 'POST',
      data: JSON.stringify(usuario),
      contentType: 'application/json'
    });
  }
}
