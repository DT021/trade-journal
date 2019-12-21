<template>
<div>
    <div class="card mb-5" v-for="entry in this.entries" v-bind:key="entry.id">
        <div class="card-body">
            <!-- Button to trigger delete confirmation modal -->
            <button v-on:click="postIdToDelete = entry.id" type="button" class="close" data-toggle="modal" data-target="#deleteModal"><span aria-hidden="true">&times;</span></button>
            <p class="card-text">
                <!-- v-html is needed in order to parse the HTML for ckeditor -->
                <span v-html="entry.body"></span>
            </p>
            <a :href="'/journal/' + entry.id + '/edit'" class="btn btn-small btn-secondary">Edit</a>
        </div>
        <div class="card-footer">
            <small class="text-muted">Written on {{entry.created_at}}</small>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete this journal entry?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
            <form :action="'/journal/' + postIdToDelete" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            
        </div>
        </div>
    </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
    props: ['meta'],

    data() {
        return {
            // Contains all journal entries for the user
            entries: this.meta.data,

            // Post ID for delete confirmation modal
            postIdToDelete:  '',

            //CSRF token
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
    },

    methods: {

    }
};
</script>
