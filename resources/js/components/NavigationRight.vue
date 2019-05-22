<template>
    <v-navigation-drawer
        v-model="dataDrawer"
        fixed
        right
        clipped
        app
        class="primary lighten-5"
    >
            <v-card-title class="primary lighten-1 white--text"><h4>Perfil</h4></v-card-title>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-avatar>
                    <v-avatar>
                        <img :title="user.name" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1">
                    </v-avatar>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>{{user.name}}</v-list-tile-title>
                    <v-list-tile-title>{{user.email}}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-content>
                    <v-list-tile-title>Administrador? {{ user.admin ? 'Si' : 'No' }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list>
                <v-list-group v-ripple no-action>
                    <v-list-tile slot="activator">
                        <v-list-tile-content>Rols</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile v-for="rol in user.roles" :key="rol">
                        <v-list-tile-content>
                            <v-list-tile-title>{{ rol }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-divider></v-divider>
                <v-list-group v-ripple no-action>
                    <v-list-tile slot="activator">
                        <v-list-tile-content>Permisos</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile v-for="permis in user.permissions" :key="permis">
                        <v-list-tile-content>
                            <v-list-tile-title>{{ permis }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
            </v-list>
            <v-form action="logout" method="POST">
                <input type="hidden" name="_token" :value="csrfToken">
                <v-btn type="submit">Cerrar sesion <v-icon>exit_to_app</v-icon></v-btn>
            </v-form>
    </v-navigation-drawer>
</template>

<script>
    export default {
        name: 'NavigationRight',
        data () {
            return {
                dataDrawer: this.drawerRight
            }
        },
        props: {
            drawerRight: {
                Type: Boolean,
                default: null
            },
            csrfToken: {
                Type: String
            }
        },
        watch: {
            dataDrawer (newval) {
                this.$emit('input', newval)
            },
            drawerRight (newval) {
                this.dataDrawer = newval
            }
        },
        model: {
            prop: 'drawerRight',
            event: 'input'
        },
        computed: {
            isImpersonating: function () {
                return !!window.impersonatedBy
            },
            canImpersonate: function () {
                return window.laravel_user.admin || false
            },
            gravatar: function () {
                return (
                    'https://www.gravatar.com/avatar/' +
                    window.md5(
                        window.impersonatedBy
                            ? window.impersonatedBy.email
                            : 'google@gmail.com'
                    )
                )
            },
            user: function () {
                return window.laravel_user
            },
            impersonatedBy: function () {
                return window.impersonatedBy || undefined
            }
        }
    }
</script>
