const mix = require('laravel-mix');

mix
  // 1) Compile ton JS
  .js('resources/js/app.js', 'public/js')

  // 2) Traite ton CSS pur avec PostCSS
  //    Si tu utilises seulement du CSS, utilise .postCss()
  .postCss('resources/css/app.css', 'public/css', [
    // ici tu peux ajouter tes plugins PostCSS si besoin :
    // require('tailwindcss'),
    // require('autoprefixer'),
  ])

  // 3) BrowserSync pour le live‑reload et la preview mobile
  .browserSync({
    proxy: 'http://127.0.0.1:8000',   // l’URL de ton serveur Laravel
    host: '192.168.1.xxx',            // ton IP locale (WAN dans ton LAN)
    port: 3000,                       // port BrowserSync
    files: [
      'app/**/*.php',
      'routes/**/*.php',
      'resources/views/**/*.blade.php',
      'public/js/**/*.js',
      'public/css/**/*.css',
    ],
    open: false,
    notify: false,
  });

// Optionnel : versionnement et optimisation en prod
if (mix.inProduction()) {
  mix.version();
}
