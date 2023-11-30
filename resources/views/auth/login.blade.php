<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GROUP 3 | Admin Login</title>    
    
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/68704db06c.js" crossorigin="anonymous"></script>

</head>
<body>
    <main class="flex h-[100vh] w-full items-center justify-center">
        <div class="flex h-fit w-[500px] max-w-xl flex-col bg-gray-200 px-3 py-5 outline">
          <div class="header">
            <h1 class="py-3 text-center text-3xl font-bold">
                <i class="fa-solid fa-user-tie"></i>
                Login Admin
            </h1>
          </div>
          <form method="post" action="{{route('startLogin')}}">
            @csrf
            @method('post')
        
            @foreach ($errors->all() as $e)
            <div class="msg text-red-500 text-center">
                <i>{{$e}}</i>
            </div>
            @endforeach
            @if(session()->has('msg'))
            <script>
                alert({{Js::from(session('msg'))}});
            </script>
            @endif
            <div class="form-login">
              <div class="input-section flex flex-col gap-2 px-1 py-2">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="p-1 outline" />
              </div>
              <div class="input-section flex flex-col gap-2 px-1 py-2">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="p-1 outline" />
              </div>
              <div class="input-section flex items-center justify-between p-1 pt-4">
                <input type="submit" value="Login" class="w-1/4 bg-stone-50 px-2 py-2 outline font-bold duration-75 hover:scale-[.99] hover:bg-slate-800 hover:text-white hover:cursor-pointer">
                <a href="{{route('/')}}" class="font-light text-blue-800 decoration-solid underline-offset-1 hover:underline">
                    <span class="fa-solid fa-backward fa-beat"></span>
                    Back to Home
                </a>
              </div>
            </div>
          </form>
        </div>
      </main>
</body>
</html>