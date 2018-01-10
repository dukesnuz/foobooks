<template>
    <div>
        <h1>Items</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <!--<router-link :to="{ name: 'CreateItem' }" class="btn btn-primary">Create Item</router-link>-->
          </div>
        </div><br />
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Title</td>

                <!-- <td>Item Name</td>
                <td>Item Price</td>
                <td>Actions</td> -->
            </tr>
            </thead>
            <tbody>
                <tr v-for="book in books">
                    <td>{{ book.title }}</td>

                    <!--<td>{{ item.name }}</td>
                    <td>{{ item.price }}</td>
                    <td><router-link :to="{name: 'EditItem', params: { id: item.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" v-on:click="deleteItem(item.id)">Delete</button></td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                books: []
            }
        },
        created: function()
        {
            this.fetchBooks();
        },
        methods: {
            fetchBooks()
            {
              let uri = `http://foobooks.loc/getbooks`;
              this.axios.get(uri).then((response) => {
              this.books = response.data;
              });
            },
        }
    }
</script>
