<template>
    <div class="card mb-5">
        <div class="card-body">
                <a href="" class="close"><span aria-hidden="true">&times;</span></a>
                <p class="card-text">
                    <!-- v-html is needed in order to parse the HTML for ckeditor -->
                    <span v-html="this.body"></span>
                </p>
            <a :href="'/journal/' + this.id + '/edit'" class="btn btn-secondary btn-small">Edit</a>
            </div>
            <div class="card-footer">
                <small class="text-muted">Written on {{this.created_at}}</small>
            </div>
        </div>
</template>

<script>
export default {
    name: 'journal-entry',
    props: [
        'id',
        'body',
        'created_at'
    ],
    data() {
        return {

        };
    }
}
</script>