<template>
    <div class="card mb-5">
        <div class="card-body">
            <!-- Button to trigger delete confirmation modal -->
            <button
                v-on:click="postIdToDelete = entry.id"
                type="button"
                class="close"
                data-toggle="modal"
                data-target="#deleteModal"
            >
                <span aria-hidden="true">&times;</span>
            </button>
            <p class="card-text">
                <!-- v-html is needed in order to parse the HTML for ckeditor -->
                <span v-html="entry.body"></span>
            </p>
            <a
                :href="'/journal/' + entry.id + '/edit'"
                class="btn btn-small btn-secondary"
                >Edit</a
            >
        </div>
        <div class="card-footer">
            <small class="text-muted">Written on {{ entry.created_at }}</small>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        entry: Object
    },

    data() {
        return {};
    },

    mounted() {

    }
};
</script>
