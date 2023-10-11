

<template>
  <footer class="w-full h-[65vh] md:flex-shrink-0 bg-[#212844] relative lg:block z-0 overflow-hidden mt-10 hidden">
    <div class="container mx-auto flex justify-between items-center h-5/6 relative">
      <div class="w-[45vh] h-[34vh] flex-shrink-0">
        <img :src="imagePath" alt="">
      </div>

      <div class="w-[38vh] h-[28vh] flex-shrink-0 mr-[35vh]">

        <div class="flex text-white text-xl items-center">
          <img class="px-5 py-8" :src="whatsapp_dark" alt="">
          <span>
            Whats App
            <br>
            (31 8204-1092)
          </span>
        </div>

        <div class="flex text-white text-xl items-center">
          <img class="p-5" :src="call_dark" alt="">
          <span>
            Para ligações
            <br>
            (31 9710-8872)
          </span>
        </div>

        <div class="flex text-white text-xl items-center">
          <img class="p-5" :src="insta_dark" alt="">
          <span>
            @chg_descartaveis
          </span>
        </div>

        <div class="flex text-white text-xl items-center">
          <img class="p-5" :src="mail_dark" alt="">
          <span>
            vendas@chgdescartaveis.com.br
          </span>
        </div>


      </div>
    </div>


    <div class="border-t border-gray-300 my-2 z-30 container mx-auto py-4"></div>

    <div class="container text-white z-30 mx-auto text-center">
      <span class="m-5 text-lg">© {{ getCurrentYear() }} CHG Descartáveis Epi’s Limpeza LTDA.</span>
    </div>




    <section>
      <div id="circle_footer"
        class="w-[50vh] h-[50vh] flex-shrink-1 border-0 rounded-full bg-[#68E500] overflow-hidden z-10"
        style="position: absolute; top: -15vh; right: -15vh;"></div>

      <div id="circle_footer_2"
        class="w-[51.5vh] h-[51.5vh] flex-shrink-1 border-4 border-[#68E500] overflow-hidden rounded-full z-10"
        style="position: absolute; top: -15vh; right: -15vh;"></div>
    </section>




  </footer>








  <!-- MOBILE SECTION -->

  <footer class="w-full h-auto bg-[#212844] overflow-hidden lg:hidden">
    <div class="relative">
      <div class="w-[45vh] h-[34vh]">
        <img :src="imagePath" alt="">
      </div>


      <div class="mb-10 text-lg grid place-items-stretch">

        <div class="flex text-white items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 30 30" class="mx-5">
            <path fill="#fff"
              d="M20.903 17.575c-.319-.164-1.91-.943-2.206-1.049-.296-.111-.512-.164-.726.164-.217.326-.832 1.05-1.026 1.269-.187.217-.378.243-.697.082-1.898-.95-3.144-1.693-4.395-3.84-.33-.572.332-.531.95-1.764.105-.217.052-.402-.03-.566-.082-.164-.726-1.752-.996-2.4-.26-.63-.53-.541-.726-.553-.188-.012-.402-.012-.618-.012-.217 0-.566.082-.862.402-.296.325-1.13 1.107-1.13 2.695 0 1.588 1.157 3.126 1.315 3.343.164.216 2.276 3.474 5.52 4.878 2.05.884 2.853.96 3.878.808.624-.093 1.91-.78 2.177-1.538.267-.756.267-1.403.188-1.538-.08-.143-.296-.226-.616-.38Z" />
            <path fill="#fff"
              d="M27.106 9.914a13.128 13.128 0 0 0-2.822-4.198 13.017 13.017 0 0 0-4.198-2.821A13.062 13.062 0 0 0 15 1.875h-.058a13.095 13.095 0 0 0-9.273 3.879A13.006 13.006 0 0 0 2.88 9.938a13.13 13.13 0 0 0-1.005 5.123 13.166 13.166 0 0 0 1.406 5.857v4.453c0 .744.604 1.348 1.348 1.348h4.456a13.166 13.166 0 0 0 5.857 1.406h.061c1.755 0 3.457-.34 5.06-1.005a13.024 13.024 0 0 0 4.183-2.789 13.095 13.095 0 0 0 3.879-9.272 13.076 13.076 0 0 0-1.02-5.145Zm-4.427 12.832A10.84 10.84 0 0 1 15 25.898h-.05a10.937 10.937 0 0 1-5.07-1.274l-.247-.132H5.508v-4.125l-.132-.246a10.937 10.937 0 0 1-1.274-5.071 10.831 10.831 0 0 1 3.152-7.73 10.816 10.816 0 0 1 7.7-3.22h.05c1.464 0 2.885.285 4.224.847a10.829 10.829 0 0 1 3.486 2.344 10.856 10.856 0 0 1 3.19 7.758 10.857 10.857 0 0 1-3.225 7.696Z" />
          </svg>

          <span>
            (31) 98204-1092
          </span>
        </div>

        <div class="flex text-white items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 30 30" class="mx-5">
            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" fill-opacity="1" stroke-width="2"
              d="M14.415 15.59c4.986 4.986 6.117-.782 9.292 2.391 3.06 3.06 4.82 3.673.942 7.55-.486.39-3.572 5.087-14.418-5.756C-.617 8.93 4.077 5.84 4.467 5.355c3.888-3.888 4.49-2.118 7.551.942 3.175 3.174-2.59 4.308 2.397 9.293Z"
              clip-rule="evenodd" />
            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.941 7.554a5.533 5.533 0 0 1 4.375 4.375" />
          </svg>

          <span>
            (31) 99710-8872
          </span>
        </div>

        <div class="flex text-white items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 30 30" class="mx-5">
            <path fill="#fff" fill-opacity="0.9" stroke="#fff" stroke-width="0"
              d="M15 0c-4.07 0-4.582.019-6.182.09-1.6.075-2.689.326-3.643.698a7.344 7.344 0 0 0-2.657 1.73 7.363 7.363 0 0 0-1.73 2.657C.416 6.128.163 7.219.09 8.813.019 10.415 0 10.925 0 15.002c0 4.072.019 4.582.09 6.182.075 1.597.326 2.687.698 3.641a7.368 7.368 0 0 0 1.73 2.657 7.32 7.32 0 0 0 2.655 1.73c.956.372 2.044.625 3.641.698 1.602.071 2.112.09 6.186.09s4.582-.019 6.184-.09c1.595-.075 2.688-.326 3.643-.698 1-.376 1.906-.967 2.655-1.73a7.369 7.369 0 0 0 1.73-2.657c.37-.954.623-2.044.698-3.641.071-1.6.09-2.11.09-6.184s-.019-4.584-.09-6.186c-.075-1.595-.328-2.686-.698-3.639a7.361 7.361 0 0 0-1.73-2.657 7.333 7.333 0 0 0-2.657-1.73C23.869.416 22.778.163 21.182.09 19.58.019 19.072 0 14.996 0h.006H15Zm-1.344 2.704h1.346c4.005 0 4.48.013 6.06.086 1.462.066 2.257.311 2.786.516.7.272 1.2.598 1.725 1.123.525.525.85 1.023 1.121 1.725.207.527.45 1.322.516 2.784.073 1.58.088 2.055.088 6.058s-.015 4.48-.088 6.06c-.066 1.463-.311 2.256-.516 2.785a4.631 4.631 0 0 1-1.123 1.723 4.635 4.635 0 0 1-1.725 1.121c-.525.206-1.32.45-2.784.518-1.58.07-2.055.088-6.06.088-4.005 0-4.481-.017-6.062-.088-1.462-.068-2.256-.312-2.784-.518a4.645 4.645 0 0 1-1.725-1.121 4.649 4.649 0 0 1-1.125-1.725c-.205-.527-.45-1.322-.516-2.785-.071-1.58-.086-2.055-.086-6.061 0-4.005.015-4.478.086-6.059.067-1.462.311-2.257.518-2.786.271-.7.598-1.2 1.123-1.725a4.634 4.634 0 0 1 1.725-1.121c.528-.206 1.322-.45 2.784-.518 1.384-.063 1.92-.082 4.716-.084v.004Zm9.352 2.49a1.8 1.8 0 1 0 0 3.6 1.8 1.8 0 0 0 0-3.6Zm-8.006 2.104a7.705 7.705 0 1 0-.24 15.407 7.705 7.705 0 0 0 .24-15.407Zm0 2.701a5 5 0 1 1 0 10.002 5 5 0 0 1 0-10.002Z" />
          </svg>
          <span>
            @chg_descartaveis
          </span>
        </div>

        <div class="flex text-white items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 30 30" class="mx-5">
            <g clip-path="url(#a)">
              <path fill="#fff" fill-opacity="1" stroke="#fff" stroke-width="0"
                d="M3.75 3.75A3.75 3.75 0 0 0 0 7.5v15.019a3.75 3.75 0 0 0 3.75 3.731h10.313a.938.938 0 0 0 0-1.875H3.75a1.875 1.875 0 0 1-1.811-1.39l10.575-6.508L15 17.968l13.125-7.875v5.845a.938.938 0 0 0 1.875 0V7.5a3.75 3.75 0 0 0-3.75-3.75H3.75Zm6.953 11.64-8.828 5.432V10.093l8.828 5.297ZM1.875 7.907V7.5A1.875 1.875 0 0 1 3.75 5.625h22.5A1.875 1.875 0 0 1 28.125 7.5v.407L15 15.782 1.875 7.907Z" />
              <path fill="#fff" fill-opacity="1" stroke="#fff" stroke-width="0"
                d="M30 23.438a6.563 6.563 0 1 1-13.125 0 6.563 6.563 0 0 1 13.125 0Zm-3.737-3.149a.938.938 0 0 0-1.286.f23l-2.194 3.656-1.026-1.026a.939.939 0 0 0-1.327 1.328l1.451 1.45a1.407 1.407 0 0 0 2.201-.27l2.504-4.174a.938.938 0 0 0-.323-1.287Z" />
            </g>
            <defs>
              <clipPath id="a">
                <path fill="#fff" d="M0 0h30v30H0z" />
              </clipPath>
            </defs>
          </svg>


          <span>
            vendas@chgdescartaveis.com.br
          </span>
        </div>


      </div>
    </div>




    <div class="border-t border-gray-300 my-2 container mx-auto py-4">

      <div class="container text-white mx-auto text-center">
        <span class="m-5 text-lg">© {{ getCurrentYear() }} CHG Descartáveis Epi’s Limpeza LTDA.</span>
      </div>
    </div>






  </footer>
</template>

<script>
import '../../css/sharp.css';
import '../../css/app.css';

export default {
  data() {
    return {
      imagePath: '/images/logo_dark.svg',
      whatsapp_dark: '/images/whatsapp_dark.svg',
      call_dark: '/images/call_dark.svg',
      insta_dark: '/images/insta_dark.svg',
      mail_dark: '/images/mail_dark.svg',
    };
  },
  methods: {
    getCurrentYear() {
      return new Date().getFullYear();
    },
  },
};
</script>


  