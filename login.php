<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Interactive Cares</title>
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
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Inter", sans-serif;
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

        <!-- Header -->
        <div class="text-center animate-float">
            <div
                class="mx-auto bg-gradient-to-r from-indigo-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-white">
                    <path fill-rule="evenodd"
                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Welcome Back
            </h1>
            <p class="mt-2 text-gray-600">Sign in to your account to continue</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white glass rounded-2xl shadow-xl p-8 transition-all duration-300 hover:shadow-2xl">
            <form class="space-y-6 animate-fadeIn" method="POST" action="login_post.php">

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" placeholder="you@example.com"
                            class="w-full pl-3 pr-3 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent input-focus transition-all duration-300">
                    </div>
                    <?php if (isset($_SESSION['email_error'])) {
                        echo '<p class="text-red-500 text-sm mt-1">' . $_SESSION['email_error'] . '</p>';
                        unset($_SESSION['email_error']);
                    } ?>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Password</label>
                        <a href="#"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors">Forgot
                            password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full pl-3 pr-3 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent input-focus transition-all duration-300">
                    </div>
                    <?php if (isset($_SESSION['pass_error'])) {
                        echo '<p class="text-red-500 text-sm mt-1">' . $_SESSION['pass_error'] . '</p>';
                        unset($_SESSION['pass_error']);
                    } ?>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                    <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                    Sign In
                </button>

                <!-- General error / success -->
                <?php
                // Show logout success when redirected with ?logout=1
                if (isset($_GET['logout']) && $_GET['logout'] == '1') {
                    echo '<div class="p-4 bg-green-50 border border-green-200 rounded-xl flex items-start space-x-3 mb-4">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600 flex-shrink-0">';
                    echo '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
                    echo '</svg>';
                    echo '<div><p class="text-sm font-semibold text-green-800">You have been logged out successfully.</p></div>';
                    echo '</div>';
                } elseif (isset($_SESSION['registration_success'])) {
                    echo '<div class="p-4 bg-green-50 border border-green-200 rounded-xl flex items-start space-x-3 mb-4">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600 flex-shrink-0">';
                    echo '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
                    echo '</svg>';
                    echo '<div><p class="text-sm font-semibold text-green-800">' . $_SESSION['registration_success'] . '</p></div>';
                    echo '</div>';
                    unset($_SESSION['registration_success']);
                } elseif (isset($_SESSION['login_error'])) {
                    echo '<p class="text-red-500 text-sm mt-2">' . $_SESSION['login_error'] . '</p>';
                    unset($_SESSION['login_error']);
                } elseif (isset($_SESSION['login_success'])) {
                    echo '<p class="text-green-500 text-sm mt-2">' . $_SESSION['login_success'] . '</p>';
                    unset($_SESSION['login_success']);
                }
                ?>


            </form>
        </div>

        <!-- Signup Link -->
        <div class="text-center text-sm text-gray-600">
            <p>
                Don't have an account?
                <a href="./signup.php"
                    class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">Sign up</a>
            </p>
        </div>
    </div>
</body>

</html>