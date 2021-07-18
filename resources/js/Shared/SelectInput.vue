<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <select
            :id="id"
            ref="input"
            v-model="selected"
            v-bind="$attrs"
            class="form-select"
            :class="{ error: error }"
        >
            <slot />
        </select>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
import { v4 as uuidv4 } from "uuid";

export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `select-input-${uuidv4()}`;
            },
        },
        value: [String, Number, Boolean],
        label: String,
        error: String,
    },
    data() {
        return {
            selected: this.value,
        };
    },
    watch: {
        selected(selected) {
            this.$emit("input", selected);
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },
        select() {
            this.$refs.input.select();
        },
    },
};
</script>
