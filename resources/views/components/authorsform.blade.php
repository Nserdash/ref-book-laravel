<div id = "overlay"></div>
<div class="bg-white p-10 shadow border sm:rounded-lg flex flex-col justify-center items-center center-block-abs add">
<div class = "absolute right-2 top-0 cursor-pointer" onclick = "hidepop('.add')">х</div>
<p id = "errors" class = "py-2 text-red-400"></p>
<form action = "{{ route('author.add')}}" method = "post" class="w-full max-w-sm">
@csrf
  <div class="md:flex md:items-center mb-10">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        * Имя
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" autocomplete = "off" name = "firstname" id = "firstname">
    </div>
  </div>
  <div class="md:flex md:items-center mb-10">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
        * Фамилия
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" autocomplete = "off" name = "surname" id = "surname">
    </div>
  </div>
  <div class="md:flex md:items-center mb-14">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
        Отчество
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" autocomplete = "off" name = "patronymic">
    </div>    
  </div>
  <div class="md:flex md:items-center  justify-center">
      <input class="bg-gray-700 cursor-pointer appearance-none rounded w-8/12 py-2 px-4 text-white leading-tight focus:outline-none  focus:border-blue-300 hover:bg-black  transition duration-300 ease-in-out cursor-pointer" type = "submit" value = "Добавить" onclick = "return checkfrom()">
  </div>  
</form>  
</div>



<div class="bg-white p-10 shadow border sm:rounded-lg flex flex-col justify-center items-center center-block-abs edit">
<div class = "absolute right-2 top-0 cursor-pointer" onclick = "hidepop('.edit')">х</div>
<p id = "editerrors" class = "py-2 text-red-400"></p>
<form action = "{{ route('author.edit')}}" method = "post" class="w-full max-w-sm">
@csrf
  <div class="md:flex md:items-center mb-10">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        * Имя
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" autocomplete = "off" name = "firstname" id = "editfirstname">
    </div>
  </div>
  <div class="md:flex md:items-center mb-10">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
        * Фамилия
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" autocomplete = "off" name = "surname" id = "editsurname">
    </div>
  </div>
  <div class="md:flex md:items-center mb-14">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
        Отчество
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" autocomplete = "off" name = "patronymic" id = "editpatronymic">
      <input class = "hidden" name = "id" id = "editid">                         
    </div>    
  </div>
  <div class="md:flex md:items-center  justify-center">
      <input class="bg-gray-700 cursor-pointer appearance-none rounded w-8/12 py-2 px-4 text-white leading-tight focus:outline-none  focus:border-blue-300 hover:bg-black  transition duration-300 ease-in-out cursor-pointer" type = "submit" value = "Принять изменения" onclick = "return editcheckfrom()">
  </div>  
</form>  
</div>
