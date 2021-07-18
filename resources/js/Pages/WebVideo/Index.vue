<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pengaturan Web Video
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            class="
                                float-right
                                mb-6
                                flex
                                justify-between
                                items-center
                            "
                        >
                            <inertia-link
                                class="
                                    bg-transparent
                                    hover:bg-blue-500
                                    text-blue-700
                                    font-semibold
                                    hover:text-white
                                    py-2
                                    px-4
                                    border border-blue-500
                                    hover:border-transparent
                                "
                                :href="route('video.create')"
                            >
                                <span>Tambah Video</span>
                            </inertia-link>
                        </div>
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">ID</th>
                                <th class="px-6 pt-6 pb-4">Subject</th>
                                <th class="px-6 pt-6 pb-4">Link</th>
                            </tr>
                            <tr
                                v-for="video in videos"
                                :key="video.kd_video"
                                class="
                                    hover:bg-gray-100
                                    focus-within:bg-gray-100
                                "
                            >
                                <td class="border-t">
                                    <inertia-link
                                        class="
                                            px-6
                                            py-4
                                            flex
                                            items-center
                                            focus:text-indigo-500
                                        "
                                        :href="
                                            route('video.edit', video.kd_video)
                                        "
                                    >
                                        {{ video.kd_video }}
                                        <icon
                                            v-if="video.kd_video"
                                            name="trash"
                                            class="
                                                flex-shrink-0
                                                w-3
                                                h-3
                                                fill-gray-400
                                                ml-2
                                            "
                                        />
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link
                                        class="
                                            px-6
                                            py-4
                                            flex
                                            items-center
                                            focus:text-indigo-500
                                        "
                                        :href="
                                            route('video.edit', video.kd_video)
                                        "
                                    >
                                        {{ video.subject }}
                                        <icon
                                            v-if="video.kd_video"
                                            name="trash"
                                            class="
                                                flex-shrink-0
                                                w-3
                                                h-3
                                                fill-gray-400
                                                ml-2
                                            "
                                        />
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link
                                        class="px-6 py-4 flex items-center"
                                        :href="
                                            route('video.edit', video.kd_video)
                                        "
                                        tabindex="-1"
                                    >
                                        {{ video.link }}
                                    </inertia-link>
                                </td>
                                <td class="border-t w-px">
                                    <inertia-link
                                        class="px-4 flex items-center"
                                        :href="
                                            route('video.edit', video.kd_video)
                                        "
                                        tabindex="-1"
                                    >
                                        <icon
                                            name="cheveron-right"
                                            class="block w-6 h-6 fill-gray-400"
                                        />
                                    </inertia-link>
                                </td>
                            </tr>
                            <tr v-if="videos.length === 0">
                                <td class="border-t px-6 py-4" colspan="4">
                                    Tidak ada video ditemukan.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import throttle from "lodash.throttle";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";

export default {
    components: {
        BreezeAuthenticatedLayout,
    },
    props: {
        videos: Object,
    },
};
</script>
