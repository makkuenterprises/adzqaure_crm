module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container: {
      maxWidth: {
        'sm': '350px',
      },
      center: true,
      padding: {
        'DEFAULT': '1rem',
        'sm': '2rem',
        'lg': '4rem',
        'xl': '5rem',
        '2xl': '6rem',
      },
    },
    screens: {
      'sm': '300px',
      'md': '600px',
      'lg': '1440px',
      'xl': '1280px',
      '2xl': '1536px',
    },
    extend: {
      colors: {
        'admin-dominant': '#FFF',
        'admin-complement' : '#e0e7ff',
        'admin-ascent' : '#3a0ca3',
        'admin-ascent-dark' : '#1b0156',
      },
    },
    
  },
  plugins: [],
}