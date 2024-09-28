<template>
    <SectionContainer>
        <div class="lg:w-[60%] w-full">
            <h1 class="lg:text-5xl text-3xl font-semibold text-primary">
                Customize your plan for just $14.95 each
            </h1>
            <p class="pt-10 font-medium">
                There’s no such thing as “one size fits all,” especially when it
                comes to legal needs. When you purchase the Personal Legal Plan
                as a monthly plan, you have the option to customize it anytime
                with specific supplements that address your needs.
            </p>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-7 mt-10">
            <div
                class="bg-white shadow-md hover:shadow-xl transition-all cursor-pointer py-8 px-10 border-[1px] rounded-xl"
            >
                <h1 class="text-3xl font-semibold">Home business</h1>
                <p class="mt-8">
                    Legal assistance that’s tailored to the unique needs of
                    running your home business.
                </p>
                <Button
                    text="Learn more"
                    :outline="true"
                    class="mt-4"
                    :href="route('home')"
                    type="link"
                />
            </div>
            <div
                class="bg-white shadow-md py-8 hover:shadow-xl transition-all cursor-pointer px-10 border-[1px] rounded-xl"
            >
                <h1 class="text-3xl font-semibold">Trial defense</h1>
                <p class="mt-8">
                    Because trials can be expensive and time consuming, you have
                    the option to add on additional trial defense support.
                </p>
                <Button
                    text="Learn more"
                    :outline="true"
                    class="mt-4"
                    :href="route('home')"
                    type="link"
                />
            </div>
            <div
                class="bg-white shadow-md py-8 hover:shadow-xl transition-all cursor-pointer px-10 border-[1px] rounded-xl"
            >
                <h1 class="text-3xl font-semibold">Ride share & delivery</h1>
                <p class="mt-8">
                    Affordable legal advice and direction to protect your drving
                    record and maintain a safe vehicle.
                </p>
                <Button
                    text="Learn more"
                    :outline="true"
                    class="mt-4"
                    :href="route('home')"
                    type="link"
                />
            </div>
            <div
                class="bg-white shadow-md py-8 hover:shadow-xl transition-all cursor-pointer px-10 border-[1px] rounded-xl"
            >
                <h1 class="text-3xl font-semibold">
                    Protection for gun rights
                </h1>
                <p class="mt-8">
                    Legal defense and protection for your rights to own
                    firearms.
                </p>
                <Button
                    text="Learn more"
                    :outline="true"
                    class="mt-4"
                    :href="route('home')"
                    type="link"
                />
            </div>
        </div>
    </SectionContainer>
</template>

<script>
import Button from '../Atoms/Button.vue';
import SectionContainer from '../Common/SectionContainer.vue';
export default {
    components: { Button, SectionContainer },
};
</script>
