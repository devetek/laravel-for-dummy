<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <textarea
            :id="id"
            ref="input"
            v-bind="$attrs"
            class="form-textarea"
            :class="{ error: error }"
            :value="value"
            @input="$emit('input', $event.target.value)"
        />
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
                return `textarea-input-${uuidv4()}`;
            },
        },
        value: String,
        label: String,
        error: String,
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
