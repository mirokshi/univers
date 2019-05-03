<template>
    <v-navigation-drawer
        v-model="dataDrawer"
        fixed
        app
        clipped
        class="red lighten-3"
    >
        <v-list dense>
            <template v-for="item in items">
                <v-layout
                    v-if="item.heading"
                    :key="item.heading"
                    row
                    align-center
                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group
                    v-else-if="item.children"
                    v-model="item.model"
                    :key="item.text"
                    :prepend-icon="item.model ? item.icon : item['icon-alt']"
                    append-icon=""
                >
                    <v-list-tile slot="activator" :href="item.url">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                        v-for="(child, i) in item.children"
                        :key="i"
                        :href="child.url"
                        :style="selectedStyle(child)"
                    >
                        <v-list-tile-action v-if="child.icon">
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else :key="item.text" :href="item.url"
                             :style="selectedStyle(item)"
                >
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    export default {
        name: 'Navigation',
        data () {
            return {
                dataDrawer: this.drawer,
                items: [
                    { icon: 'accessibility', text: 'Welcome', url: '/' },
                    { icon: 'home', text: 'Home', url: '/home' },

                    {
                        icon: 'keyboard_arrow_up',
                        'icon-alt': 'keyboard_arrow_down',
                        text: 'Univers',
                        model: false,
                        children: [
                            { icon: 'child_care', text: 'Usuaris', url: '/alumnes' },
                            { icon: 'domain', text: 'Entitats', url: '/entitats' },
                            { icon: 'event_note', text: 'Activitats', url: '/activitats' },
                        ]
                    },
                    { icon: 'help', text: 'Contact', url: '/contact' },
                    { icon: 'assessment', text: 'Sparklines', url: '/sparklines' }
                ]
            }
        },
        props: {
            drawer: {
                Type: Boolean,
                default: false
            }
        },
        watch: {
            dataDrawer (drawer) {
                this.$emit('input', drawer)
            },
            drawer (drawer) {
                this.dataDrawer = drawer
            }
        },
        model: {
            prop: 'drawer',
            event: 'input'
        },
        methods: {
            isSelectedItem (item) {
                const currentPath = window.location.pathname
                return currentPath === item.url
                // const selected = this.items.indexOf(this.items.find(item => item.url === currentPath))
                // this.items[selected].selected = true
            },
            selectedStyle (item) {
                if (this.isSelectedItem(item)) {
                    return {
                        'border-right': '5px solid #E53935',
                        'background-color': '#ffbeb4',
                        'font-size': '1em'
                    }
                }
            }
        }
    }
</script>
