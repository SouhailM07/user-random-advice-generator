<?php
    session_start();
    $username= $_SESSION['name'] ?? '';
    $userId = $_SESSION['user_id'] ?? null; 
    
    $userAdvices= new AdviceController();
    $advices = $userAdvices->handle_getUserAdvices($userId);
    if (!$advices) {
        $advices = [];
    } else {
        $advices = $advices;
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
<body class="bg-[var(--blue-900)] min-h-[88vh]">
        <header class="text-white py-2 px-4 bg-[var(--blue-600)] ">
        <nav class="flexBetween">
<h1 class="text-[1.2rem] font-medium"><?= $username?> Panel </h1>
        <ul class="flexCenter gap-x-[1rem] text-center text-black">
            <li class="hover:scale-110 duration-200 bg-[var(--primary-green)] p-3 rounded-sm "><a href="/home">Home</a></li>
            <li class="hover:scale-110 duration-200 bg-[var(--primary-green)] p-3 rounded-sm "><a href="logout">Logout</a>    
        </ul>
        </nav>
    </header>
    <div >
    <main class="p-[4rem] ">
        <section>
            <form action="advices" method="post" class="flex gap-[1.2rem]">
                <input required placeholder="Enter New Advice" name="advice" type="text" class="text-white border-2 border-white p-2 rounded-md w-full">
                <input name="userId" hidden value="<?=$userId?>" type="number"/>
                <button class="hover:scale-110 duration-200 py-2 px-4 rounded-md bg-[var(--primary-green)]">Create</button>
            </form>
            <article class="mt-[2rem] space-y-[1rem]">
                <div class="flexBetween text-white font-medium">
                    <h1 class="text-[1.2rem] ">Your Advices </h1>
                    <span class="bg-white text-black py-2 rounded text-center w-[5rem]"><?=count($advices)?></span>
                </div>
                <ul class="space-y-[1rem]">
                    <?php foreach ($advices as $advice){ ?>
            <form action="/advices/delete" method="post" class="flex gap-[1.2rem]">
                <p class="text-white border-2 border-white p-2 rounded-md w-full">
                    <?= $advice["content"]?>
                </p>
                <input type="number" name="id" hidden value="<?=$advice['id']?>">
                <button class="hover:scale-110 duration-200 py-2 px-4 rounded-md text-white bg-red-400">Delete</button>
            </form>
                    <?php }; ?>
                </ul>
            </article>
        </section>
    </ma>
    </main>
</body>
</html>