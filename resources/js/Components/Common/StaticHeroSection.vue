<template lang="">
    <div class="h-[50vh] flex items-center justify-center relative">
        <img class="w-full z-[10] absolute top-0 left-0 h-full object-cover" src="/StaticHeroImage.jpg" alt="StaticHeroImage" />
        <div class="absolute top-0 z-[20] left-0 w-full h-full bg-[rgba(0,0,0,0.7)]"></div>
        <div class="relative w-full h-full items-center justify-center flex flex-col z-[30]">
            <h1 class="text-4xl font-bold text-white mb-8 text-center">{{title}}</h1>
            <GoToPlanButton :personal="personal"/>
        </div>
    </div>
</template>
<script>
import GoToPlanButton from '@/Components/Common/GoToPlanButton.vue';

export default {
    components : {
        GoToPlanButton
    },
    props : {
        title : {
            type :String
        },
        href:{
            type:String
        },
        personal:{
            type:Boolean,
            default:true
        }
    }

};
</script>
<style lang="">

</style>
