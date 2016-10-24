module.exports = {
  entry: {
    app: ['./Ressources/assets/sass/app.scss', './Ressources/assets/js/app.js']
  },
  port: 3003,
  html: false,
  assets_url: '/assets/',  // Urls dans le fichier final
  assets_path: './Templates/Default/assets/', // ou build ?
  refresh: ['Application/**/*.php', 'Application/Views/**/**.html.twig'] // Permet de forcer le rafraichissement du navigateur lors de la modification de ces fichiers
}
