<template>
    <div>
        <div><button @click="newgroup">New</button>
        <ul v-for="group in groups">
            <li><div class="trigger"><span  @click="show(group.id)">{{ group.name }} </span><div class="hidden" @click="destroy(group.id)">X</div></div></li>
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
                setTimeout(this.update,100)
            },
            destroy: function (id) {
                axios.delete('/team/api/group/'+id);
                setTimeout(this.update,500)
            },
            update: function () {
                axios.get('/team/api/group').then((response) => {
                    this.groups = response.data
                });
            },
            show: function(id) {
                this.$router.push({name:'teams', params: {id}});
            }
        }
    }
</script>
<style scoped>
    .trigger {cursor: pointer}
    .hidden { display: none;}
    .trigger:hover .hidden { display: inline; cursor: pointer;}
</style>