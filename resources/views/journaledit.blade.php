@extends('layouts.app')
@section('title', 'Справочник')
@section('content')

<div class="">
    <div class="max-w-7xl mx-auto sm:px-8 lg:px-8 mb-4">    

    <div class = "w-1/2 flex flex-col items-end">
        @if($errors->any())
        @foreach($errors->all() as $error)
            <p class = "text-red-400">{{ $error }}</p>
        @endforeach
        @endif
    </div>

            @foreach($data as $journal)

            @if($journal->publicated == 0)
            <p class = "text-red-400 py-8">Черновик</p>
            @else
            <p class = "text-blue-400 py-8">Опубликовано</p>
            @endif
            <div class="flex flex-row justify-start w-full">
                    
                <div class = "w-1/3">                    
                    @if($journal->img!=NULL)
                    <img src = "/storage/images/{{ $journal->img }}" class ="shadow sm:rounded-lg w-full"  id="myimage">
                    @else 
                    <img src = "/images/default.png" class ="shadow sm:rounded-lg w-full"  id="myimage">
                    @endif
                </div>

                <div class = "flex flex-col justify-center items-center w-1/2">
                    <form action = "{{ route('journal.edit') }}" method = "post" class="w-full max-w-sm" enctype="multipart/form-data">
                    @csrf
                    <div class="md:flex md:items-center mb-10">
                        <div class="md:w-1/3">
                        <label class="block text-gray-500 font-normal md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Название *
                        </label>
                        </div>
                        <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" value = "{{ $journal->name }}" autocomplete = "off" name = "name">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-10">
                        <div class="md:w-1/3">
                        <label class="block text-gray-500 font-normal md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                            Описание<br>(210 символов)
                        </label>
                        </div>
                        <div class="md:w-2/3">
                        <textarea class="max-h-40 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"  name = "desc" id = "review-text">{{ $journal->desc }}</textarea>
                        <div class="counter text-gray-400">Осталось символов: <span id="counter"></span></div>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-14">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-normal md:text-right mb-1 md:mb-0 pr-4">
                            Картинка
                            </label>
                        </div>                    
                        <div class="md:w-2/3">
                            <input type = "file" name = "img" accept=".jpg,.png" id="file-input" class = "hidden">
                            <div class = "flex flex-row">
                                <div onclick="OpenFileDialog();" class = "mr-2 bg-gray-700 cursor-pointer w-6/12 text-center rounded py-2 px-4 text-white focus:bg-gray-500"  id = "filebutton"> Выбрать </div>
                                <div class = "text-gray-400" id = "filename">@if($journal->img == NULL) Изображение не выбрано @else Изображение выбрано @endif</div>
                            </div>
                        </div>    
                    </div>                    
                    <div class="md:flex md:items-center mb-10">
                        <div class="md:w-1/3">
                        <label class="block text-gray-500 font-normal md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                            Авторы *
                        </label>
                        </div>
                        <div class= "hidden">{{ $textauthor = NULL; }}</div>
                        <div class="md:w-2/3">                        
                            <div class = "flex flex-col max-w-full">
                                @foreach($authors as $author)                            
                                <p class = "bg-gray-500 mb-2 rounded p-2 text-white flex justify-between">{{ $author->name }} {{ $author->surname }} {{ $author->patronymic }} <a href = "{{ route('deletefromj',[$author->id]) }}" >x</a></p>
                                <div class= "hidden">{{ $textauthor = 1; }}</div>
                                @endforeach
                            </div>                            
                                                    
                        <select class = "bg-gray-200 max-w-full outline-none h-10 rounded" name = "idauthor" id = "select_send">                            
                                <option disabled selected>Добавить автора</option>                                
                            @foreach($allauthors as $author)                            
                                <option value = "{{ $author->id }}">{{ $author->name }} {{ $author->surname }} {{ $author->patronymic }}</option>                                
                            @endforeach                                
                        </select>      

                        <input value = "{{ $textauthor }}" class = "hidden" name = "checkauthors">  

                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-14">
                        <div class="md:w-1/3">
                        <label class="block text-gray-500 font-normal md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                            Дата публикации
                        </label>
                        </div>
                        <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white calenpicker" autocomplete = "off" value = "@if($journal->date_of_publication != NULL) {{ date('d.m.Y', strtotime($journal->date_of_publication)) }} @endif" name = "date">
                        <input class="hidden" value = "{{ $journal->id }}" name = "idjournal">
                        </div>    
                    </div>
                    <div class="md:flex md:items-center justify-between">
                        <input class="bg-gray-700 cursor-pointer appearance-none rounded w-6/12 py-3 px-4 text-white leading-tight focus:outline-none focus:bg-gray-500" type = "submit" value = "Сохранить" name = "save">                        
                        @if($journal->publicated == 0)
                            <div class="bg-gray-700 text-center cursor-pointer appearance-none rounded w-5/12 py-3 px-4 text-white" onclick = "showpop('.add')">Отмена</div>                        
                        @else
                            <a href = "{{ route('journal') }}" class="bg-gray-700 text-center cursor-pointer appearance-none rounded w-5/12 py-3 px-4 text-white leading-tight focus:outline-none focus:bg-gray-500 focus:border-blue-300">Отмена</a>
                        @endif                        
                    </div>  
                    <input class="bg-gray-700 cursor-pointer appearance-none rounded w-full py-3 px-4 text-white leading-tight focus:outline-none focus:bg-gray-500 mt-4" type = "submit" value = "Опубликовать" name = "publicate">
                    </form>                      
                </div>                    


            </div>

            <div id = "overlay"></div>
                <div class="bg-white p-4 shadow border sm:rounded-lg flex flex-col justify-center items-center center-block-abs add">
                    <div class = "absolute right-2 top-0 cursor-pointer" onclick = "hidepop('.add')">х</div>
                    <div class = "flex flex-col items-center justify-center w-full pt-4">
                        <div class = "pb-12">Журнал не опубликован. Сохранить черновик?</div>
                        <div class = "flex flex-row w-1/2 justify-between">
                        <a href = "{{ route('journal') }}" class = "bg-gray-700 text-center cursor-pointer appearance-none rounded w-5/12 py-1 px-1 text-white leading-tight flex items-center justify-center">Да</a>
                        <form action = "{{ route('journal.delete') }}" method = "post" name = "deleteform">
                            @csrf
                            <input class = "hidden" value = "{{ $journal->id}}" name = "id">
                            <input class = "bg-gray-700 text-center cursor-pointer appearance-none rounded py-2 px-6 text-white leading-tight" value = "Нет" type = "submit">
                        </form> 
                        </div>
                    </div>
                </div>
            </div>

            @endforeach            
        </div>    
</div>

@endsection
