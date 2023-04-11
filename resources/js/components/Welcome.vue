<template>
    <section class="">
        <div class="container">
            <div class="row">
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
                                                <input v-model="search.query" type="search" id="search" class="form-control"
                                                    style="border: solid 1px #ddd ">
                                                <label class="form-label" for="search">Search Name</label>
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
                                            City
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div class="">
                                                <input v-model="search.city" type="text" class="form-control"
                                                    placeholder="city" />
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
                                            Age
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
                                                    <div class="">
                                                        <input v-model="search._from" type="number"
                                                            class="form-control p-0" />
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        To
                                                    </p>
                                                    <div class="">
                                                        <input v-model="search._to" type="number"
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
                <!-- content -->
                <div class="col-lg-9">
                    <!-- {{ users }} -->
                    <!-- <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
                        <strong v-if="users && users.data.length > 0" class="d-block py-2">{{ users.data.length }}
                            Results(s) found </strong>

                    </header> -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile/Email</th>
                                    <th>Birthdate</th>
                                    <th>City</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.first_name }}</td>
                                    <td>{{ user.last_name }}</td>
                                    <td>{{ user.email }}<br/>{{ user.mobile_number }}</td>
                                    <td>{{ user.birthdate }}</td>
                                    <td>
                                        <div class="mb-3" v-for="(address, index) in user.addresses" :key="index">
                                            <!-- <strong>Address #{{ index+1 }}</strong>({{ address.type }})<br/>
                                            {{ address.address_line_1 }}<br/>
                                            {{ address.address_line_2 }}<br/> -->
                                            <strong>Address #{{ index+1 }} city: </strong>{{ address.city }}<br/>
                                            <!-- ,{{ address.state }},{{ address.zip_code }} -->
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <router-link :to='{ name: "userEdit", params: { id: user.id } }'
                                                class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></router-link>
                                            <button type="button" @click="deleteUser(user.id)"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <Bootstrap5Pagination align="center" :data="users" @pagination-change-page="list" />

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
export default {
    name: "Welcome",
    components: {
        // axios
        Bootstrap5Pagination
    },
    setup() {
        return {
            search: {
                query: null,
                _from: null,
                _to: null,
                city: null,

            }
        }
    },
    data() {
        return {
            users: {
                type: Object,
                default: null
            },

        }
    },
    mounted() {
        this.list()
    },
    methods: {
        async list(page = 1) {
            await axios.post(`/api/users/list?page=${page}`, this.search).then(({ data }) => {
                console.log(data);
                this.users = data;

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
