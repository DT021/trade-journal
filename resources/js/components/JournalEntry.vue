<template>
    <div>

    <div class="card mb-5">
        <div class="card-body">
            <!-- Button to trigger delete confirmation modal -->
            <button type="button" class="close" data-toggle="modal" data-target="#deleteModal"><span aria-hidden="true">&times;</span></button>
            <p class="card-text">
                <!-- v-html is needed in order to parse the HTML for ckeditor -->
                <span v-html="this.body"></span>
            </p>
            <a :href="'/journal/' + this.id + '/edit'" class="btn btn-small btn-secondary">Edit</a>
        </div>
        <div class="card-footer">
            <small class="text-muted">Written on {{this.created_at}}</small>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete this journal entry?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>
export default {
    props: [
        'id',
        'body',
        'created_at'
    ],

    data() {
        return {

        };
    },
    methods: {
        deleteEntry: function() {
            this.$emit('deleteJournalEntry', this.id);
        }
    }

}
</script>