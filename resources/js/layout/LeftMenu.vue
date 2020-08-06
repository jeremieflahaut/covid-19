<template>
    <v-navigation-drawer v-model="$bus.leftMenu" color="primary" clipped app dark>
        <v-list>
            <v-list-item v-for="item in items" :key="item.title" :to="item.link" link>
                <v-list-item-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    name: 'Left-menu',

    data () {
      return {
        items: [
          { title: 'Accueil', icon: 'fas fa-home', link: '/'},
          { title: 'Tests Covid-19', icon: 'fas fa-poll', link: 'tests' },
        ],
      }
    },
}
</script>