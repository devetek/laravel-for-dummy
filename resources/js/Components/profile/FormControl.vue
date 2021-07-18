<template>
    <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
            <div class="form-group">
                <div>Subject</div>
                <input type="text" v-model="form.subject" />
                <div v-if="errors.subject">
                    {{ errors.subject }}
                </div>
            </div>
            <div class="form-group">
                <div>Content</div>
                <textarea v-model="form.content" />
                <div v-if="form.errors.content">
                    {{ form.errors.content }}
                </div>
            </div>
            <div class="form-group">
                <div>Publish</div>
                <select v-model="form.publish">
                    <option disabled value="">Please select one</option>
                    <option value="2">Publish</option>
                    <option value="1">Draft</option>
                    <option value="0">Delete</option>
                </select>
                <div v-if="errors.publish">
                    {{ errors.publish }}
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
            ><span v-if="form.kd_profile"
                >&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span
            >
            <button
                v-if="form.kd_profile"
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
        profile: {
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
            Inertia.post("/profile", {
                subject: this.form.subject || "",
                content: this.form.content || "",
                publish: parseInt(this.form.publish, 10),
            });
        },
        update() {
            Inertia.put(`/profile/${this.form.kd_profile}`, {
                subject: this.form.subject || "",
                content: this.form.content || "",
                publish: parseInt(this.form.publish, 10),
            });
        },
        destroy() {
            if (confirm("Are you sure you want to delete this profile?")) {
                Inertia.delete(`/profile/${this.form.kd_profile}`);
            }
        },
    },
    setup(props) {
        const form = useForm({
            kd_profile: props?.profile?.kd_profile ?? 0,
            subject: props?.profile?.subject ?? "",
            content: props?.profile?.content ?? "",
            publish: parseInt(props?.profile?.publish ?? 0, 10) || '',
        });

        return { form };
    },
};
</script>
