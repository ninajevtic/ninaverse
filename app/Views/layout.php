<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat app</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">-->
    <link href="/ninaverse/public/css/style.css" rel="stylesheet">
    <!-- MDB CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css">
    <!--<link href="/node_modules/mdb-ui-kit/css/mdb.min.css" rel="stylesheet">  MDB5 CSS -->

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <?php include 'components/navigation.php'; ?>
</header>
<main>
    <!-- Proveri da li je `$content` postavljen i prikaži ga -->
    <?php
    if (isset($content)) {
        echo $content;
    } else {
        echo "Content not available";
    } ?>
</main>
<footer>
    <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2024. All rights reserved.
        </div>
        <!-- Copyright -->

        <!-- Right -->
        <div>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        <!-- Right -->
    </div>
</footer>
<script>
    // //ucitavanje chat poruka
    // function loadMessages(chatId) {
    //     fetch(`/ajax.php?action=getMessages&chatId=${chatId}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.status === 'success') {
    //                 const chatContent = document.querySelector('.chat-content');
    //                 chatContent.innerHTML = '';
    //                 data.messages.forEach(msg => {
    //                     const messageDiv = document.createElement('div');
    //                     messageDiv.textContent = `${msg.sender}: ${msg.content}`;
    //                     chatContent.appendChild(messageDiv);
    //                 });
    //             }
    //         });
    // }
    //
    // //ucitavanje korisnika
    // fetch('/ajax.php?action=getAvailableUsers')
    //     .then(response => response.json())
    //     .then(data => {
    //         const usersContainer = document.querySelector('.users');
    //         data.users.forEach(user => {
    //             const userDiv = document.createElement('div');
    //             userDiv.textContent = user.name;
    //             usersContainer.appendChild(userDiv);
    //         });
    //     });
    //
    // //provera sesije
    // setInterval(() => {
    //     fetch('/ajax.php?action=checkSession')
    //         .then(response => response.json())
    //         .then(data => {
    //             if (!data.isLoggedIn) {
    //                 window.location.href = '/login';
    //             }
    //         });
    // }, 60000); // Svakih 60 sekundi

    // Initialization for ES Users
    //import { Collapse, initMDB } from "mdb-ui-kit";
    //initMDB({ Collapse });

</script>
<script src="/ninaverse/public/js/bundle.js" type="module"></script> <!-- JavaScript bundle -->
<!-- jQuery and Bootstrap JavaScript -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>-->
<!-- MDB JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
</body>
</html>
