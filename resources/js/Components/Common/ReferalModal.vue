<template lang="">
    <Modal :open="open" contentClasses="!px-0 !py-0" @closeModal="$emit('closeModal')" :can-close-backdrop="true" >
        <div class="pb-5 relative text-black">
            <div class="bg-yellow-500 pl-10 py-6">
                <h1 class="text-3xl font-normal">Membership Reward</h1>
            </div>
            <div class="pr-10 pl-10 relative mt-3">
                <h1 class="text-xl font-normal">Thai Legal Protection Member Perks Program</h1>
                <div class="pt-4 space-y-2">
                    <ul>
                        <li>
                            <strong>Exclusive Discounts Worldwide:</strong>

                            Enjoy discounts on a wide range of products and services, including travel, dining, electronics, fashion, and more from top brands around the globe.</li>
                    </ul>
                    <p>It’s our way of adding extra value to your membership.</p>
                    <p>This one is for member reward program</p>
                </div>

                <p class="pt-4 pb-2 font-medium">Referal Code:</p>
                <div class="flex gap-5 items-center">
                    <input type="text" id="referalcode"  class="w-[150px]" disabled value="YVCG9A">
                    <svg v-if="!isCopied" @click="copyReferCode" class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M8.5 3.5v-1a1 1 0 0 0-1-1h-1m-2.5 9H1.5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h1m10 4h-5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1M6.75.5h-4.5l.41 1.62a.49.49 0 0 0 .48.38h2.72a.49.49 0 0 0 .48-.38zm1.75 8h3m-3 2h3"/></svg>
                    <svg v-else @click="copyReferCode" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 14 14"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M1.424.27A.75.75 0 0 1 2 0h5a.75.75 0 0 1 .738.884l-.024.131A1.5 1.5 0 0 1 9 2.5v.75H7.25a3 3 0 0 0-3 3V11H1.5A1.5 1.5 0 0 1 0 9.5v-7a1.5 1.5 0 0 1 1.286-1.485l-.024-.13a.75.75 0 0 1 .162-.616ZM2.9 1.5l.115.634a.75.75 0 0 0 .738.616h1.496a.75.75 0 0 0 .738-.616l.115-.634z"/><path d="M7.25 4.5A1.75 1.75 0 0 0 5.5 6.25v6c0 .966.784 1.75 1.75 1.75h5A1.75 1.75 0 0 0 14 12.25v-6a1.75 1.75 0 0 0-1.75-1.75zM7.875 8c0-.345.28-.625.625-.625H11a.625.625 0 1 1 0 1.25H8.5A.625.625 0 0 1 7.875 8M8.5 9.875a.625.625 0 1 0 0 1.25H11a.625.625 0 1 0 0-1.25z"/></g></svg>
                </div>
                <p class="pt-3 font-medium"><a href="https://tlprewards.benefithub.com/welcome/signup" target="_blank" class="text-blue-500 cursor-pointer hover:underline transition-all font-bold">Visit Now</a> and paste referal code to create account</p>
            </div>
        </div>
    </Modal>
</template>
<script>
import Modal from '../Atoms/Modal.vue';

export default {
    components : {
        Modal
    },
    props : {
        open : {
            type :Boolean
        },
    },
    methods : {
        copyReferCode(){
            let referalCodeInput = document.getElementById('referalcode');
            navigator.clipboard.writeText(referalCodeInput.value.toString());
            referalCodeInput.select();
            this.isCopied = true;
        },
    }
};
</script>
<style lang="">

</style>
