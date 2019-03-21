<template>
    <v-expansion-panel
        expand>
        <v-expansion-panel-content
            expand-icon="mdi-menu-down"
        >
            <template v-slot:header>
                <div>Filters</div>
            </template>
            <v-card>
                <v-flex>
                    <v-select
                        lg3
                        v-model="e2"
                        :items="states"
                        append-outer-icon="map"
                        menu-props="auto"
                        hide-details
                        label="Select"
                        single-line
                    ></v-select>
                </v-flex>
            </v-card>
        </v-expansion-panel-content>
    </v-expansion-panel>
</template>

<script>
    export default {
        name: "Filters"
    }
</script>

<style scoped>

</style>
