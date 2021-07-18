<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Produk
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                                <div class="form-group">
                                    <div>Nama</div>
                                    <input type="text" v-model="form.name" />
                                    <div v-if="form.errors.name">
                                        {{ form.errors.name }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>Deskripsi</div>
                                    <textarea v-model="form.description" />
                                    <div v-if="form.errors.description">
                                        {{ form.errors.description }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>Harga</div>
                                    <input type="text" v-model="form.price" />
                                    <div v-if="form.errors.price">
                                        {{ form.errors.price }}
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
            name: null,
            description: null,
            price: null,
        });

        function submit() {
            Inertia.post("/products", {
                name: form.name,
                description: form.description,
                price: parseInt(form.price, 10),
            });
        }

        return { form, submit };
    },
};
</script>
