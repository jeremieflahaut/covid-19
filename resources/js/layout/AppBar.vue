<template>
    <v-app-bar clipped-left app color="primary" dark>
        <v-app-bar-nav-icon @click.stop="$bus.leftMenu = !$bus.leftMenu"></v-app-bar-nav-icon>
        <v-toolbar-title>{{ $bus.appTitle }}</v-toolbar-title>
    </v-app-bar>
</template>
<script>

export default {
    name: 'App-bar',
}

</script>