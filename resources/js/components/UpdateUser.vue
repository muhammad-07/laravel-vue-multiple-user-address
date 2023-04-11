<template>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Update User</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" v-model="user.first_name"
                                :class="{ 'is-invalid': formErrors.first_name }" />
                            <div class="invalid-feedback" v-if="formErrors.first_name">
                                {{ formErrors.first_name[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" v-model="user.last_name"
                                :class="{ 'is-invalid': formErrors.last_name }" />
                            <div class="invalid-feedback" v-if="formErrors.last_name">
                                {{ formErrors.last_name[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" v-model="user.email"
                                :class="{ 'is-invalid': formErrors.email }" />
                            <div class="invalid-feedback" v-if="formErrors.email">
                                {{ formErrors.email[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile_number">Phone</label>
                            <input type="mobile_number" class="form-control" id="mobile_number" v-model="user.mobile_number"
                                :class="{ 'is-invalid': formErrors.mobile_number }" />
                            <div class="invalid-feedback" v-if="formErrors.mobile_number">
                                {{ formErrors.mobile_number[0] }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <h4>Addresses</h4>

                            <button type="button" class="btn btn-primary float-right" @click="addAddress">Add
                                Address</button>
                        </div>
                        <hr />
                        <!-- {{ formErrors["addresses.0.zip_code"][0] }} -->
                        <div class="card mb-3" v-for="(address, index) in user.addresses" :key="index">
                            <div class="card-body">
                                <div class="form-group">
                                    <label :for="'addresses[' + index + '][address_line_1]'">Street Address</label>
                                    <input type="text" class="form-control" :id="'addresses[' + index + '][address_line_1]'"
                                        v-model="address.address_line_1"
                                        :class="{ 'is-invalid': formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].address_line_1 }" />
                                    <div class="invalid-feedback"
                                        v-if="formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].address_line_1">
                                        {{ formErrors.addresses[index].address_line_1[0] }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label :for="'addresses[' + index + '][address_line_2]'">Street Address Line 2</label>
                                    <input type="text" class="form-control" :id="'addresses[' + index + '][address_line_2]'"
                                        v-model="address.address_line_2"
                                        :class="{ 'is-invalid': formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].address_line_2 }" />
                                    <div class="invalid-feedback"
                                        v-if="formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].address_line_2">
                                        {{ formErrors.addresses[index].address_line_2[0] }}
                                    </div>
                                </div>

                                <div class="form row">
                                    <div class="form-group col-md-6">
                                        <label :for="'addresses[' + index + '][city]'">City</label>
                                        <input type="text" class="form-control" :id="'addresses[' + index + '][city]'"
                                            v-model="address.city"
                                            :class="{ 'is-invalid': formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].city }" />
                                        <div class="invalid-feedback"
                                            v-if="formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].city">
                                            {{ formErrors.addresses[index].city[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label :for="'addresses[' + index + '][state]'">State</label>
                                        <input type="text" class="form-control" :id="'addresses[' + index + '][state]'"
                                            v-model="address.state"
                                            :class="{ 'is-invalid': formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].state }" />
                                        <div class="invalid-feedback"
                                            v-if="formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].state">
                                            {{ formErrors.addresses[index].state[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label :for="'addresses[' + index + '][zip_code]'">Zip</label>
                                        <input type="text" class="form-control" :id="'addresses[' + index + '][zip_code]'"
                                            v-model="address.zip_code"
                                            :class="{ 'is-invalid': formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].zip_code }" />
                                        <div class="invalid-feedback"
                                            v-if="formErrors.addresses && formErrors.addresses[index] && formErrors.addresses[index].zip_code">
                                            {{ formErrors.addresses[index].zip_code[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 mt-2">
                                        <h6>Type</h6>
                                        <label :for="'addresses[' + index + '][home]'">Home</label>
                                        <input type="radio" class="form-controlc" :id="'addresses[' + index + '][home]'"
                                            v-model="address.type" :name="'addresses[' + index + '][type]'" value="home" />
                                            &nbsp;
                                        <label :for="'addresses[' + index + '][office]'">Office</label>
                                        <input type="radio" class="form-controlc" :id="'addresses[' + index + '][office]'"
                                            v-model="address.type" :name="'addresses[' + index + '][type]'"  value="office" />

                                    </div>




                                </div>

                                <button type="button" class="btn btn-danger" @click="removeAddress(index)">Remove</button>
                            </div>
                        </div>

                        <!-- {{ formErrors}} -->
                        <li class="text-danger" v-for="(errs, index) in formErrors" :key="index">
                            {{ errs[0] }}
                        </li>

                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "user-update",
    data() {
        return {

            user: {
                id: "",
                first_name: "",
                last_name: "",
                email: "",
                addresses: []
            },
            formErrors: {},
            //   search: ""
        }
    },
    mounted() {
        this.showUser()
    },
    methods: {
        async showUser() {
            await this.axios.get(`/api/users/${this.$route.params.id}`).then(response => {
                console.log(response);
                this.user = response.data;
                this.user._method = "patch"

            }).catch(error => {
                if (error.response.status === 422) {
                    this.formErrors = error.response.data.errors;
                }
                console.log(error)
            })
        },
        async update() {
            await this.axios.post(`/api/users/${this.$route.params.id}`, this.user).then(response => {
                alert('User updated successfullly.');
                // this.$router.push({name:"users"});
                console.log(response);
            }).catch(error => {
                console.log(error);
                if (error.response.status === 422) {
                    alert("validation error: Please fillout all fields properly.");
                    this.formErrors = error.response.data.errors;
                    // alert("error"+);
                }

            })
        },
        addAddress() {
            this.user.addresses.push({
                address_line_1: "",
                address_line_2: "",
                type: "",
                city: "",
                state: "",
                zip_code: ""
            });
        },

        removeAddress(index) {
            this.user.addresses.splice(index, 1);
        }
    }
}
</script>
