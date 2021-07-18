<template>
    <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
            <div class="form-group">
                <div>Nama</div>
                <input type="text" v-model="form.name" />
                <div v-if="errors.name">
                    {{ errors.name }}
                </div>
            </div>
            <div class="form-group">
                <div>Email</div>
                <input type="text" v-model="form.email" />
                <div v-if="errors.email">
                    {{ errors.email }}
                </div>
            </div>
            <div class="form-group">
                <div>Username</div>
                <input type="text" v-model="form.username" />
                <div v-if="errors.username">
                    {{ errors.username }}
                </div>
            </div>
            <div class="form-group">
                <div>Password</div>
                <input type="password" v-model="form.password" />
                <div v-if="errors.password">
                    {{ errors.password }}
                </div>
            </div>
            <div class="form-group">
                <div>Level</div>
                <select v-model="form.level">
                    <option disabled value="">Please select one</option>
                    <option value="3">Admin</option>
                    <option value="2">Editor</option>
                    <option value="1">Author</option>
                    <option value="0">Guess</option>
                </select>
                <div v-if="errors.level">
                    {{ errors.level }}
                </div>
            </div>
        </div>
        <div
            class="
                px-8
                py-4
                bg-gray-50
                border-t border-gray-100
                flex
                justify-end
                items-center
            "
        >
            <loading-button
                :loading="form.processing"
                class="btn-indigo"
                type="submit"
                >Simpan</loading-button
            ><span v-if="form.kd_users">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
            <button
                v-if="form.kd_users"
                class="text-red-600 hover:underline"
                tabindex="-1"
                type="button"
                @click="destroy"
            >
                Hapus
            </button>
        </div>
    </form>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import LoadingButton from "@/Shared/LoadingButton";

export default {
    components: {
        LoadingButton,
    },
    props: {
        action: {
            type: String,
            default: "insert",
        },
        user: {
            type: Object,
            default: null,
        },
        errors: {
            type: Object,
            default: null,
        },
    },
    methods: {
        submit() {
            if (this.action === "insert") {
                this.create();
            } else if (this.action === "update") {
                this.update();
            }
        },
        create() {
            Inertia.post("/user", {
                name: this.form.name || "",
                email: this.form.email || "",
                username: this.form.username || "",
                password: this.form.password || "",
                level: parseInt(this.form.level, 10),
            });
        },
        update() {
            Inertia.put(`/user/${this.form.kd_users}`, {
                name: this.form.name || "",
                email: this.form.email || "",
                username: this.form.username || "",
                password: this.form.password || "",
                level: parseInt(this.form.level, 10),
            });
        },
        destroy() {
            if (confirm("Are you sure you want to delete this user?")) {
                Inertia.delete(`/user/${this.form.kd_users}`);
            }
        },
    },
    setup(props) {
        const form = useForm({
            kd_users: props?.user?.kd_users ?? 0,
            name: props?.user?.name ?? "",
            email: props?.user?.email ?? "",
            username: props?.user?.username ?? "",
            password: props?.user?.password ?? "",
            level: parseInt(props?.user?.level ?? 0, 10),
        });

        return { form };
    },
};
</script>
