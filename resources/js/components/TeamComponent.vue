<template>
    <div>
        <p><router-link to="/">Back</router-link></p>
            <label>Team: </label>
            <input type="text" v-model="teamToDB.teamName" required>
            <button @click="createTeam">Add</button>
        <ol v-for="team in teams">
            <li>{{team.name}} <span class="pointer" @click="destroy(team.id)">X</span></li>
        </ol>
    </div>
</template>

<script>
    export default {
        name: "TeamComponent",
        data: function() {
            return {
                id: this.$route.params.id,
                teams: [],
                teamToDB: {
                    groupID: this.$route.params.id,
                    teamName: '',
                }
            }
        },
        mounted() {
            this.id = this.$route.params.id;
            axios.get('/team/api/group/' + this.id).then((response) => {
                this.teams = response.data
            });
        },
        methods: {
            createTeam: function() {
                let b = this.teams.some((team) => {
                    return team.name == this.teamToDB.teamName
                });
                if (!b) {
                    axios.post('/team/api/group/' + this.id + '/teams', this.teamToDB);
                    setTimeout(this.update, 100)
                }
            },
            destroy: function(team) {
                let group = this.id;
                axios.delete('/team/api/group/'+group+'/teams/'+team);
                setTimeout(this.update,100)
            },
            update: function () {
                axios.get('/team/api/group/' + this.id).then((response) => {
                    this.teams = response.data
                });
            }

        }
    }
</script>

<style scoped>
.pointer {
    cursor: pointer;
}
</style>