/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        "./resources/views/**/*.{php,js,html}",
    ],
    theme: {
        container: {
            center: true,
            padding: '1rem',
            screens: {
                sm: '570px',
                md: '680px',
                lg: '790px'
            },
        },
        extend: {
            colors: {
                xbg: {
                    600: '#56575d',
                    700: '#35373e',
                    800: '#202229'
                },
                xamber: {
                    700: '#ff8d2b',
                    800: '#ff6200'
                },
                xdark: {
                    600: '#414141',
                    700: '#434343',
                    800: '#191919'
                }
            }
        },
    },
}

