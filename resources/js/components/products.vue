
<template>
    <div class="hidden lg:block container mx-auto mt-10  ">
        <div class="container flex justify-between">
            <span class="text-xl">
                Melhores produtos! 
            </span>
            <a class="flex items-center cursor-pointer">
                <a href="/products" class="px-4">Ver Todos</a>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>
        <hr class="border-b-2 border-[#212844] w-1/5 rounded-full my-3" />

        <div class="flex justify-between overflow-hidden">

            <!-- Card de produtos -->
            <div class="w-[34vh] h-[45vh] my-10 mx-5 px-4 pb-4 bg-white rounded-lg duration-200 border border-gray-300 hover:shadow-lg cursor-pointer"
                style="position: relative;">



                <div class="h-3/5 relative">

                    <div class=" w-full flex items-center justify-between h-1/5">
                        <div class="flex mx-1 items-center">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                            <span class="text-gray-500">(0)</span>
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-full h-4/5 bg-gray-100 ">
                        <img class="" src="" alt="">
                    </div>

                </div>

                <div class="w-full h-2/5 flex flex-wrap p-2 text-lg ">

                    <div class="h-4/5 w-full">
                        <div class="flex items-center w-full overflow-hidden h-3/6">
                            <span class="text-base">Aqui vai o nome do Produto 1 </span>
                        </div>
                        <div class="flex items-center w-full border-t-2 border-gray-300 h-3/6">
                            <span class="text-base font-bold text-green-700">R$00,00 </span>
                        </div>
                    </div>

                    <div class="h-1/5 w-full flex items-center">
                        <button class="flex items-center justify-center w-full rounded-lg p-1 bg-[#212844] text-white">
                            <div
                                class="transition-transform transform scale-100 hover:scale-105 flex w-full h-full items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-base font-bold">Adicionar ao carrinho</span>
                            </div>
                        </button>


                    </div>


                </div>
            </div>

            
            <!-- Card de produtos -->
            <div class="w-[34vh] h-[45vh] my-10 mx-5 px-4 pb-4 bg-white rounded-lg duration-200 border border-gray-300 hover:shadow-lg cursor-pointer"
                style="position: relative;">



                <div class="h-3/5 relative">

                    <div class=" w-full flex items-center justify-between h-1/5">
                        <div class="flex mx-1 items-center">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                            <span class="text-gray-500">(0)</span>
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-full h-4/5 bg-gray-100 ">
                        <img class="" src="" alt="">
                    </div>

                </div>

                <div class="w-full h-2/5 flex flex-wrap p-2 text-lg ">

                    <div class="h-4/5 w-full">
                        <div class="flex items-center w-full overflow-hidden h-3/6">
                            <span class="text-base">Aqui vai o nome do Produto 1 </span>
                        </div>
                        <div class="flex items-center w-full border-t-2 border-gray-300 h-3/6">
                            <span class="text-base font-bold text-green-700">R$00,00 </span>
                        </div>
                    </div>

                    <div class="h-1/5 w-full flex items-center">
                        <button class="flex items-center justify-center w-full rounded-lg p-1 bg-[#212844] text-white">
                            <div
                                class="transition-transform transform scale-100 hover:scale-105 flex w-full h-full items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-base font-bold">Adicionar ao carrinho</span>
                            </div>
                        </button>


                    </div>


                </div>
            </div>

            <!-- Card de produtos -->
            <div class="w-[34vh] h-[45vh] my-10 mx-5 px-4 pb-4 bg-white rounded-lg duration-200 border border-gray-300 hover:shadow-lg cursor-pointer"
                style="position: relative;">



                <div class="h-3/5 relative">

                    <div class=" w-full flex items-center justify-between h-1/5">
                        <div class="flex mx-1 items-center">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                            <span class="text-gray-500">(0)</span>
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-full h-4/5 bg-gray-100 ">
                        <img class="" src="" alt="">
                    </div>

                </div>

                <div class="w-full h-2/5 flex flex-wrap p-2 text-lg ">

                    <div class="h-4/5 w-full">
                        <div class="flex items-center w-full overflow-hidden h-3/6">
                            <span class="text-base">Aqui vai o nome do Produto 1 </span>
                        </div>
                        <div class="flex items-center w-full border-t-2 border-gray-300 h-3/6">
                            <span class="text-base font-bold text-green-700">R$00,00 </span>
                        </div>
                    </div>

                    <div class="h-1/5 w-full flex items-center">
                        <button class="flex items-center justify-center w-full rounded-lg p-1 bg-[#212844] text-white">
                            <div
                                class="transition-transform transform scale-100 hover:scale-105 flex w-full h-full items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-base font-bold">Adicionar ao carrinho</span>
                            </div>
                        </button>


                    </div>


                </div>
            </div>

            <!-- Card de produtos -->
            <div class="w-[34vh] h-[45vh] my-10 mx-5 px-4 pb-4 bg-white rounded-lg duration-200 border border-gray-300 hover:shadow-lg cursor-pointer"
                style="position: relative;">



                <div class="h-3/5 relative">

                    <div class=" w-full flex items-center justify-between h-1/5">
                        <div class="flex mx-1 items-center">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                            <span class="text-gray-500">(0)</span>
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-full h-4/5 bg-gray-100 ">
                        <img class="" src="" alt="">
                    </div>

                </div>

                <div class="w-full h-2/5 flex flex-wrap p-2 text-lg ">

                    <div class="h-4/5 w-full">
                        <div class="flex items-center w-full overflow-hidden h-3/6">
                            <span class="text-base">Aqui vai o nome do Produto 1 </span>
                        </div>
                        <div class="flex items-center w-full border-t-2 border-gray-300 h-3/6">
                            <span class="text-base font-bold text-green-700">R$00,00 </span>
                        </div>
                    </div>

                    <div class="h-1/5 w-full flex items-center">
                        <button class="flex items-center justify-center w-full rounded-lg p-1 bg-[#212844] text-white">
                            <div
                                class="transition-transform transform scale-100 hover:scale-105 flex w-full h-full items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-base font-bold">Adicionar ao carrinho</span>
                            </div>
                        </button>


                    </div>


                </div>
            </div>







        </div>
    </div>






    <!-- MOBILE -->


    <div class="lg:hidden pt-10 px-2 px-2">
        <div class="flex justify-between">
            <span class="text-xl">
                Melhores Produtos!
            </span>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>
        <hr class="border-b-2 border-[#212844] w-3/5 rounded-full my-2" />

        <div class="flex overflow-x-scroll">


            <div class="flex h-[32vh] w-auto items-center">

                <!-- Card de produtos -->
                <div class="border mx-2 items-stretch h-5/6">

                    <div class="h-1/6 w-full px-1 flex items-center justify-between">
                        <div class="flex mx-1 items-center">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                            <span class="text-gray-500">(0)</span>
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-[40vh] h-3/6 ">

                        <div class="bg-[#F5F5F5] w-3/6 h-full mx-2">
                            <img src="" alt="">
                        </div>

                        <div class="bg-white w-3/6 h-full">
                            <div class="flex flex-wrap px-4 py-2 text-sm font-bold h-full">
                                <div class="w-full h-2/3 overflow-hidden">
                                    <span class="">Aqui vai o nome do produto 1 </span> <br />
                                </div>

                                <div class="w-full h-1/3 border-t my-2 py-2">
                                    <span class="bold text-green-900">R$00,00</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="h-2/6 w-full px-1 flex items-center">
                        <button
                            class="flex items-center justify-center rounded w-full p-2 bg-[#212844] text-white text-sm font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Adicionar ao carrinho
                        </button>
                    </div>
                </div>



                <!-- Card de produtos -->
                <div class="border mx-2 items-stretch h-5/6">

                    <div class="h-1/6 w-full px-1 flex items-center justify-between">
                        <div class="flex mx-1">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>


                        </div>
                    </div>

                    <div class="flex w-[40vh] h-3/6 ">

                        <div class="bg-[#F5F5F5] w-3/6 h-full mx-2">
                            <img src="" alt="">
                        </div>

                        <div class="bg-white w-3/6 h-full">
                            <div class="flex flex-wrap px-4 py-2 text-sm font-bold h-full">
                                <div class="w-full h-2/3 overflow-hidden">
                                    <span class="">Aqui vai o nome do produto 1 </span> <br />
                                </div>

                                <div class="w-full h-1/3 border-t my-2 py-2">
                                    <span class="bold text-green-900">R$00,00</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="h-2/6 w-full px-1 flex items-center">
                        <button
                            class="flex items-center justify-center rounded w-full p-2 bg-[#212844] text-white text-sm font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Adicionar ao carrinho
                        </button>
                    </div>
                </div>

                <!-- Card de produtos -->
                <div class="border mx-2 items-stretch h-5/6">

                    <div class="h-1/6 w-full px-1 flex items-center justify-between">
                        <div class="flex mx-1">
                            <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                                @mouseout="resetStars" @click="rateProduct(index)">
                                <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="#FED540" class="fill-current text-gray-400">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </span> <!-- Estrelas -->
                        </div>
                        <div class="mx-2 mt-2">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>


                        </div>
                    </div>

                    <div class="flex w-[40vh] h-3/6 ">

                        <div class="bg-[#F5F5F5] w-3/6 h-full mx-2">
                            <img src="" alt="">
                        </div>

                        <div class="bg-white w-3/6 h-full">
                            <div class="flex flex-wrap px-4 py-2 text-sm font-bold h-full">
                                <div class="w-full h-2/3 overflow-hidden">
                                    <span class="">Aqui vai o nome do produto 1 </span> <br />
                                </div>

                                <div class="w-full h-1/3 border-t my-2 py-2">
                                    <span class="bold text-green-900">R$00,00</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="h-2/6 w-full px-1 flex items-center">
                        <button
                            class="flex items-center justify-center rounded w-full p-2 bg-[#212844] text-white text-sm font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Adicionar ao carrinho
                        </button>
                    </div>
                </div>










            </div>


















        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            simple_arrow: '/images/simple_arrow.svg',
            ratedStars: 0,
        };
    },
    methods: {
        fillStars(starCount) {
            this.ratedStars = starCount;
        },

        resetStars() {
            // Reseta as estrelas quando tirar o mouse
            this.ratedStars = 0;
        },

        rateProduct(starCount) {
            console.log(`Rated ${starCount} stars`);
        },
    },
};

</script>