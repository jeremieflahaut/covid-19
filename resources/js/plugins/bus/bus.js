import Vue from 'vue'

const Bus = new Vue({
    watch: {
        department: function (newdepartment, olddepartment) {
            this.fetchData(newdepartment)
        }
    },
    data() {
        return {
            appTitle: 'Données relatives aux résultats des tests virologiques COVID-19', 
            leftMenu: false,
            datacollection: null,
            departments: [],
            department: null
        }
    },
    computed : {
        ChartTitle() {
            let department = this.departments.find(dep => dep.code === this.department)
            if(department) {
                return department.name
            }            
        },
        lastDate() {
            if(this.datacollection) {
                return _.last(this.datacollection.labels)
            }
            return null
        },
        ratio() {
            let ratio = 0;

            if(this.datacollection) {
                let positifs = _.find(this.datacollection.datasets, {'label':'Positifs'})
                positifs = _.sum(_.slice(positifs.data, positifs.data.length - 7))

                let tests = _.find(this.datacollection.datasets, {'label':'Tests'})
                tests = _.sum(_.slice(tests.data, tests.data.length - 7))

                ratio = _.round(100 * (positifs/tests), 2)
            }

            return ratio
        }
    },
    methods: {
        fetchData(dep = null) {
            let route = dep ? 'tests/' + dep : 'tests'

            this.$http.get(route)
            .then(response => {
                this.datacollection = response.data
            })
            .catch(error => {
                console.log('error', error)
            });
        },
        getDepartments() {
            this.$http.get('departements')
            .then(response => {
                let departments = response.data
                departments.unshift({code: null, name: 'France'})
                this.departments = response.data
            })
            .catch(error => {
                console.log('error', error)
            });
        },
    },
})

export default Bus;
