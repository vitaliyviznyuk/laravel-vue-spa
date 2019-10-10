<template>
    <div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="user_name">Name</label>
                <input id="user_name" v-model="user.name" />
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" type="email" v-model="user.email" />
            </div>
            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                user: {
                    id: null,
                    name: "",
                    email: ""
                }
            };
        },
        methods: {
            onSubmit(event) {
                // @todo form submit event
            }
        },
        created() {
            // @todo load user details
        }
    };
</script>