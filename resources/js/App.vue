<template>
    <section class="p-2" style="background-color: #eee;">
        <h3 class="text-center">Books</h3>
        <div class="container py-2">
            <div class="row mb-3 p-1">
                <div v-for="book in books.data" v-bind:key="book.id" class="col-md-3 d-flex">
                    <div class="m-3 card">
                        <img v-bind:src="book.image_url" v-bind:alt="book.title" style="height:200px; width:200px;">
                        <div>
                            <h5 v-html="book.title" class="text-center mt-2"></h5>
                            <span>
                                <p v-html="book.author" class="text-center"></p>
                                <button type="button" class="btn btn-primary w-100">View</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-evenly mt-2" v-if="books.meta">
                <div><button class="btn btn-primary" v-if="books.links.prev"
                        v-on:click="fetchBooks(books.meta.current_page - 1)">Previous</button></div>
                <div>
                    <button class="btn mx-1" v-for="n in books.meta.last_page" v-bind:key="n" v-on:click="fetchBooks(n)"
                        v-bind:class="{ 'btn-primary': books.meta.current_page == n }">{{ n }}</button>
                </div>
                <div><button class="btn btn-primary" v-if="books.links.next"
                        v-on:click="fetchBooks(books.meta.current_page + 1)">Next</button></div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            books: [],
            api: 'http://127.0.0.1:8000/api/v1'
        };
    },
    mounted() {
        this.fetchBooks();
    },
    methods: {
        fetchBooks(page) {
            if (page) {
                axios.get(this.api + "/books?page=" + page).then(response => (this.books = response.data)).finally(() => this.loading = false);
            } else {
                axios.get(this.api+"/books").then(response => (this.books = response.data)).finally(() => this.loading = false);
            }
        }
    }
};
</script>