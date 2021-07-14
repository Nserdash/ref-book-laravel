<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="icon" type="image/png" sizes="16x16" href="/public/favicon.ico">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <link rel="stylesheet" href = "public/css/app.css">

        <!-- Scripts -->
        <script src="{{ asset('public/js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script>


        function shure() {

            if(confirm('Вы уверены что хотите запись?')) {
                return true
            } else {
                return false
            }

        }

        function checkfrom() {

            var name = document.getElementById('firstname').value
            var surname = document.getElementById('surname').value            
            var error = document.getElementById('errors')
                        

            if(surname == "") {
                error.textContent = 'Поле "Фамилия" обязательно'
                return false;
            }

            if(name == "") {
                error.textContent = 'Поле "Имя" обязательно'
                return false;
            }
            
            if(surname.length < 3) {
                error.textContent = 'Поле "Фамилия" должно содержать хотя бы 3 буквы'
                return false;
            }

        }           


        function editcheckfrom() {

            var name = document.getElementById('editfirstname').value
            var surname = document.getElementById('editsurname').value
            var error = document.getElementById('editerrors')

            if(name == "") {
            error.textContent = 'Поле "Имя" обязательно'
            return false;
            }

            if(surname == "") {
            error.textContent = 'Поле "Фамилия" обязательно'
            return false;
            }

            if(surname.length < 3) {
                error.textContent = 'Поле "Фамилия" должно содержать хотя бы 3 буквы'
                return false;
            }


        }           


        function checkauthor() {

            var publicated = document.getElementById('publicated').value
            var authors = document.getElementById('checkauthors').value
            
            if (publicated==1&&authors<2) {
                alert('В опубликованном журнале должен быть хотя бы 1 автор.');
                return false;
            } else {
                return true;
            }

        }           


        function showpop(selector) {

            document.querySelector(selector).style.setProperty('visibility', 'visible')
                            
            document.querySelector('#overlay').style.setProperty('display', 'block')

            document.querySelector('#overlay').style.setProperty('z-index', '1000')

            document.querySelector(selector).style.setProperty('z-index', '1000')        

            document.querySelector(selector).style.setProperty('opacity', '1')        
            
            document.querySelector(selector).style.setProperty('transition', '0.3s')
            
            document.getElementById('errors').textContent = ''
            

        }

        function hidepop(selector) {

            document.querySelector(selector).style.setProperty('visibility', 'hidden')
            document.querySelector(selector).style.setProperty('opacity', '0')
            document.querySelector(selector).style.setProperty('transition', '0.3s')
            document.querySelector('#overlay').style.setProperty('display', 'none')
        }


        function showpopedit(selector, el) {

            inputs = el.parentNode.parentNode

            var name = inputs.querySelector('[name="firstname"]').value

            var surname = inputs.querySelector('[name="surname"]').value

            var patronymic = inputs.querySelector('[name="patronymic"]').value

            var id = inputs.querySelector('[name="id"]').value
        
            document.querySelector(selector).style.setProperty('visibility', 'visible')                            
            document.querySelector('#overlay').style.setProperty('display', 'block')
            document.querySelector('#overlay').style.setProperty('z-index', '1000')
            document.querySelector(selector).style.setProperty('z-index', '1000')        
            document.querySelector(selector).style.setProperty('opacity', '1')                
            document.querySelector(selector).style.setProperty('transition', '0.3s')    

            document.querySelector('#editfirstname').value = name   
            document.querySelector('#editsurname').value = surname   
            document.querySelector('#editpatronymic').value = patronymic
            document.querySelector('#editid').value = id
            
            document.getElementById('editerrors').textContent = ''

        }


        </script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
        /* Локализация datepicker */
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: 'Предыдущий',
            nextText: 'Следующий',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            weekHeader: 'Не',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);
        </script>

        <script>

        $(function(){
            $(".calenpicker").datepicker();
        });

        </script>

    </head>

    <body class="font-sans antialiased">

        @include('layouts.nav')
        @yield('content')
    
        <script>

            function OpenFileDialog() {
                $('#file-input').trigger('click');
            }
            
            function ReadURL(input,imageSelector) {
            
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $(imageSelector).attr('src', e.target.result);
                    };
            
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file-input").change(function () {
                
                var size = this.files[0].size
                
                if(2000000<size){
                    alert('Файл больше 2МБ')
                    $('#file-input').val("")
                    return false
                } else {
                    ReadURL(this,"#myimage");  
                    var fileVal=document.getElementById("file-input")
                    var fileBtn=document.getElementById("filebutton")
                    var fileNameOld=document.getElementById("filename").childNodes[0]                       
                    fileNameOld.replaceWith('Изображение выбрано')
                }

            });


            $('#select_send').on('change', function() {
                $(this.form).submit();
            });
    

            $(document).ready(function(){
                var inp = document.getElementById("review-text").value.length
                var maxCount = 210;

                $("#counter").html(maxCount);

                $("#review-text").keyup(function() {
                var revText = this.value.length;

                    if (this.value.length > maxCount)
                        {
                        this.value = this.value.substr(0, maxCount);
                        }
                    var cnt = (maxCount - revText);
                    if(cnt <= 0){$("#counter").html('0');}
                    else {$("#counter").html(cnt);}

                });
            });

        </script>       
        
        
                    

    </body>
        
</html>