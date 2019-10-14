<template>
    <div>
        <h1>Create a User</h1>
        <div v-if="message" class="alert">{{ message }}</div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="user_name">Name</label>
                <input id="user_name" v-model="user.name" />
                <div v-if="errors.name" class="error">
                    <p>{{ errors.name ? errors.name[0] : '' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" type="email" v-model="user.email" />
                <div v-if="errors.email" class="error">
                    <p>{{ errors.email ? errors.email[0] : '' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="user_password">Password</label>
                <input id="user_password" type="password" v-model="user.password" />
                <div v-if="errors.password" class="error">
                    <p>{{ errors.password ? errors.password[0] : '' }}</p>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving">
                    {{ saving ? 'Creating...' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</template>
<script>
    import api from '../api/users';

    export default {
        data() {
            return {
                saving: false,
                message: false,
                user: {
                    name: '',
                    email: '',
                    password: '',
                },
                errors: {},
            }
        },
        methods: {
            onSubmit($event) {
                this.saving = true;
                this.message = false;

                api.create(this.user)
                    .then((response) => {
                        this.clearErrors();
                        this.$router.push({
                            name: 'users.edit',
                            params: {
                                id: response.data.data.id
                            }
                        });
                    })
                    .catch((error) => {
                        this.message = error.response.data.message || 'There was an issue creating the user.';
                        this.errors = error.response.data.errors;
                    })
                    .then(() => this.saving = false)
            },
            clearErrors() {
                this.message = null;
                this.errors = {};
            }
        }
    }
</script>
<style lang="scss" scoped>
    $red: lighten(red, 30%);
    $darkRed: darken($red, 50%);
    .form-group {
        margin-bottom: 1em;
        label {
            display: block;
        }
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