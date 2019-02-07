<script>
    export default {
        el: '#app',
        name: 'App',
        data () {
            return {
                drawer: false,
                items: [
                    { icon: 'home', text: 'Welcome', url: '/' },
                    {
                        icon: 'keyboard_arrow_up',
                        'icon-alt': 'keyboard_arrow_down',
                        text: 'Univers',
                        model: true,
                        children: [
                            { icon: 'build', text: 'Alumnes', url: '/alumnes' },
                            { icon: 'build', text: 'Entitats', url: '/entitats' },
                        ]
                    },
                    { icon: 'help', text: 'Contact', url: '/contact' },
                    { icon: 'public', text: 'About', url: '/about' },
                    { icon: 'compare_arrows', text: 'Changelog', url: '/changelog' }
                ]
            }
        }
    }

</script>
