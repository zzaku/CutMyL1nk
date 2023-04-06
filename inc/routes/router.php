<?php

$page = filter_input(INPUT_GET, "page") ? filter_input(INPUT_GET, "page") : "home";

if(file_exists('./' . 'pages/' . $page . ".php"))
{
    switch($page)
    {
        case "home":

            $data = home();
            break;

        case "myShortLink":

            $data = myShortLink();
            break;
    }
    exit();
}
else
{
    http_response_code(404);
    exit();
}

?>