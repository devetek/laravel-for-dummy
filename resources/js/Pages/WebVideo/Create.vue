<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Video
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                                <div class="form-group">
                                    <div>Subject</div>
                                    <input type="text" v-model="form.subject" />
                                    <div v-if="form.errors.subject">
                                        {{ form.errors.subject }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>Link</div>
                                    <input type="text" v-model="form.link" />
                                    <div v-if="form.errors.link">
                                        {{ form.errors.link }}
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
                                        <option disabled value="">
                                            Please select one
                                        </option>
                                        <option value="2">Publish</option>
                                        <option value="1">Draft</option>
                                        <option value="0">Delete</option>
                                    </select>
                                    <div v-if="form.errors.publish">
                                        {{ form.errors.publish }}
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
    setup() {
        const form = useForm({
            subject: null,
            link: null,
            content: null,
            publish: null,
        });

        function submit() {
            Inertia.post("/video", {
                subject: form.subject || '',
                link: form.link || '',
                content: form.content || '',
                publish: parseInt(form.publish, 10),
            });
        }

        return { form, submit };
    },
};
</script>
