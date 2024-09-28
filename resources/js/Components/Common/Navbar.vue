<template>
    <div id="navbar"
         class="flex sticky z-50 top-0 py-3.5 xl:py-0 left-0 w-full items-center justify-between bg-black lg:px-10 px-5"
    >
        <div class="flex items-center gap-x-10">

            <div
                class="xl:hidden md:block hidden cursor-pointer"
                @click="toggleMobileDrawer"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="38"
                    height="38"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#afafaf"
                        d="M4 17.27v-1h16v1zm0-4.77v-1h16v1zm0-4.77v-1h16v1z"
                    />
                </svg>
            </div>

            <Link :href="route('home')" @click="closeAllDrawers">
                <img
                    src="/tlp-logo.png"
                    alt=""
                    class="md:w-[60px] w-[50px]"
                />
            </Link>

            <!-- Desktop View -->
            <div class="xl:block hidden">

                <div class="flex items-center font-bold text-white space-x-3">
                    <div
                        v-for="(navLink,index) in navLinks"
                        :key="index"
                        @mouseover="hovering = navLink?.parentText"
                        @mouseleave="hovering = ''"

                        class="py-5"
                    >
                        <div v-if="navLink.parentText!=='Pricing'" class="relative px-[20px] py-[13px] transition-all cursor-pointer rounded-lg hover:bg-primary flex items-center space-x-3"
                             @click="toggleDrawer(navLink.parentText, null, navLink.children)"
                             :class="{
                                 'bg-primary': navLink.parentText === hovering,
                             }">
                            <span>

                                {{ navLink.parentText }}
                            </span>

                            <svg
                                class="hidden fill-current sm:block"
                                width="12"
                                height="8"
                                viewBox="0 0 12 8"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                                    fill=""
                                />
                            </svg>

                        </div>

                        <Link
                            v-else
                            :href="route('get-started')"
                            as="button"
                            class="relative px-[30px] py-[13px] block transition-all cursor-pointer rounded-lg hover:bg-primary"
                            :class="{
                                'bg-primary': navLink.parentText === hovering,
                            }"
                        >
                            {{ navLink.parentText }}

                        </Link>
                    </div>
                </div>
            </div>


        </div>
        <div class="flex items-center gap-3 text-white">
            <div class="sm:block hidden mr-3">
                <LanguageSelectBox/>
            </div>
            <div
                ref="cart"
                data-cy="shopping-cart-btn"
                @click="isCartOpen ? toggleCart(false) : toggleCart(true)"
                class="w-[35px]  shrink-0 relative h-[35px] bg-[#AFAFAF] transition-all rounded-full flex items-center justify-center"
                v-if="(!$page.props.auth?.user || $page.props.auth?.user?.role?.slug === 'user')
                    && (!$page.props.auth?.user?.current_plans || !$page.props.auth?.user?.current_plans.length)"

            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="currentColor"
                        d="M7.308 21.116q-.633 0-1.067-.434t-.433-1.066t.433-1.067q.434-.433 1.067-.433t1.066.433t.434 1.067t-.434 1.066t-1.066.434m9.384 0q-.632 0-1.066-.434t-.434-1.066t.434-1.067q.434-.433 1.066-.433t1.067.433q.433.434.433 1.067q0 .632-.433 1.066q-.434.434-1.067.434M5.881 5.5l2.669 5.616h6.635q.173 0 .307-.087q.135-.087.231-.24l2.616-4.75q.115-.212.019-.375q-.097-.164-.327-.164zm-.489-1h13.02q.651 0 .98.532q.33.531.035 1.095l-2.858 5.208q-.217.365-.564.573t-.763.208H8.1l-1.215 2.23q-.154.231-.01.5t.433.27h10.884v1H7.308q-.875 0-1.306-.738t-.021-1.482l1.504-2.68L3.808 3.5H2v-1h2.442zm3.158 6.616h7z"
                    />
                </svg>
                <div
                    v-if="cart?.length"
                    data-cy="cart-items-count"
                    class="w-[20px] z-50 top-0 absolute right-0 translate-y-[-30%] translate-x-[30%] h-[20px] flex items-center justify-center rounded-full bg-primary text-white font-bold"
                >
                    {{ cart?.length }}
                </div>


                <!-- Cart Start -->
                <div
                    ref="cart"
                    @click.stop
                    :class="[
                        isCartOpen
                            ? 'opacity-1 visible'
                            : 'opacity-0 invisible',
                        $page.props.auth?.user ? 'left-[-210px] sm:left-[-400px]  2xsm:w-[365px] xs:left-[-250px] 2xsm:left-[-248px] xsm:left-[-250px] mbs:w-[300px] mbs:left-[-190px]' : 'left-[-280px] sm:left-[-420px] 2xsm:w-[365px] 2xsm:left-[-203px] xsm:left-[-240px] mbs:w-[300px] mbs:left-[-150px]'
                    ]"
                    class="w-[380px] sm:w-[500px]  shadow-lg top-[200%] cart transition absolute bg-white rounded-lg text-black py-4 px-7 2xsm:px-10 "
                >
                    <!-- tringle -->
                    <div
                        :class="[$page.props.auth?.user ? 'right-[130px] sm:right-[40px] mbs:right-[60px]' : 'right-[60px] sm:left-[410px] xs:left-[240px] xsm:left-[250px] 2xsm:left-[190px]  mbs:left-[140px]']"
                        class="absolute  w-[50px] h-[50px] rotate-45 top-[-10px] bg-white"
                    ></div>
                    <div v-if="cart?.length">
                        <div
                            class="flex relative z-[3] items-center justify-between font-bold text-lg"
                        >
                            <p>Plan</p>
                            <p>Price</p>
                        </div>
                        <div class=" flex flex-col gap-3 mt-3">
                            <div
                                :key='index'
                                v-for="(item,index) in cart"
                                class="flex items-start rounded-lg justify-between bg-[#F7F7F7] py-4 px-4"
                            >
                                <div>
                                    <p
                                        class="xsm:text-lg flex items-center gap-2 font-bold mbs:text-base mbs:gap-0"
                                    >
                                        {{ item?.name }}
                                        <span class="text-xs capitalize"
                                        >({{ item?.price?.billing_period }})</span
                                        >
                                    </p>
                                    <Link :href="`${item?.slug}-plan/coverage-and-pricing#plans`" class="text-primary text-sm font-medium"
                                    >
                                        View Details
                                    </Link
                                    >
                                </div>
                                <div class="sm:flex sm:items-center sm:gap-4">
                                    <p class="text-md sm:text-lg font-medium">${{ formatMoney(item?.price?.amount) }}</p>
                                    <div class="flex justify-end">
                                        <svg
                                            class="cursor-pointer"
                                            @click="deleteCartItem(item)"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="28"
                                            height="28"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-[2px] bg-gray-400 my-7"></div>

                        <div
                            class="flex items-center justify-between text-lg font-semibold my-7"
                        >
                            <p>Total Due Today</p>
                            <p>${{ formatMoney(totalPrice) }}</p>
                        </div>

                        <div class="py-5 space-y-3">
                            <NormalButton data-cy="go-to-checkout-btn" @click="checkoutHandler" class="!rounded-md !py-4 shadow-none bg-primary text-white w-full">
                                Go To Checkout
                                <i class="fa-solid fa-arrow-right ml-1"></i>
                            </NormalButton>

                            <InertiaLinkButton :href="route('get-started')" @click="toggleCart(false)" class="!rounded-md !py-4 shadow-none bg-gray-100 border border-gray-200 text-darkGray block w-full">
                                <i class="fa-solid fa-shopping-cart mr-1"></i>
                                Continue Shopping
                            </InertiaLinkButton>

                        </div>
                    </div>
                    <div
                        v-else
                        class="w-full h-[200px] flex items-center justify-center"
                    >
                        <p class=" text-xl sm:text-3xl font-bold text-gray-400">No Items</p>
                    </div>
                </div>
            </div>

            <a href="tel:+6622518135" class="ml-3 hidden md:block"> <i class="fa-solid fa-phone mr-1.5"></i>+66 2251 8135</a>

            <div v-if="!$page.props.auth?.user" class="hidden lg:flex items-center justify-between space-x-4 ml-4">
                <Link data-cy="get-started-btn" :href="route('get-started')" as="button" class="cursor-pointer font-semibold text-sm px-5 py-2.5 rounded-full transition-all bg-primary text-white flex items-center space-x-2">
                    <i class="fas fa-rocket"></i>
                    <span>Get Started</span>
                </Link>
                <Link data-cy="nav-login-btn" :href="route('login')" as="button" class="cursor-pointer font-semibold text-sm px-5 py-2.5 rounded-full transition-all bg-[#AFAFAF] text-white flex items-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </Link>
            </div>

            <div v-else class="ml-4">
                <UserDropdown/>

            </div>
            <div v-if="!$page.props.auth?.user" class="lg:hidden block">
                <Link :href="route('login')" as="button"   @click=" isMobileNavOpen = false" class="cursor-pointer shrink-0 w-full font-semibold text-sm px-8 py-3 rounded-full transition-all bg-primary text-white flex items-center justify-center space-x-2">
                    <span>Login</span>
                </Link>
            </div>
            <!-- <div
                class="xl:hidden md:block hidden cursor-pointer"
                @click="toggleMobileDrawer"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="38"
                    height="38"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="currentColor"
                        d="M4 17.27v-1h16v1zm0-4.77v-1h16v1zm0-4.77v-1h16v1z"
                    />
                </svg>
            </div> -->
        </div>


    </div>

    <div v-if="drawerOpen || nestedDrawerOpen || secNestedDrawerOpen || mobileDrawerOpen || thirdNestedDrawerOpen" class="overlay"
         :class="$page.props.auth?.user ? 'z-50' : 'z-50'"
         @click="closeAllDrawers"></div>


    <div :class="{'drawer-container': true, 'drawer-open': drawerOpen}">

        <div class="side-drawer bg-black text-white overflow-y-scroll">
            <div class="drawer-content">
                <button class="float-end" @click="closeAllDrawers">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <ul class="px-4 mt-8">
                    <li v-for="(child, index) in drawerChildren" :key="index" class="py-3">
                        <Link
                            :href="child.childLink"
                            class="cursor-pointer rounded-lg w-full"
                            @click="toggleNestedDrawer(child)"
                        >
                            <span class="flex items-center text-xl transition-all p-3 rounded-lg hover:bg-primary font-bold">
                                <span class="flex-grow">{{ child.childText }}</span>
                                <svg
                                    v-if="child.children"
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="24px"
                                    viewBox="0 -960 960 960"
                                    width="24px"
                                    fill="#fff"
                                    class="ml-2 flex-shrink-0"
                                    style="vertical-align: middle;"
                                >
                                    <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                                </svg>
                            </span>

                        </Link>
                        <hr v-if="index === filteredItems.length - 1" class="mt-4">
                    </li>
                </ul>

            </div>
        </div>
        <div class="nested-drawer bg-white text-white" :class="{'drawer-open': nestedDrawerOpen}"
             :style="{maxHeight: '90vh'}"
        >
            <div class="drawer-content">

                <ul>
                    <li v-for="(child, index) in nestedDrawerChildren" :key="index" class="py-5">
                        <Link :href="child.childLink"
                              class="text-xl font-bold transition-all cursor-pointer rounded-lg p-3 hover:bg-primary"
                        >{{ child.childText }}</Link>
                    </li>
                </ul>
            </div>
        </div>


        <div class="sec-nested-drawer overflow-y-scroll bg-black text-white" :class="{'sec-drawer-open': secNestedDrawerOpen}">

            <button @click="secNestedDrawerOpen = false" class="xl:hidden flex text-md text-primary ps-5 items-center space-x-1 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#CC8809"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                <span>back</span>
            </button>

            <div class="drawer-content">
                <div v-if="mobileCurrentChild">
                    <NavContent :type="mobileCurrentChild.component" :data="mobileCurrentChild.data" />

                </div>

                <ul v-else class="px-4 mt-8">
                    <li v-for="(child, index) in secNestedDrawerChildren" :key="index" class="py-5"
                    >
                        <Link :href="child.childLink"
                              @click="toggleThirdNestedDrawer(child)"
                              class="text-xl font-bold transition-all cursor-pointer rounded-lg p-3 hover:bg-primary"

                        >
                            <span class="hidden">
                                {{ child.childText }}

                            </span>
                            <span class="xl:hidden flex items-center transition-all text-balance rounded-lg hover:bg-primary">
                                {{ child.childText }}
                                <svg
                                    v-if="child.children"
                                    xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff" class="ml-2 font-light">
                                    <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                                </svg>
                            </span>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>



    </div>


    <!-- smaller devices -->

    <div :class="{'drawer-container': true, 'drawer-open': mobileDrawerOpen}">
        <div class="side-drawer  overflow-y-auto scroll bg-black text-white">
            <div class="drawer-content">

                <button class="float-end pe-5" @click="closeMobileDrawer">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <ul class="px-4 mt-8">
                    <li v-for="(navLink, index) in navLinks" :key="index" class="py-5">
                        <Link
                            class=" transition-all cursor-pointer rounded-lg p-3 flex items-center w-full"
                            @click="toggleMobileNestedDrawer(navLink.children)">
                            <span class="flex items-center text-xl font-bold transition-all p-3 text-balance">
                                <span class="flex-grow">
                                    {{ navLink.parentText }}

                                </span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff" class="ml-2 font-light">
                                    <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                                </svg>
                            </span>
                        </Link>
                    </li>
                </ul>

            </div>
        </div>



        <div class="lg:hidden third-nested-drawer overflow-y-auto scroll bg-black text-white" :class="{'third-drawer-open': thirdNestedDrawerOpen}">
            <button @click="thirdNestedDrawerOpen = false" class="xl:hidden flex text-md items-center text-primary ps-9 space-x-1 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#CC8809"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                <span>back</span>
            </button>

            <div class="drawer-content">
                <ul class="px-4 mt-8">
                    <li v-for="(child, index) in thirdNestedDrawerChildren" :key="index" class="py-5">
                        <a :href="child.childLink" class="text-xl font-bold transition-all cursor-pointer rounded-lg p-3 hover:bg-primary">{{ child.childText }}</a>
                    </li>
                </ul>
            </div>
        </div>



        <!-- nav content -->
        <!-- <div v-if="navDrawerOpen" class="nav-content overflow-y-auto scroll bg-white text-black" :class="{'nav-drawer-open': navDrawerOpen}">

            <div class="drawer-content">
                <div>
                    <NavContent />

                </div>
            </div>
        </div> -->
    </div>
    <div class="nested-drawer overflow-y-auto scroll bg-neutral-900 text-white" :class="{'drawer-open': nestedDrawerOpen}"
         :style="{ width: currentChild ? '800px' : '400px', maxHeight: '90vh' }"
    >
        <button @click="this.nestedDrawerOpen = false" class="xl:hidden flex items-center text-md text-primary ps-9 space-x-1 mt-8 font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#CC8809"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
            <span> back </span>
        </button>

        <div class="drawer-content">

            <div v-if="currentChild && currentChild.isContent" class="lg:block">

                <NavContent :type="currentChild.component" :data="currentChild.data" />

            </div>

            <ul v-else class="">
                <li v-for="(child, index) in nestedDrawerChildren" :key="index" class=""
                >
                    <!-- Should Close  -->
                    <Link :href="child.childLink"
                          @click="toggleNestedDrawer(child)"
                          class="text-xl font-bold transition-all cursor-pointer p-3 w-full flex items-center"

                    >
                        <span class="flex items-center transition-all text-balance p-3 rounded-lg w-full hover:bg-primary">
                            <span class="flex-grow">
                                {{ child.childText }}
                            </span>
                            <svg
                                v-if="child.children"
                                xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff" class="ml-2 font-light">
                                <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                            </svg>
                        </span>
                    </Link>
                    <hr v-if="index === filteredNestedItems.length - 1" class="w-[300px] flex mx-auto">

                </li>
            </ul>
        </div>
    </div>


    <div class="sm:hidden sticky top-[67px] z-[10] flex items-center justify-between px-5 py-2 bg-black/90 text-white">
        <div
            class=" cursor-pointer"
            @click="toggleMobileDrawer"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="38"
                height="38"
                viewBox="0 0 24 24"
            >
                <path
                    fill="currentColor"
                    d="M4 17.27v-1h16v1zm0-4.77v-1h16v1zm0-4.77v-1h16v1z"
                />
            </svg>
        </div>


        <div class="block mr-3">
            <LanguageSelectBox/>
        </div>


    </div>
</template>

<script>
import UserDropdown from '../Organisms/UserDropdown.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { mapGetters, mapMutations } from 'vuex';
import getTotalPrice from '../../Helpers/getTotalPrice';
import NormalButton from '@/Components/Atoms/NormalButton.vue';
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';
import {onClickOutside} from '@vueuse/core';
import formatMoney from '@/Helpers/formatMoney';
import LanguageSelectBox from '@/Components/Global/LanguageSelectBox.vue';
import { navLinks } from '@/Data/navLinks.js';
import NavContent from './NavContent.vue';

export default {
    components: {
        Link,
        UserDropdown,
        NormalButton,
        InertiaLinkButton,
        LanguageSelectBox,
        NavContent
    },
    data() {
        return {
            mobileDrawerOpen: false,
            drawerOpen: false,
            drawerTitle: '',
            secNestedDrawerOpen: false,
            thirdNestedDrawerOpen: false,
            thirdNestedDrawerChildren: [],
            thirdNestedDrawerTitle: '',
            nestedDrawerChildren: [],
            secNestedDrawerChildren: [],
            drawerContent: '',
            drawerChildren: [],
            currentOpenTitle: '',
            nestedDrawerOpen: false,
            selectedLanguage: this.$page.props.language,
            hovering: '',
            childHovering: '',
            isMobileNavOpen: false,
            navContent: false,
            navDrawerOpen:false,
            currentChild: null,
            mobileCurrentChild: null,
            navLinks
        };
    },

    computed: {
        ...mapGetters(['cart','isCartOpen']),
        totalPrice() {
            return getTotalPrice(this.cart);
        },
        goToPayment(){
            return usePage().props.auth.user && !usePage().props.auth.user.current_plans.length;
        },
        showShoppingCart(){
            return !usePage().props.auth.user || (usePage().props.auth.user&&!usePage().props.auth.user.current_plans.length);
        },

        filteredItems() {
            return this.drawerChildren.filter(item => item.component);
        },

        filteredNestedItems() {
            return this.nestedDrawerChildren.filter(item => item.component);
        }
    },
    methods: {
        ...mapMutations(['deleteCartItem','toggleCart']),
        handleLanguageChange(event) {
            this.selectedLanguage = event.target.value;
            this.$inertia.post(route('language.store'), {
                language: this.selectedLanguage,
            });
        },
        checkoutHandler(){
            if(this.goToPayment){
                router.get(route('auth.payment'));
            }else{
                router.get(route('auth.account'));
            }
            this.toggleCart(false);
        },
        toggleDrawer(title, content, children) {
            if (this.drawerOpen && this.currentOpenTitle === title) {
                this.closeDrawer();
                this.closeNestedDrawer();
            } else {
                this.closeAllDrawers();
                setTimeout(() => {
                    this.drawerTitle = title;
                    this.drawerContent = content;
                    this.drawerChildren = children;
                    this.currentOpenTitle = title;
                    this.drawerOpen = true;
                }, 300);
            }
        },


        toggleMobileDrawer() {
            this.mobileDrawerOpen = !this.mobileDrawerOpen;
        },

        toggleNestedDrawer(child) {
            if (child.isContent && this.nestedDrawerOpen == true && this.nestedDrawerTitle == child.childText){
                this.closeNestedDrawer();
                this.closeSecNestedDrawer();
                this.nestedDrawerOpen = false;
            }
            else if(!child.isContent && child.component) {
                setTimeout(() => {
                    this.closeAllDrawers();

                }, 500);
            } else if (child.isContent && !child.childLink) {
                this.closeNestedDrawer();
                this.closeSecNestedDrawer();
                setTimeout(() => {
                    this.nestedDrawerOpen = true;
                    this.nestedDrawerTitle = child.childText;
                    this.currentChild = child;
                    // this.nestedDrawerChildren = [];
                    console.log(this.nestedDrawerOpen);
                }, 300);
            }
            else if(this.nestedDrawerOpen && this.nestedDrawerTitle === child.childText) {
                this.currentChild = null;
                this.nestedDrawerOpen = false;
                this.closeNestedDrawer();
                this.closeSecNestedDrawer();
            }
            else if(child.childText&&child.childLink)
            {
                this.closeAllDrawers();
            }
            else {
                this.closeNestedDrawer();
                this.closeSecNestedDrawer();
                this.currentChild = null;

                setTimeout(() => {
                    this.nestedDrawerOpen = true;
                    // this.navDrawerOpen = false;
                    this.nestedDrawerTitle = child.childText;
                    this.nestedDrawerChildren = child.children;
                    // this.nestedDrawerChildren = children.children || [];
                }, 300); // Shortened timeout to avoid lag
            }

            // this.closeAllDrawers();
        },


        toggleMobileNestedDrawer(children) {
            console.log(children);

            if (this.nestedDrawerOpen) {
                this.closeNestedDrawer();
            } else {
                // this.closeAllDrawers();
                setTimeout(() => {
                    // this.nestedDrawerTitle = title;
                    this.nestedDrawerChildren = children;
                    this.nestedDrawerOpen = true;
                }, 300);
            }
        },

        toggleSecNestedDrawer(child) {
            console.log(child);
            if(child.isContent)
            {
                this.mobileCurrentChild = child;
                this.secNestedDrawerOpen = true;
                // this.nestedDrawerTitle = '';
                // this.nestedDrawerChildren = [];
            } else if(this.secNestedDrawerOpen && this.nestedDrawerTitle === child.childText) {
                this.closeSecNestedDrawer();

            } else if(!child.children) {
                this.secNestedDrawerOpen = false;
                this.mobileCurrentChild = child;
            } else {

                // this.closeSecNestedDrawer();
                // this.nestedDrawerOpen = false;
                this.mobileCurrentChild = null;
                setTimeout(() => {
                    this.secNestedDrawerChildren = child.children;
                    this.nestedDrawerTitle = child.childText;
                    this.secNestedDrawerOpen = true;

                }, 300);
            }
        },

        toggleThirdNestedDrawer(child) {
            console.log(child);
            if(this.thirdNestedDrawerOpen && this.thirdNestedDrawerTitle === child.childText)
            {
                this.thirdNestedDrawerOpen = false;
            } else {
                this.thirdNestedDrawerOpen = false;
                this.thirdNestedDrawerTitle = child.childText;
                this.thirdNestedDrawerChildren = child.children;
                this.thirdNestedDrawerOpen = true;
            }
            // this.thirdNestedDrawerOpen = !this.thirdNestedDrawerOpen;

        },

        closeSecNestedDrawer() {
            this.secNestedDrawerOpen = false;
            this.mobileCurrentChild = null;
        },


        closeCurrentDrawer() {
            this.closeNestedDrawer();
        },

        closeDrawer() {
            this.drawerOpen = false;
            this.closeNestedDrawer();
            this.closeSecNestedDrawer();
            this.navDrawerOpen = false;
        },
        closeAllDrawers() {
            this.closeDrawer();
            this.closeSecNestedDrawer();
            this.navDrawerOpen = false;
            this.closeMobileDrawer();
            this.thirdNestedDrawerOpen = false;
            // this.currentChild = null;
            // this.mobileCurrentChild = null;
        },
        closeMobileDrawer() {
            this.mobileDrawerOpen = false;
            this.closeNestedDrawer();
        },
        closeNestedDrawer() {
            this.nestedDrawerOpen = false;
            this.currentChild = null;
            this.mobileCurrentChild = null;
        },
        isNestedDrawerOpen(title) {
            return this.currentNestedTitle === title;
        },





        formatMoney
    },
    mounted() {
        onClickOutside(this.$refs.cart,() => {
            this.toggleCart(false);
        });
        this.handleScroll = () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-black-scroll');
            } else {
                navbar.classList.remove('bg-black-scroll');
            }
        };

        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    },
};
</script>
<style>
.bg-black-scroll {
        background-color: black !important;
        transition: background-color 0.3s;
    }


    .drawer-container {
        position: relative;
        overflow: hidden;
      }

      /* Drawer */
      .side-drawer {
        position: fixed;
        top: 30;
        left: 0;
        width: 400px;
        height: 100%;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin-left: -400px;
        padding-bottom: 70px;
        transition: margin-left 0.3s ease;
      }

      .side-drawer.drawer-open {
        transform: translateX(0);
      }

      .nested-drawer {
        position: fixed;
        top: 30;
        left: 0;
        width: 400px;
        height: 100%;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 999;
        margin-left: -800px;
        transition: margin-left 0.3s ease;
      }

      .nav-content {
        position: fixed;
        top: 30;
        left: 0;
        width: 800px;
        height: 100%;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 999;
        margin-left: -400px;
        transition: margin-left 0.3s ease;
      }


      .sec-nested-drawer {
        position: fixed;
        top: 30;
        left: 0;
        width: 400px;
        height: 100%;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 800;
        margin-left: -800px;
        transition: margin-left 0.3s ease;
      }





      .overlay {
        position: fixed;
        top: 30;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
      }

      .nested-drawer.drawer-open {
        margin-left: 400px;
      }

      .nav-content.nav-drawer-open {
        margin-left: 400px;
      }

      .sec-nested-drawer.sec-drawer-open {
        margin-left: 800px;
      }

      /* When drawer is open */
      .drawer-open .side-drawer {
        margin-left: 0;
      }

      /* Drawer Content */
      .drawer-content {
        padding: 20px;
      }




 @media (max-width: 1025px) {
        .nested-drawer {
            position: fixed;
            top: 30;
            left: 0;
            width: 400px;
            height: 100%;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1200;
            padding-bottom: 100px;
            margin-left: -400px;
            transition: margin-left 0.3s ease;
          }

          .nested-drawer.drawer-open {
            margin-left: 0px;
          }

          .sec-nested-drawer {
            position: fixed;
            top: 30;
            left: 0;
            width: 400px;
            height: 100%;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1400;
            margin-left: -400px;
            padding-bottom: 70px;

            transition: margin-left 0.3s ease;
          }

          .sec-nested-drawer.sec-drawer-open {
            margin-left: 0px;
          }


          .third-nested-drawer {
            position: fixed;
            top: 30;
            left: 0;
            width: 400px;
            height: 100%;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1400;
            margin-left: -400px;
            padding-bottom: 70px;

            transition: margin-left 0.3s ease;
          }

          .third-nested-drawer.third-drawer-open{
            margin-left: 0px;
          }

      }
</style>
