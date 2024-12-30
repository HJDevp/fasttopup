// export default {
//     plugins: {
//         tailwindcss: {},
//         autoprefixer: {},
//         // cssnano: {
//         //   preset: 'default',
//         // }
//     },
// };

module.exports = {
    plugins: [
      require('tailwindcss'),
      require('autoprefixer'),
      require('cssnano')({
        preset: 'default',
      }),
    ],
}
  