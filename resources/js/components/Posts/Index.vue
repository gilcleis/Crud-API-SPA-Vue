<template>
    <div>
        <div class="row justify-content-between pb-4"></div>
        <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="#" @click.prevent="change_sort('title')">Título</a>
                    <span v-if="this.params.sort_field == 'title' && this.params.sort_direction == 'asc'">&uarr;</span>
                    <span v-if="this.params.sort_field == 'title' && this.params.sort_direction == 'desc'">&darr;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('post_text')">Texto</a>
                    <span v-if="this.params.sort_field == 'post_text' && this.params.sort_direction == 'asc'">&uarr;</span>
                    <span v-if="this.params.sort_field == 'post_text' && this.params.sort_direction == 'desc'">&darr;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('created_at')">Criado em:</a>
                    <span v-if="this.params.sort_field == 'created_at' && this.params.sort_direction == 'asc'">&uarr;</span>
                    <span v-if="this.params.sort_field == 'created_at' && this.params.sort_direction == 'desc'">&darr;</span>
                </th>
                <th>Ação</th>
            </tr>
   
        </thead>
        <tbody>
            <tr v-for="post in posts.data">
                <td>{{ post.title }}</td>
                <td>{{ post.post_text.substring(0, 60) }}</td>
                <td>{{ post.created_at | formatDate }}</td>
            
                <td>
                    <router-link class="btn btn-info btn-sm"
                                 :to="{ name: 'posts.edit', params: { id: post.id } }">Editar</router-link>
                    <button @click="delete_post(post.id)" class="btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
        </tbody>
    </table>

    <pagination :data="posts" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: {},
                categories: {},
                params: {
                    category_id: '',
                    sort_field: 'created_at',
                    sort_direction: 'desc',
                    title: '',
                    post_text: '',
                    created_at: ''
                },
                search: ''
            }
        },
        mounted() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                });
            this.getResults();
        },
        watch: {
            params: {
                handler () {
                    this.getResults();
                },
                deep: true
            },
            search (val, old) {
                if (val.length >= 4 || old.length >= 4) {
                    this.getResults();
                }
            }
        },
        methods: {
            change_sort(field) {
                if (this.params.sort_field === field) {
                    this.params.sort_direction = this.params.sort_direction === 'asc' ? 'desc' : 'asc';
                } else {
                    this.params.sort_field = field;
                    this.params.sort_direction = 'asc';
                }
            },
            getResults(page = 1) {
                axios.get('/api/posts', {
                    params: {
                        page,
                        search: this.search.length >= 3 ? this.search : '',
                        ...this.params
                    }
                })
                    .then(response => {
                        this.posts = response.data;
                    });
            },
             moment: function () {
                return moment();
            },

            delete_post(post_id) {
                this.$swal({
                    title: 'Tem certeza que deseja excluir?',
                    text: "Não será mais possivel reverter!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Sim, Exclua!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/posts/' + post_id)
                            .then(response => {                                
                                this.$swal({title:'Excluido com sucesso!',icon: 'success'});
                                this.getResults();
                            }).catch(error => {
                            this.$swal({ icon: 'error', title: 'Error happened'});
                        });
                    }
                })
            }
        }
    }
</script>
