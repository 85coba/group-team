<template>
  <div>
    <router-link to="/">⟵ Back</router-link>
    <p>Group: {{ groupName }}</p>
    <p>{{ id }}</p>
    <div class="flex">
      <label>Team:</label>
      <input class="input" type="text" v-model="teamToDB.teamName" required>
      <button :disabled="isAdd" @click="createTeam">Add</button>
    </div>
    <div class="flex-label">Teams:</div>
    <ol>
      <li class="item" v-for="team in teams">
        <span class="xclose" v-if="isPoints(team.name)" @click="destroy(team.id)">⤫</span>
        {{team.name}}
      </li>
    </ol>
    <div>
      <div>
        <div class="flex-label">
          Teams:
          <button class="btn-info" @click="createMatches" :disabled="isCreateMatches">Generate</button>
        </div>
      </div>
      <div class="flex" v-if="matches.length > 0">
        <table>
          <tr v-for="match in matches">
            <th>{{ match.team1 }}</th>
            <th>
              <input
                class="match-input"
                type="text"
                v-model="match.team1_point"
                @change="updatePoints(1, match.team1_point, match.id)"
              >
            </th>
            <th>:</th>
            <th>
              <input
                class="match-input"
                type="text"
                v-model="match.team2_point"
                @change="updatePoints(2, match.team2_point, match.id)"
              >
            </th>
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
      groupName: this.$route.params.name,
      teams: [],
      matches: [],
      teamToDB: {
        groupID: this.$route.params.id,
        teamName: ""
      }
    };
  },
  computed: {
    isGames: function() {
      let isGames = this.matches.some(match => {
        return match.team1_point != 0 || match.team2_point != 0;
      });
      return isGames;
    },
    isAdd: function() {
      return this.isGames ? true : this.teamToDB.teamName == "";
    },
    isCreateMatches: function() {
      return this.isGames ? true : this.teams.length < 2 ? true : false;
    }
  },
  mounted() {
    axios.get("/team/api/group/" + this.id).then(response => {
      this.teams = response.data.teams;
      this.matches = response.data.matches;
      this.groupName = response.data.groupName;
      this.id = response.data.groupID;
    });
  },
  methods: {
    isPoints: function(teamName) {
      let b = this.matches.some(match => {
        return (
          (match.team1 == teamName || match.team2 == teamName) &&
          (match.team1_point > 0 || match.team2_point > 0)
        );
      });
      return !b;
    },
    createTeam: function() {
      let b = this.teams.some(team => {
        return team.name == this.teamToDB.teamName;
      });
      if (!b) {
        axios.post("/team/api/group/" + this.id + "/teams", this.teamToDB);
        setTimeout(this.update, 100);
      }
    },
    destroy: function(team) {
      axios.delete("/team/api/group/" + this.id + "/teams/" + team);
      setTimeout(this.update, 100);
    },
    createMatches: function() {
      let request = { groupID: this.id };
      axios
        .post("/team/api/group/" + this.id + "/matches", request)
        .then(response => {
          this.matches = response.data;
        });
    },
    updatePoints: function(teamNum, point, matchID) {
      let request = { team: teamNum, point: point };
      axios.put("/team/api/group/" + this.id + "/matches/" + matchID, request);
    },
    update: function() {
      axios.get("/team/api/group/" + this.id).then(response => {
        this.teams = response.data.teams;
        this.matches = response.data.matches;
        this.groupName = response.data.groupName;
        this.id = response.data.groupID;
      });
    }
  }
};
</script>

<style scoped>
</style>