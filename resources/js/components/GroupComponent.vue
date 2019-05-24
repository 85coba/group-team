<template>
    <div>
        <div><button @click="newgroup">New</button>
        <ul v-for="group in groups">
            <li><div class="trigger"><span  @click="show(group.id,group.name)">{{ group.name }} </span><div class="hidden" @click="destroy(group)">X</div></div></li>
        </ul></div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                groups: [],
            }
        },
        mounted() {
            axios.get('/team/api/group').then((response) => {
                this.groups = response.data
            });
        },
        name: "GroupComponent",
        methods: {
            newgroup: function () {
                axios.post('/team/api/group');
                setTimeout(this.update, 100)
            },
            destroy: function (group) {
                axios.delete('/team/api/group/' + group.id);
                this.groups.splice(this.groups.indexOf(group),1);
            },
            update: function () {
                axios.get('/team/api/group').then((response) => {
                    this.groups = response.data
                });
            },
            show: function(id,name) {
                this.$router.push({name:'teams', params: {id,name}});
            }
        }
    }
</script>
<style scoped>
    .trigger {cursor: pointer}
    .hidden { display: none;}
    .trigger:hover .hidden { display: inline; cursor: pointer;}
</style>