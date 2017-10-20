@forelse ($posts as $post)
    @include('parts.post')
@empty
    <p>Нет постов для отображения</p>
@endforelse

@if (session()->has('register'))
    <script>alert('Вы успешно зарегистрированы!');</script>
@endif

@if (isset($errors) && count($errors) > 0)
    <div class="">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif