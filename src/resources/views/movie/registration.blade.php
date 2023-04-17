<x-app-layout>
    <div class="container mx-auto text-center">
        <form action="{{ route('movie.complete') }}" method="post">
            @csrf
            <div class="my-8">
                作品名：<input type="text" name="movie_name">
            </div>
            <div class="mb-8">
                映画館：<input type="text" name="cinema">
            </div>
            <div class="mb-8 mr-8">
                メールアドレス：<input type="email" name="email">
            </div>
            <div class="mb-8">
                コメント：<textarea name="comment" cols="30" rows="3"></textarea>
            </div>
            <input type="submit" value="登録" class="py-2 px-8 bg-blue-600 hover:bg-blue-400 rounded-md text-white transition duration-150 cursor-pointer">
        </form>
    </div>
</x-app-layout>
