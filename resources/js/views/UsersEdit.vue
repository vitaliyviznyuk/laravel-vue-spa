<template>
    <div>
        <div v-if="error" class="error">
            <p>{{ error }}</p>
        </div>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="! loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <label for="user_name">Name</label>
                <input id="user_name" v-model="user.name" />
                <div v-if="errors.name" class="error">
                    <p>{{ errors.name }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" type="email" v-model="user.email" />
                <div v-if="errors.email" class="error">
                    <p>{{ errors.email }}</p>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving">Update</button>
                <button :disabled="saving" @click.prevent="cancel">Cancel</button>
            </div>
        </form>
    </div>
</template>
<script>
    import api from '../api/users';

    export default {
        data() {
            return {
                message: null,
                loaded: false,
                saving: false,
                error: null,
                errors: {
                    name: null,
                    email: null
                },
                user: {
                    id: null,
                    name: "",
                    email: ""
                },
            };
        },
        methods: {
            onSubmit(event) {
                this.saving = true;

                api.update(this.user.id, {
                    name: this.user.name,
                    email: this.user.email,
                }).then((response) => {
                    this.clearErrors();
                    this.message = 'User updated';
                    setTimeout(() => history.back(), 2000);
                    this.user = response.data.data;
                }).catch(error => {
                    this.error = error.response.data.message;
                    this.errors.name = error.response.data.errors.hasOwnProperty('name') ? error.response.data.errors.name[0] : null;
                    this.errors.email = error.response.data.errors.hasOwnProperty('email') ? error.response.data.errors.email[0] : null;
                }).then(_ => this.saving = false);
            },
            cancel() {
                history.back();
            },
            clearErrors() {
                this.error = null;
                this.errors.name = null;
                this.errors.email = null;
            }
        },
        created() {
            api.find(this.$route.params.id).then((response) => {
                this.loaded = true;
                this.user = response.data.data;
            });
        }
    };
</script>
<style lang="scss" scoped>
    $red: lighten(red, 30%);
    $darkRed: darken($red, 50%);
    .form-group label {
        display: block;
    }
    .alert {
        background: $red;
        color: $darkRed;
        padding: 1rem;
        margin-bottom: 1rem;
        width: 50%;
        border: 1px solid $darkRed;
        border-radius: 5px;
    }
</style>