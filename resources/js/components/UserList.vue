<template>
    <div class="row">
        <div v-if="$store.getters.getToken" class="col-12 mb-2 text-end">
            <router-link :to='{ name: "userCreate" }' class="btn btn-primary">Create</router-link>
        </div>


                <!-- sidebar -->
                <div class="col-lg-3">
                    <!-- Toggle button -->
                    <button class="btn btn-outline-secondary mb-3 w-100 d-lg-none" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span>Show filter</span>
                    </button>
                    <!-- Collapsible wrapper -->

                    <form @submit.prevent="list">
                        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <div class="col-12">
                                        <div class="input-group float-center">
                                            <div class="form-outline">
                                                <input v-model="search.title" type="search" id="search" class="form-control"
                                                    style="border: solid 1px #ddd ">
                                                <label class="form-label" for="search">Search Book Name</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary shadow-0">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Genre
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div class="">
                                                        <input v-model="search.genre" type="text"
                                                            class="form-control" placeholder="genre" />
                                                        <label class="form-label"></label>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Author
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div class="">
                                                        <input v-model="search.author" type="text"
                                                            class="form-control" placeholder="author" />
                                                        <label class="form-label"></label>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Date Published
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        From
                                                    </p>
                                                    <div class="form-outline">
                                                        <input v-model="search.published_from" type="date"
                                                            class="form-control p-0" />
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        To
                                                    </p>
                                                    <div class="form-outline">
                                                        <input v-model="search.published_to" type="date"
                                                            class="form-control p-0" />
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-white w-100 border border-secondary">Apply
                                                Filters</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <!-- sidebar -->
        <div class="col-9">
            <div class="card">
                <!-- <div class="card-header">
                    <h4>User List View </h4>
                </div> -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="users.data && users.data.length > 0">
                                <tr v-for="(users, key) in users.data" :key="key">
                                    <td>{{ users.id }}</td>
                                    <!-- <td>{{ users.title }}</td>
                                    <td>{{ users.description }}</td> -->
                                    <td>

                                        <div class="btn-group" role="group">
                                            <router-link :to='{ name: "userEdit", params: { id: users.id } }'
                                                class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></router-link>
                                            <button type="button" @click="deleteUser(users.id)"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Users Found for you, Please login as admin to add some users.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Bootstrap5Pagination align="center" :data="users" @pagination-change-page="list" />

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import store from '../auth/state.js';
export default {
    name: "UserList",
    components: {
        // axios
        Bootstrap5Pagination
    },
    data() {
        return {
            users: {
                type: Object,
                default: null
            }
        }
    },
    setup() {
        return {
            search: {
                title: null,
                published_from: null,
                published_to: null,
                genre: null,
                author: null

            }
        }
    },
    mounted() {
        if(store.getters.getToken)
            this.list()
    },
    methods: {
        async list(page = 1) {
            await axios.get(`/api/users?page=${page}`).then(({ data }) => {
                this.users = data;
                console.log(data);
            }).catch(({ response }) => {
                console.log(response)
            })
        },

        deleteUser(id) {
            if (confirm("Are you sure to delete this user?")) {
                this.axios
                    .delete(`/api/users/${id}`)
                    .then(response => {
                        alert("Deleted successfully");
                        // HERE SAVING API REQUEST TO LIST DATA AGAIN BY JUST SPLICE DELETED RECORD
                        // this.list()
                        let i = this.users.data.map(data => data.id).indexOf(id);
                        this.users.data.splice(i, 1);
                    });
            }
        }
    }

}
</script>

<style scoped>
.pagination {
    margin-bottom: 0;
}
</style>
