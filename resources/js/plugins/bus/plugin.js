import Bus from './bus'

const configDefaults = {
    data() {return {}},
    computed: {},
    methods: {}
}

const install = (vue, config = {}) => {
    // Install only one time
    if (install.installed) {
        return
    }
    install.installed = true

    // Set $uploads with Bus
    vue.prototype.$bus = Bus
}

// Set Install bool to false
install.installed = false

// Create plugin
const plugin = {
    install: install
}

// Add Plugin to vue if it was already declared
if (typeof window !== 'undefined' && window.Vue) {
    window.Vue.use(plugin);
}

export default plugin
