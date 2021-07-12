@extends('layouts.app')
@section('title', 'Авторы')
@section('content')

@include('components.authorsform')


<div class = "w-full flex flex-row justify-center">@if(count($data) < 1) В таблице нет записей @endif</div>

<div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">    

                <div class = "w-full flex flex-col items-end">
                @if($errors->any())
                @foreach($errors->all() as $error)
                <p class = "text-red-400">{{ $error }}</p>
                @endforeach
                @endif
                </div>


                <div class = "w-full flex flex-row p-2 py-4">
                    <div class ="cursor-pointer bg-gray-700 appearance-none rounded text-white leading-tight focus:outline-none focus:bg-gray-500 py-2 px-4 hover:bg-black  transition duration-300 ease-in-out"  onclick = "showpop('.add')">Добавить автора +</div>
                </div>

                <div class="p-4 flex flex-row mb-4 justify-between w-3/4 font-bold">                          
                  <p class = "w-1/3">
                  @if(request()->segment(count(request()->segments())) == 'Авторы')
                  <a href = "{{ route('authors.sortby', 'asc') }}">Фамилия ▾</a>
                  @elseif(request()->segment(count(request()->segments())) == 'asc')
                  <a href = "{{ route('authors.sortby', 'desc') }}">Фамилия ▴</a>
                  @elseif(request()->segment(count(request()->segments()))== 'desc')                                        
                  <a href = "{{ route('authors') }}">Фамилия - </a>
                  @endif
                  </p >
                  <p class = "w-1/3">Имя</p>
                  <p class = "w-1/3">Отчество</p>                  
                </div>


                <div class="overflow-auto overflow-x-hidden overflow-y-scroll scroll">    
                    @foreach($data as $author)  
                    
                      <div class="bg-gray-100 shadow-sm border sm:rounded-lg flex flex-row mb-4 hover:bg-blue-100 mr-4">        

                        <div class = "p-4 flex flex-row justify-between w-3/4">          
                                                         
                          <p class = "w-1/3"><input value = "{{ $author->surname }}" name = "surname" disabled class = "bg-transparent focus:outline-none py-1"></p>                       
                          <p class = "w-1/3"><input value = "{{ $author->name }}"  name = "firstname" disabled class = "bg-transparent focus:outline-none py-1"></p>                          
                          <p class = "w-1/3"><input value = "{{ $author->patronymic }}" name = "patronymic" disabled class = "bg-transparent focus:outline-none py-1"></p>
                          <input value = "{{ $author->id }}" class = "hidden" name = "id" disabled>                         

                        </div>

                        <div class = "flex flex-row items-center justify-end w-1/4 pr-4">
                          <img src = "/images/edit.png" class = "px-2 cursor-pointer" onclick = "showpopedit('.edit',this)">

                          <form action = "{{ route('author.delete') }}" method = "post" name = "deleteform" class = "">
                          @csrf
                          <input class = "hidden" value = "{{ $author->id}}" name = "id">
                          <input class = "px-2" type = "image" src = "/images/delete.png" onclick = "return shure()">
                          </form> 
                          
                            <a href = "{{ route('journals.authors', [$author->id]) }}" class = "text-blue-400">
                            Журналы автора ({{ $author->countjournal }})
                            </a>                       
                        </div> 

                      </div>  

                    @endforeach                                                                                         
                </div>            
                        
        </div>
</div>


@endsection