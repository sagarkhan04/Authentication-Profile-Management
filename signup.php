<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | Interactive Cares</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    float: "float 3s ease-in-out infinite",
                    fadeIn: "fadeIn 0.5s ease-in forwards",
                },
                keyframes: {
                    float: {
                        "0%, 100%": {
                            transform: "translateY(0px)"
                        },
                        "50%": {
                            transform: "translateY(-10px)"
                        },
                    },
                    fadeIn: {
                        from: {
                            opacity: 0,
                            transform: "translateY(10px)"
                        },
                        to: {
                            opacity: 1,
                            transform: "translateY(0)"
                        },
                    },
                },
            },
        },
    };
    </script>
    <style>
    body {
        overflow-x: hidden;
    }

    .glass {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .input-focus:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-cyan-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center animate-float">
            <div
                class="mx-auto bg-gradient-to-r from-indigo-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-white">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Create Account
            </h1>
            <p class="mt-2 text-gray-600">Join us today to get started</p>
        </div>

        <div class="bg-white glass rounded-2xl shadow-xl p-8 transition-all duration-300 hover:shadow-2xl">
            <!-- Registration Form -->
            <form class="space-y-6 animate-fadeIn" method="POST" action="register_post.php">

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <input type="text" name="name" placeholder="John Doe"
                            class="w-full pl-3 pr-3 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent input-focus transition-all duration-300">
                    </div>
                    <?php if(isset($_SESSION['name_error'])){
                        echo '<p class="text-red-500 text-sm mt-1">'.$_SESSION['name_error'].'</p>';
                        unset($_SESSION['name_error']);
                    } ?>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" placeholder="you@example.com"
                            class="w-full pl-3 pr-3 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent input-focus transition-all duration-300">
                    </div>
                    <?php if(isset($_SESSION['email_error'])){
                        echo '<p class="text-red-500 text-sm mt-1">'.$_SESSION['email_error'].'</p>';
                        unset($_SESSION['email_error']);
                    } ?>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full pl-3 pr-3 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent input-focus transition-all duration-300">
                    </div>
                    <?php if(isset($_SESSION['pass_error'])){
                        echo '<p class="text-red-500 text-sm mt-1">'.$_SESSION['pass_error'].'</p>';
                        unset($_SESSION['pass_error']);
                    } ?>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="confirm_password" placeholder="••••••••"
                            class="w-full pl-3 pr-3 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent input-focus transition-all duration-300">
                    </div>
                    <?php if(isset($_SESSION['cn_password_error'])){
                        echo '<p class="text-red-500 text-sm mt-1">'.$_SESSION['cn_password_error'].'</p>';
                        unset($_SESSION['cn_password_error']);
                    } ?>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input id="terms" name="terms" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="terms" class="ml-3 text-gray-700 text-sm">
                        I agree to the
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                        and
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
                    </label>
                </div>
                <?php if(isset($_SESSION['terms_error'])){
                    echo '<p class="text-red-500 text-sm mt-1">'.$_SESSION['terms_error'].'</p>';
                    unset($_SESSION['terms_error']);
                } ?>

                <!-- Submit Button -->
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                    Create Account
                </button>

                <!-- General Error / Success -->
                <?php
                if(isset($_SESSION['registration_error'])){
                    echo '<p class="text-red-500 text-sm mt-2">'.$_SESSION['registration_error'].'</p>';
                    unset($_SESSION['registration_error']);
                }
                if(isset($_SESSION['registration_success'])){
                    echo '<p class="text-green-500 text-sm mt-2">'.$_SESSION['registration_success'].'</p>';
                    unset($_SESSION['registration_success']);
                }
                ?>

            </form>
        </div>

        <!-- Login link -->
        <div class="text-center text-sm text-gray-600">
            <p>
                Already have an account?
                <a href="login.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>
</body>

</html>