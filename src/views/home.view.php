<?php
    session_start();
    $username= $_SESSION['name'] ?? '';
    $userId= $_SESSION['user_id'] ?? null;
    if(empty($username)|| empty($userId)) {
        header('Location: /login');
        exit();
    }else{
      $adviceController=new AdviceController();
      $randomAdvice = $adviceController->handle_getRandomAdvice($_SESSION['user_id']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <?php include(__DIR__.'/../../lib/css.php')?>
</head>
<body>
    <header class="text-white py-2 px-4 bg-[var(--blue-600)] ">
        <nav class="flexBetween">
<h1 class="text-[1.2rem] font-medium"><?= $username?> Home </h1>
        <ul class="flexCenter gap-x-[1rem] text-center text-black">
            <li class="hover:scale-110 duration-200 bg-[var(--primary-green)] p-3 rounded-sm "><a href="/advices">Advices Panel</a></li>
            <li class="hover:scale-110 duration-200 bg-[var(--primary-green)] p-3 rounded-sm "><a href="logout">Logout</a>    
        </li>
        </ul>
        </nav>
    </header>
    <main class="flexCenter bg-[var(--blue-900)] min-h-[88vh]">
        <section
          class="flex flex-col bg-slate-700 w-[30rem] items-center h-56 justify-evenly rounded-xl"
        >
          <h1 class="text-[1.4rem] font-bold">ADVICE#<?=$randomAdvice['id']?></h1>
          <p class="text-white text-[1.2rem] italic">
            <q><?=$randomAdvice['content']?></q>
          </p>
          <div id="line_logo">
            <img src="/public/images/pattern-divider-desktop.svg" alt="img" />
          </div>
          <form class="translate-y-[7rem] absolute" action="/home" method="get">
            <button
            class="size-[3rem] hover:scale-110 duration-200 rounded-full grid bg-[var(--primary-green)] place-items-center"
            >
          </form>
            <img src="/public/images/icon-dice.svg" width=25 alt="img" />
          </button>
        </section>
    </main>
</body>
</html>