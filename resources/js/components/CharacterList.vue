<template>
<div>
    <div class="card">
        <div class="card-header">Players</div>
        <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
            <div class="card" v-for="user in list" :key="user.id">
                <div class="card-header">{{ user.user.name }}</div>
                <ul class="list-group">
                    <draggable v-model="user.characters" group="people" item-key="id" @change="onChange">
                        <template #item="{element}">
                            <div class="list-group-item">
                                {{ element.character_name }}
                            </div>
                        </template>
                    </draggable>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Groups</div>
        <div v-for="group in signupGroups" :key="group.group.id">
            <div class="card-header">{{ group.group.group_name }}</div>
            <div class="card-body">
                Drag and drop signups here to add them to the group.
            </div>
            <ul class="list-group">
            <draggable v-model="group.signups" group="people" item-key="id" @change="onChange">
                <template #item="{element}">
                    <div class="list-group-item">
                        {{ element.character_name }}
                    </div>
                </template>
            </draggable>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from "axios";

export default {
    name: "CharacterList",
    components: {
        draggable
    },
    props: {
        'occurrenceId': Number,
        'groups': Object,
        'signups': Object
    },
    data: function () {
        return {
            signupGroups: this.groups,
            list: this.signups
        }
    },
    methods: {
        onChange: async function(variable) {
            let response = axios.post('/events/occurrences/'+this.occurrenceId+'/assign',
                { 'groups': this.signupGroups, 'signups': this.list }
            );

            console.log(response);
        }
    }
}
</script>

<style scoped>

</style>
