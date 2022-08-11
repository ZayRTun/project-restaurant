/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./resources/**/*.blade.php"],
	theme: {
		extend: {
			transitionProperty: {
				'height': 'height',
			}
		},
	},
	plugins: [
		require('@tailwindcss/forms'),
		require('@tailwindcss/line-clamp')
	],
}
