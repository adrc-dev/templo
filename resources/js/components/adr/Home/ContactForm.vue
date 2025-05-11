<script setup lang="ts">

</script>

<template>
    <section id="contact" class="w-full gradient-bg text-white pb-16">
        <div class="relative z-10">
            <div class="w-[full] max-w-[1200px] mx-auto text-white mb-16">
                <h2 class="text-4xl font-bold text-center mt-16 tracking-tight">
                    ¿Tienes alguna duda?
                </h2>
                <p class="text-2xl text-center tracking-tight mt-2">
                    ¡Entra en contacto!
                </p>
            </div>


            <div class="w-full max-w-[1200px] flex flex-row justify-center items-center mt-8 mx-auto">

                <div class="p-4 w-full md:max-w-[80%] lg:max-w-[60%]">
                    <form>
                        <label for="name" class="block pl-3 text-base font-medium mb-2">Nombre:</label>
                        <input type="text" id="name" name="name" required
                            class="border border-gray-300 rounded-lg p-2 w-full mb-4">

                        <div class="md:flex md:space-x-4">
                            <div class="md:w-1/2">
                                <label for="phone" class="block pl-3 text-base font-medium mb-2">Teléfono:</label>
                                <input type="tel" id="phone" name="phone" required
                                    class="border border-gray-300 rounded-lg p-2 w-full mb-4">
                            </div>
                            <div class="md:w-1/2">
                                <label for="email" class="block pl-3 text-base font-medium mb-2">Email:</label>
                                <input type="email" id="email" name="email" required
                                    class="border border-gray-300 rounded-lg p-2 w-full mb-4">
                            </div>
                        </div>

                        <label for="message" class="block pl-3 text-base font-medium mb-2">Mensaje:</label>
                        <textarea id="message" name="message" rows="4" required
                            class="border border-gray-300 rounded-lg p-2 w-full mb-4"></textarea>

                        <div class="mb-4">
                            <label for="privacy"
                                class="flex pl-3 items-center text-base font-medium text-white cursor-pointer">
                                <input type="checkbox" id="privacy" name="privacy" required class="sr-only peer">

                                <div class="
                                            mr-2 h-5 w-5 rounded border border-gray-300
                                            peer-checked:bg-secondary-color peer-checked:border-secondary-color
                                            flex items-center justify-center
                                            transition-colors duration-200
                                            after:content-['✓'] after:text-primary-color after:text-sm after:font-bold
                                            after:opacity-0 after:transition-opacity
                                            peer-checked:after:opacity-100
                                            "></div>

                                <span>
                                    Al enviar este formulario acepto la
                                    <a href="#" class="font-bold hover:text-gray-300">Política de
                                        privacidad</a>.
                                </span>
                            </label>
                        </div>

                        <button type="submit"
                            class="bg-transparent border border-white w-full text-white font-semibold mt-8 py-2 px-4 rounded-lg hover:bg-secondary-color hover:border-secondary-color hover:text-primary-color transition duration-300 cursor-pointer">
                            Enviar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.gradient-bg {
    position: relative;
    overflow: hidden;
}

.gradient-bg::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("@assets/bg-contact-home.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    z-index: 1;
}

.gradient-bg::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(50, 0, 0, 0.7);
    z-index: 2;
}
</style>
