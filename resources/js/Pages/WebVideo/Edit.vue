<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ubah Video
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="update">
                            <iput type="hidden" v-model="form.kd_video" />
                            <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                                <div class="form-group">
                                    <div>Subject</div>
                                    <input type="text" v-model="form.subject" />
                                    <div v-if="errors.subject">
                                        {{ errors.subject }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>Link</div>
                                    <input type="text" v-model="form.link" />
                                    <div v-if="errors.link">
                                        {{ errors.link }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>Content</div>
                                    <textarea v-model="form.content" />
                                    <div v-if="errors.content">
                                        {{ errors.content }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>Publish</div>
                                    <select v-model="form.publish">
                                        <option disabled value="">
                                            Please select one
                                        </option>
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
                                >
                                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                <button
                                    v-if="form.kd_video"
                                    class="text-red-600 hover:underline"
                                    tabindex="-1"
                                    type="button"
                                    @click="destroy"
                                >
                                    Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";

export default {
    components: {
        BreezeAuthenticatedLayout,
        LoadingButton,
        TextInput,
    },
    remember: "form",
    props: {
        video: Object,
        errors: Object,
    },
    methods: {
        update() {
            Inertia.put(`/video/${this.form.kd_video}`, {
                subject: this.form.subject,
                link: this.form.link,
                content: this.form.content,
                publish: parseInt(this.form.publish, 10),
            });
        },
        destroy() {
            if (confirm("Are you sure you want to delete this video?")) {
                Inertia.delete(`/video/${this.form.kd_video}`);
            }
        },
    },
    setup(props) {
        const form = useForm({
            kd_video: props.video.kd_video,
            subject: props.video.subject,
            link: props.video.link,
            content: props.video.content,
            publish: parseInt(props.video.publish, 10),
        });

        return { form };
    },
};
</script>
