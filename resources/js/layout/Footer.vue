<template>
    <v-footer color="primary" padless dark>
        <v-card tile width="100%" class="primary text-center">
            <v-card-text class="py-2">
                <v-btn icon class="mx-" v-for="btn in btns" :key="btn.name" :href="btn.href" :target="btn.target">
                    <v-icon size="24px">{{ btn.icon }}</v-icon>
                </v-btn> 
            </v-card-text>
            <v-divider class="my-0"></v-divider>
            <v-card-text class="primary lighten-1 white--text">
                <div>
                    <v-btn @click.stop="dialog = true" text x-small>Mentions légales</v-btn>
                </div>
                <v-dialog v-model="dialog" max-width="290">
                    <v-card>
                        <v-card-title class="headline">Mentions légales</v-card-title>
                        <v-card-text>
                            Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.
                        </v-card-text>
                    </v-card>
                </v-dialog>

                <strong>Jérémie Flahaut &copy; {{ new Date().getFullYear() }}</strong>
            </v-card-text>
        </v-card>
    </v-footer>
</template>
<script>

export default {
    name: 'Footer',

    data() {
        return {
            btns: [
                { name: 'linkedin', icon: 'fab fa-linkedin-in', href: 'https://www.linkedin.com/in/jeremie-flahaut', target: '_blank'},
                { name: 'github', icon: 'fab fa-github', href: 'https://github.com/jeremieflahaut/covid-19', target: '_blank'},
            ],
            dialog: false,
        }
    }
}

</script>