<template>
    <section class="p-2" style="background-color: #eee;">
        <div class="d-flex justify-content-between container">
            <div class="d-flex">
                <h3 class="text-center">Books</h3>
            </div>
            <span class="d-flex">
                <input type="text" class="form-control form-control-sm" placeholder="Enter keyword" v-model="keyword">
                <button class="btn btn-sm btn-success mx-2" @click="searchBooks(keyword)">Search</button>
            </span>
        </div>
        <div class="container py-2">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="my-2">Filters <button class="btn btn-sm btn-danger" @click="clearFilters()">Clear</button></h5>
                    <div class="form-group mt-2">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="title">
                    </div>
                    <div class="form-group mt-2">
                        <label>Author</label>
                        <input type="text" class="form-control" v-model="author">
                    </div>
                    <div class="form-group mt-2">
                        <label>Genre</label>
                        <input type="text" class="form-control" v-model="genre">
                    </div>
                    <div class="form-group mt-2">
                        <label>ISBN</label>
                        <input type="text" class="form-control" v-model="isbn">
                    </div>
                    <div class="form-group mt-2">
                        <label>Published</label>
                        <input type="date" class="form-control" v-model="published">
                    </div>
                    <div class="form-group mt-2">
                        <label>Publisher</label>
                        <input type="text" class="form-control" v-model="publisher">
                    </div>

                    <button class="btn btn-primary w-100 mt-2" @click="fetchBooks()">Filter</button>
                </div>
                <div class="col-md-9" v-if="!bookView">
                    <div class="row mb-3 p-1">
                        <div v-for="book in books.data" v-bind:key="book.id" class="col-md-3 d-flex">
                            <div class="m-3 card">
                                <img v-bind:src="book.image_url" v-bind:alt="book.title" style="height:200px;">
                                <div>
                                    <h5 v-html="book.title" class="text-center mt-2"></h5>
                                    <span>
                                        <p v-html="book.author" class="text-center"></p>
                                        <button type="button" class="btn btn-primary w-100" @click="viewBook(book.id)">View</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div v-if="keyword">
                            <div class="d-flex justify-content-evenly mt-2" v-if="books.meta">
                                <div><button class="btn btn-primary" v-if="books.links.prev"
                                        v-on:click="searchBooks(keyword, books.meta.current_page - 1)">Previous</button></div>
                                <div>
                                    <button class="btn mx-1" v-for="n in books.meta.last_page" v-bind:key="n"
                                        v-on:click="searchBooks(keyword, n)"
                                        v-bind:class="{ 'btn-primary': books.meta.current_page == n }">{{ n }}</button>
                                </div>
                                <div><button class="btn btn-primary" v-if="books.links.next"
                                        v-on:click="searchBooks(keyword, books.meta.current_page + 1)">Next</button></div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="d-flex justify-content-evenly mt-2" v-if="books.meta">
                                <div><button class="btn btn-primary" v-if="books.links.prev"
                                        v-on:click="fetchBooks(books.meta.current_page - 1)">Previous</button></div>
                                <div>
                                    <button class="btn mx-1" v-for="n in books.meta.last_page" v-bind:key="n"
                                        v-on:click="fetchBooks(n)" v-bind:class="{ 'btn-primary': books.meta.current_page == n }">{{
                                            n }}</button>
                                </div>
                                <div><button class="btn btn-primary" v-if="books.links.next"
                                        v-on:click="fetchBooks(books.meta.current_page + 1)">Next</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 mt-4 row" v-if="bookView">
                    <div class="col-md-6 p-5">                        
                        <img v-bind:src="bookImage">
                    </div>
                    <div class="col-md-6 p-4">
                        <button class="my-2 btn btn-sm btn-secondary" @click="bookView=false">Go Back</button>
                        <table class="table table-stripted">
                            <tr>
                                <th>Title</th>
                                <td>{{ bookTitle }}</td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>{{ bookAuthor }}</td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td>{{ bookGenre }}</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>{{ bookIsbn }}</td>
                            </tr>
                            <tr>
                                <th>Published</th>
                                <td>{{ bookPublished }}</td>
                            </tr>
                            <tr>
                                <th>Publisher</th>
                                <td>{{ bookPublisher }}</td>
                            </tr>
                        </table>
                        
                    </div>
                    <p class="p-5">{{ bookDescription }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            keyword: '',
            title: '',
            author: '',
            genre: '',
            isbn: '',
            published: '',
            publisher: '',

            bookView: false,
            bookImage: '',
            bookTitle: '',
            bookAuthor: '',
            bookGenre: '',
            bookDescription: '',
            bookIsbn: '',
            bookPublished: '',
            bookPublisher: '',
            
            books: [],
            api: 'http://127.0.0.1:8000/api/v1'
        };
    },
    mounted() {
        this.fetchBooks();
    },
    methods: {
        fetchBooks(page) {
            this.keyword = '';
            if (page) {
                axios.get(this.api + "/books?filter[title]=" + this.title + "&filter[author]=" + this.author + "&filter[genre]=" + this.genre + "&filter[isbn]=" + this.isbn + "&filter[published]=" + this.published + "&filter[publisher]=" + this.publisher +"&page="+page).then(response => (this.books = response.data));
            } else {
                axios.get(this.api + "/books?filter[title]=" + this.title + "&filter[author]=" + this.author + "&filter[genre]=" + this.genre + "&filter[isbn]=" + this.isbn + "&filter[published]=" + this.published + "&filter[publisher]=" + this.publisher).then(response => (this.books = response.data));
            }
        },
        searchBooks(keyword, page) {
            if (keyword) {
                if (page) {
                    axios.get(this.api + "/books/search/" + keyword + "?page=" + page).then(response => (this.books = response.data));
                } else {
                    axios.get(this.api + "/books/search/" + keyword).then(response => (this.books = response.data));
                }
            } else {
                axios.get(this.api + "/books").then(response => (this.books = response.data));
            }
        },
        viewBook(id){
            axios.get(this.api + "/books/" + id).then((response) => {
                this.bookImage = response.data.data.image_url;
                this.bookTitle =  response.data.data.title;
                this.bookAuthor =  response.data.data.author;
                this.bookGenre =  response.data.data.genre;
                this.bookDescription =  response.data.data.description;
                this.bookIsbn =  response.data.data.isbn;
                this.bookPublished =  response.data.data.published;
                this.bookPublisher =  response.data.data.publisher;
                this.bookView = true;
            });
        },
        clearFilters(){
            this.keyword = '';
            this.title = '';
            this.author = '';
            this.genre = '';
            this.isbn = '';
            this.published = '';
            this.publisher = '';
            axios.get(this.api + "/books").then(response => (this.books = response.data));
        }
    }
};
</script>