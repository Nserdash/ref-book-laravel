@extends('layouts.app')
@if(Route::is('journal'))
    @section('title', 'Справочник')
@elseif(Route::is('journals.notpublicated'))
    @section('title', 'Черновики')
@elseif(Route::is('journals.authors' ))   
    @section('title', 'Публикации автора')
@endif
@section('content')

<div class = "max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
    @if(Route::is('journal'))
        <form action = "{{ route('journal.add') }}" method = "post">@csrf<input class = "bg-gray-700 appearance-none rounded text-white leading-tight focus:outline-none focus:bg-gray-500 py-2 px-4 hover:bg-black  transition duration-300 ease-in-out" value = "Добавить журнал +" type = "submit"></form>
    @elseif(Route::is('journals.notpublicated'))
        <form action = "{{ route('deleteall') }}" method = "post">@csrf<input  class = "bg-red-500 appearance-none rounded text-white leading-tight focus:outline-none focus:bg-gray-500 py-2 px-4 hover:bg-black  transition duration-300 ease-in-out" onclick = "return shure()" value = "Удалить все черновики" type = "submit">
    @elseif(Route::is('journals.authors' ))   
        <p class = "font-bold text-xl">Публикации автора: @foreach($authornames as $name)  {{ $name->surname }} {{ $name->name }} {{ $name->partonymic }} @endforeach </p>
    @endif
</div>



<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">    
            @foreach($data as $journal)                
            <div class="relative float-left mb-4 flex flex-col justify-between justify-between h-96 overflow-hidden shadow sm:rounded-lg journalcard w-full" style = "@if($journal->img != NULL) background: url(/storage/images/{{ $journal->img }});  background-size:36rem; @else background: url(/images/default.png) no-repeat; background-size:cover; @endif height:40rem;">                        
                <div class = "flex flex-col bg-black bg-opacity-60 p-4 text-white">
                    @if($journal->publicated == 0)
                     <span class = "text-red-400">Не опубликовано</span>
                    @endif
                    <h1 class = "text-2xl font-bold capitalize pb-1">{{ $journal->name }}</h1>
                    <div class = "flex flex-row pb-1"><b class = "pr-2">Описание:</b> <p class = "">{{ $journal->desc }}</p></div>
                    <div class = "flex flex-row pb-1">
                        <b class = "pr-2">Авторы:</b>
                    @foreach($readyauthors as $readyauthor)
                        @if($readyauthor->journal_id == $journal->id)                            
                            <p class = "">{{ $readyauthor->name }} {{ $readyauthor->surname }};&nbsp</p>                            
                        @endif
                    @endforeach                        
                    </div>
                </div>                    
                    
                <div class = "w-full flex flex-row p-2 justify-between bg-white bg-opacity-80 p-4">
                    <p class = "text-gray-600">@if($journal->date_of_publication != NULL){{ date("d.m.Y", strtotime($journal->date_of_publication)) }}@endif</p>

                    <div class = "flex flex-row ">
                    <a href = "{{ route('journal.editpage',[$journal->id]) }}"><img src = "/images/edit.png" class ="cursor-pointer px-2 w-10 h-6"></a>
                    <form action = "{{ route('journal.delete') }}" method = "post" name = "deleteform">
                        @csrf
                        <input class = "hidden" value = "{{ $journal->id}}" name = "id">
                        <input class = "px-2 w-10 h-6" type = "image" src = "/images/delete.png" onclick = "return shure()" name = "journalpage">
                    </form> 
                    </div>
                </div>

            </div>
            @endforeach      
            
            @if(count($data)<1) 
                Нет записей
            @endif
        </div>    
</div>
@endsection
