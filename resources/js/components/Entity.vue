<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Entity # {{ entity.id }}</div>
                <div class="card-body">
                    <label for="entity_name">Name</label>
                    <input
                      id="entity_name"
                      v-model="entity.name"
                      type="text"
                      name="entity_name"
                      class="form-control"
                    >
                    <label for="entity_address">Address</label>
                    <input
                      id="entity_address"
                      v-model="entity.address"
                      type="text"
                      name="entity_address"
                      class="form-control"
                    >
                    <label for="entity_phone">Phone</label>
                    <input
                      id="entity_phone"
                      v-model="entity.phone"
                      type="text"
                      name="entity_phone"
                      class="form-control"
                    >
                    <label for="entity_phone">Nit</label>
                    <input
                        disabled
                        id="entity_nit"
                        v-model="entity.nit"
                        type="text"
                        name="entity_nit"
                        class="form-control"
                    >
                <div class="mt-2">
                    <button class="btn btn-info" @click="updateEntity()">
                        Update
                    </button>
                    <button class="btn btn-danger" @click="deleteEntity()">
                        Delete
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
        created() {
            this.getEntity();
        },
        props: {
            entityId: {
                type: String,
                required: true
            }    
        },
        data() {
            return {
                entity: {}
            };
        },
        methods: {
            getEntity()
            {
                axios
                    .get('/api/entity/' + this.entityId)
                    .then((response) => {
                        this.entity = response.data[0];
                    })
                    .catch((e) => {
                        if (axios.isCancel(e)) {
                            return;
                        }
                    if (e.response) {
                        e.response.data.message;
                    }
                });
            },
            updateEntity()
            {   
                axios
                    .patch('/api/entity/' + this.entityId,
                        {
                            name : this.entity.name,
                            address : this.entity.address,
                            phone : this.entity.phone
                        }, 
                        {
                            headers: {
                                'Content-Type': 'application/json',
                        },
                    })
                    .then((response) => {
                        toastr.success(response.data.message, 'Success');
                    })
                    .catch((error) => {
                        if (error.response) {
                            toastr.error(error.response.data.message, 'Error')
                        }
                        
                        if (axios.isCancel(error)) {
                            return;
                        }
                    });
            },
            deleteEntity()
            {
                axios
                    .delete('/api/entity/' + this.entityId)
                    .then((response) => {
                        toastr.success(response.data.message, 'Success');
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1500);
                    })
                    .catch((error) => {
                        if (error.response) {
                            toastr.error(error.response.data.message, 'Error');
                        }
                        
                        if (axios.isCancel(error)) {
                            return;
                        }
                    }
                );
            }
        }
    }
</script>