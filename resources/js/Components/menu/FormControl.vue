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
                <div>Site URL</div>
                <input type="text" v-model="form.site_url" />
                <div v-if="errors.site_url">
                    {{ errors.site_url }}
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
            ><span v-if="form.kd_menu">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
            <button
                v-if="form.kd_menu"
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
        menu: {
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
            Inertia.post("/menu", {
                name: this.form.name || "",
                site_url: this.form.site_url || "",
            });
        },
        update() {
            Inertia.put(`/menu/${this.form.kd_menu}`, {
                name: this.form.name || "",
                site_url: this.form.site_url || "",
            });
        },
        destroy() {
            if (confirm("Are you sure you want to delete this user?")) {
                Inertia.delete(`/menu/${this.form.kd_menu}`);
            }
        },
    },
    setup(props) {
        const form = useForm({
            kd_menu: props?.menu?.kd_menu ?? 0,
            name: props?.menu?.name ?? "",
            site_url: props?.menu?.site_url ?? "",
        });

        return { form };
    },
};
</script>
