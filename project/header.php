<?php  
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "project371");
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style type="text/tailwindcss">
      @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <script>
      (() => {
        let savedTheme = null;
        try {
          savedTheme = localStorage.getItem("theme");
        } catch (error) {
          console.error("Unable to read the saved theme preference.", error);
        }

        const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
        document.documentElement.classList.toggle("dark", savedTheme === "dark" || (savedTheme !== "light" && prefersDark));
      })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body class="bg-white text-neutral-950 dark:bg-neutral-950 dark:text-neutral-50">
    <?php  
        require_once 'navbar.php';
    ?>