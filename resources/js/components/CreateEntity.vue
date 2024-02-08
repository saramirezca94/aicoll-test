<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">New Entity</div>
                <div class="card-body">
                    <label for="entity_name">Name</label>
                    <input
                      id="entity_name"
                      v-model="name"
                      type="text"
                      name="entity_name"
                      class="form-control"
                    >
                    <label for="entity_address">Address</label>
                    <input
                      id="entity_address"
                      v-model="address"
                      type="text"
                      name="entity_address"
                      class="form-control"
                    >
                    <label for="entity_phone">Phone</label>
                    <input
                      id="entity_phone"
                      v-model="phone"
                      type="text"
                      name="entity_phone"
                      class="form-control"
                    >
                    <label for="entity_phone">Nit</label>
                    <input
                        id="entity_nit"
                        v-model="nit"
                        type="text"
                        name="entity_nit"
                        class="form-control"
                    >
                <div class="mt-2">
                    <button class="btn btn-info" @click="saveEntity()">
                        Save
                    </button>
                    <a class="btn btn-success" href="/">
                        Return to index
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import toastr from 'toastr';
    import 'toastr/toastr.scss';

    export default {
        data() {
            return {
                nit: '',
                name: '',
                phone: '',
                address: ''
            };
        },
        methods: {
            saveEntity()
            {   
                axios
                    .post('/api/entity',
                        {
                            name : this.name,
                            address : this.address,
                            phone : this.phone,
                            nit: this.nit
                        }, 
                        {
                            headers: {
                                'Content-Type': 'application/json',
                        },
                    })
                    .then((response) => {
                        toastr.success(response.data.message, 'Success');
                        this.name = '',
                        this.address = '',
                        this.phone = '',
                        this.nit = ''
                    })
                    .catch((error) => {
                        if (error.response) {
                            toastr.error(error.response.data.message, 'Error')
                        }
                        
                        if (axios.isCancel(error)) {
                            return;
                        }
                    });
            }
        }
    }
</script>