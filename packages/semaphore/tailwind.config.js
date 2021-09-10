module.exports = {
  purge: {
    content: [
      './resources/views/**/*.blade.php',
      './resources/ts/**/*.{js,jsx,ts,tsx,vue}',
    ],
    options: {
      safelist: [/^col-span-.*/, /^mb-.*/]
    }
  },
  theme: {
    extend: {
      colors: {
        'cobalt': '#3b3081',
        'pearl': '#6ecbbf',
        'tangerine': '#ffb04e',
        'raspberry': '#f7086e',
      }
    },
    fontFamily: {
      body: ['Work Sans', 'Helvetica', 'sans-serif'],
      highlight: ['Kanit', 'Helvetica', 'serif'],
    },
  },
}
