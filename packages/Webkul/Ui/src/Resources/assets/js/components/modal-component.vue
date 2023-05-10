<template>
    <div class="modal-container" v-if="isOpen">
        <div class="modal-header">
            <slot name="header">
                Default header {{ isOpen }}
            </slot>
            <i class="icon remove-icon" @click="closeModal"></i>
        </div>

        <div class="modal-body">
            <slot name="body">
                Default body
            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['isOpen'],

        inject: ['$validator'],

        created () {
            this.closeModal();
        },

        computed: {
            isModalOpen () {
                this.addClassToBody();

                return this.isOpen;
            }
        },

        methods: {
            closeModal () {
                this.isOpen = false;
            },

            addClassToBody () {
                var body = document.querySelector("body");
                if(this.isOpen) {
                    body.classList.add("modal-open");
                } else {
                    body.classList.remove("modal-open");
                }
            }
        }
    }
</script>