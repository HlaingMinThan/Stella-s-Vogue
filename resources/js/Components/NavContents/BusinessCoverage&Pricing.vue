<template>
    <div class="px-5">
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>


        <div class="my-8">
            <ul class="space-y-4 list-disc ps-10">
                <li>
                    Starting at 4,950 THB per month
                </li>
                <li>
                    Comprehensive Legal Support: Get extensive legal services to handle the
                    common issues your business faces every day.
                </li>
                <li>
                    Expert Advice and Consultation: Call your provider law firm for consultations on
                    all business-related legal matters, including advice on preexisting issues.
                </li>
                <li>
                    Document Review and Communication: Have your business documents reviewed, receive assistance with letters or phone calls, and get help with collection letters.
                </li>
                <li>
                    Preferred Member Discount: If you need additional legal services beyond what
                    the plan covers, you can receive 10-25% off standard hourly rates from your provider lawyer.
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
// import InertiaLinkButton from '../Atoms/InertiaLinkButton.vue';

export default {
    components: {
        // InertiaLinkButton
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    }
};
</script>

  <style scoped>



  </style>
