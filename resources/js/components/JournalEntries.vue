<template>
    <div>
        <journal-entry
            :entry="entry"
            v-for="entry in this.entries"
            :key="entry.id"
        ></journal-entry>

        <!-- Delete Confirmation Modal -->
        <div
            class="modal fade"
            id="deleteModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="deleteModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">
                            Delete this journal entry?
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-dark"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <form
                            :action="'/journal/' + postIdToDelete"
                            method="POST"
                        >
                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            />
                            <input type="hidden" name="_token" :value="csrf" />
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        entries: Array
    },

    data() {
        return {
            // Post ID for delete confirmation modal
            postIdToDelete: "",

            //CSRF token
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },

    mounted: function() {
        //console.log(this.entries);
    },

    methods: {}
};
</script>
