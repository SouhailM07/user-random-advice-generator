<?php
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
    <main class="min-h-screen flexCenter bg-[var(--blue-900)]">
        <form  action="/login" method="post" class="flex flex-col text-white w-[28rem] space-y-[1rem]">
                        <h1 class="text-white mb-[1rem]! text-center text-[2rem] textGreen font-bold">Login</h1>
            <?php
            $success = $_GET['success'] ?? '';
            $error = $_GET['error'] ?? '';
            if ($success) {
                echo "<p class='text-green-500 text-center'>$success</p>";
                echo "<script>
                setTimeout(() => {
                window.location.href = '/home'
                }, 2000); // 2 seconds delay
                </script>";
            }
            if ($error) {
                echo "<p class='text-red-500 text-center'>$error</p>";
            }
            ?>
            <div class="space-y-4 flex flex-col ">    
                <label for="name" class=" text-[1.2rem]">Username</label>
                <input required placeholder="..." id="name" name="name" type="text" class="p-2 rounded-md outline-none border-2 border-white">
            </div>
            <div class="space-y-4 flex flex-col">    
                <label for="password" class=" text-[1.2rem]">Password</label>
                <input required placeholder="..." id="password" name="password" type="text" class="p-2 rounded-md outline-none border-2 border-white">
            </div>
            <button class="bg-[var(--primary-green)] p-2 rounded-md text-[1.2rem] text-black hover:scale-110 duration-200">Submit</button>
                    <div>
                 <p class="text-white mt-4 text-center">Dont Have an Account? <a href="/register" class="text-[var(--primary-green)] hover:underline"> Register</a></p>
                </div>
        </form>
    </main>
</body>
</html>