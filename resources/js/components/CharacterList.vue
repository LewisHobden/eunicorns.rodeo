<template>
<div>
    <div class="card">
        <div class="card-header">Players</div>
        <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
            <div class="card" v-for="user in list" :key="user.id">
                <div class="card-header">{{ user.user.name }}</div>
                <ul class="list-group">
                    <draggable v-model="user.characters" group="people" item-key="id">
                        <template #item="{element}">
                            <div :class="getCharacterClasses(element)">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-2">
                                        <img :src="element.class_icon" class="class-icon" alt="Class Icon" />
                                        <b>{{ element.character_name }}</b>
                                    </div>
                                    <p>{{ element.item_level }}</p>
                                </div>
                            </div>
                        </template>
                    </draggable>
                </ul>
            </div>
        </div>
    </div>

    <hr />

    <div class="card">
        <div class="card-header">Groups</div>
        <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
            <div class="card" v-for="group in signupGroups" :key="group.group.id">
                <div class="card-header">{{ group.group.group_name }}</div>
                <div class="card-body">
                    Drag and drop signups here to add them to the group.
                </div>
                <ul class="list-group">
                <draggable v-model="group.signups" group="people" item-key="id">
                    <template #item="{element}">
                        <div :class="getCharacterClasses(element)">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                    <img :src="element.class_icon" class="class-icon" alt="Class Icon" />
                                    <b>{{ element.character_name }}</b>
                                </div>
                                <p>{{ element.item_level }}</p>
                            </div>
                        </div>
                    </template>
                </draggable>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" v-on:click="onChange">Save</a>
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
            let response = await axios.post('/events/occurrences/'+this.occurrenceId+'/assign',
                { 'groups': this.signupGroups, 'signups': this.list }
            );

            this.signupGroups = response.data['groups'];
            this.list = response.data['players'];

            console.log(response);
        },
        getCharacterClasses: function(character) {
            let classes = "character list-group-item";

            if (character.warnings.length > 0) {
                classes += " list-group-item-warning";
            } else {
                classes += " list-group-item-primary";
            }

            return classes;
        }
    }
}
</script>

<style scoped>
    .class-icon {
        height: 30px;
        width: auto;
    }

    .character {
        cursor: grab;
    }
</style>
