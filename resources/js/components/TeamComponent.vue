<template>
    <div>
        <p><router-link to="/">Back</router-link></p>
            <label>Team: </label>
            <input type="text" v-model="teamToDB.teamName" required>
            <button @click="createTeam">Add</button>
        <ol>
            <li v-for="team in teams">{{team.name}} <span v-if="isPoints(team.name)" class="pointer" @click="destroy(team.id)">X</span></li>
        </ol>
        <div>
            <button @click="createMatches" :disabled="teams.length < 2 ? true : false">Generate</button>
            <div v-if="matches.length > 0">
                <table>
                    <tr v-for="match in matches">
                        <th>{{ match.team1 }}</th>
                        <th><input type="text" v-model="match.team1_point" @change="updatePoints(1, match.team1_point, match.id)"></th>
                        <th> : </th>
                        <th><input type="text" v-model="match.team2_point" @change="updatePoints(2, match.team2_point, match.id)"></th>
                        <th>{{ match.team2 }}</th>
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
            isPoints: function (teamName) {
                let b = this.matches.some((match) =>{
                  return (match.team1 == teamName && match.team1_point > 0) || (match.team2 == teamName && match.team2_point > 0);
                });
                return !b;
            },
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
                axios.post('/team/api/group/' + this.id + '/matches', request).then((response) => {this.matches = response.data});
                setTimeout(this.update, 200)
            },
            updatePoints: function(teamNum, point, matchID) {
                let request = {team: teamNum, point: point};
                axios.put('/team/api/group/'+ this.id + '/matches/' + matchID, request);
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