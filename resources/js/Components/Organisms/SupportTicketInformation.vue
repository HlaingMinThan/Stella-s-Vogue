<script setup>
import Label from '@/Components/Atoms/Label.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import Textarea from '@/Components/Atoms/Textarea.vue';
import {computed} from 'vue';
import Badge from '@/Components/Atoms/Badge.vue';

const props=defineProps({supportTicket:Object});

const computedSupportTicket=computed(()=>props.supportTicket);
</script>

<!-- 'pending', 'resolving', 'completed' -->
<template>
    <div class="text-darkGray min-w-full space-y-5">
        <div class="flex items-center justify-between space-x-5">

            <h1 class="font-bold text-lg text-darkGray text-center">Customer Support Ticket</h1>

            <Badge
                :success="computedSupportTicket.status === 'completed'"
                :info="computedSupportTicket.status === 'pending'"
                :warning="computedSupportTicket.status === 'resolving'"
            >
                <template
                    v-if="computedSupportTicket.status === 'completed'"
                >
                    <i
                        class="fas fa-check-circle animate-pulse"
                    ></i>
                </template>
                <template
                    v-else-if="computedSupportTicket.status === 'resolving'"
                >
                    <i class="fas fa-clock animate-pulse"></i>
                </template>
                <template
                    v-else-if="computedSupportTicket.status === 'pending'"
                >
                    <i class="fas fa-spinner animate-spin"></i>
                </template>
                {{ computedSupportTicket.status }}
            </Badge>
        </div>


        <div>
            <Label label="Submitter Name" />

            <InputField
                v-model="computedSupportTicket.name"
                type="text"
                disabled
            />
        </div>

        <div>
            <Label label="Submitter Email Address" />

            <InputField
                v-model="computedSupportTicket.email"
                type="text"
                disabled
            />
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <Label label="Membership Number" />

                <InputField
                    v-model="computedSupportTicket.membership_number"
                    type="text"
                    disabled
                />
            </div>

            <div>
                <Label label="Category" />

                <InputField
                    v-model="computedSupportTicket.category"
                    type="text"
                    disabled
                />
            </div>
        </div>

        <div>
            <Label label="Submitted At" />

            <InputField
                v-model="computedSupportTicket.created_at"
                type="text"
                disabled
            />
        </div>

        <div>
            <Label label="Message" />

            <Textarea
                v-model="computedSupportTicket.message"
                disabled
            />
        </div>
    </div>
</template>
