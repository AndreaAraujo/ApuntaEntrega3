/* Main mvcblog-front script */

//load external resources
function loadTextFile(url) {
  return new Promise((resolve, reject) => {
    $.get({
      url: url,
      cache: true,
      dataType: 'text'
    }).then((source) => {
      resolve(source);
    }).fail(() => reject());
  });
}


// Configuration
var AppConfig = {
  backendServer: 'http://localhost/ApuntaEntrega3'
  //backendServer: '/mvcblog'
}

Handlebars.templates = {};
Promise.all([
    I18n.initializeCurrentLanguage('js/i18n'),
    loadTextFile('templates/components/main.hbs').then((source) =>
      Handlebars.templates.main = Handlebars.compile(source)),
    loadTextFile('templates/components/language.hbs').then((source) =>
      Handlebars.templates.language = Handlebars.compile(source)),
    loadTextFile('templates/components/usuario.hbs').then((source) =>
      Handlebars.templates.usuario = Handlebars.compile(source)),
    loadTextFile('templates/components/login.hbs').then((source) =>
      Handlebars.templates.login = Handlebars.compile(source)),
    loadTextFile('templates/components/notas-table.hbs').then((source) =>
      Handlebars.templates.notastable = Handlebars.compile(source)),
    loadTextFile('templates/components/nota-edit.hbs').then((source) =>
      Handlebars.templates.notaedit = Handlebars.compile(source)),
    loadTextFile('templates/components/nota-view.hbs').then((source) =>
      Handlebars.templates.notaview = Handlebars.compile(source)),
    loadTextFile('templates/components/nota-row.hbs').then((source) =>
      Handlebars.templates.notarow = Handlebars.compile(source))
  ])
  .then(() => {
    $(() => {
      new MainComponent().start();
    });
  }).catch((err) => {
    alert('FATAL: could not start app ' + err);
  });
