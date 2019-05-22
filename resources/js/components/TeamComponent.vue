<template>
    <div>
        <p><router-link to="/">Back</router-link></p>
            <label>Team: </label>
            <input type="text" v-model="teamToDB.teamName" required>
            <button @click="createTeam">Add</button>
        <ol v-for="team in teams">
            <li>{{team.name}} <span class="pointer" @click="destroy(team.id)">X</span></li>
        </ol>
        <div>
            <button @click="createMatches" :disabled="teams.length < 2 ? true : false">Generate</button>
            <div v-if="matches.length > 0">
                <table>
                    <tr v-for="match in matches">
                        <th>{{ match.team1 }}</th>
                        <th><input type="text" :value="match.team1_point"></th>
                        <th>{{ match.team2 }}</th>
                        <th><input type="text" :value="match.team2_point"></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TeamComponent",
        data: function() {
            return {
                id: this.$route.params.id,
                teams: [],
                matches: [],
                teamToDB: {
                    groupID: this.$route.params.id,
                    teamName: '',
                }
            }
        },
        mounted() {
            this.id = this.$route.params.id;
            axios.get('/team/api/group/' + this.id).then((response) => {
                this.teams = response.data.teams;
                this.matches = response.data.matches;
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
            createMatches: function() {
                let request = {groupID : this.id};
                axios.post('/team/api/group/' + this.id + '/matches', request);
                setTimeout(this.update,200)
            },
            update: function () {
                this.id = this.$route.params.id;
                axios.get('/team/api/group/' + this.id).then((response) => {
                    this.teams = response.data.teams;
                    this.matches = response.data.matches;
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