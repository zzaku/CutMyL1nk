<?php
    include("./inc/components/header/header.php");
    require_once('./inc/functions/back/addUrl.php');

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    $message = "";
    $isShort = false;

    $submitUrl = filter_input(INPUT_POST, "submitUrl");

    if ($methode == "POST") {

        $submitUrl = filter_input(INPUT_POST, "submitUrl");

        if(isset($submitUrl)){
            [$message, $isShort] = addUrl();
        }
    }
?>

    <div class="desc-container">
        <div class="desc-content">
            <h3><?= $paragraphe ?></h3>
        </div>
        <div class="desc-content">
            <div class="container">
                <div class="typewriter">
                    <h3><?= $slogan ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div id="title">
        <div class="content">
            <div class="content__container">
                <p class="content__container__text">
                Cut
                </p>
                <p class="content__container__text">
                -
                </p>
                <ul class="content__container__list">
                    <li class="content__container__list__item">My</li>
                    <li class="content__container__list__item">mY</li>
                    <li class="content__container__list__item">my</li>
                    <li class="content__container__list__item">MY</li>
                </ul>
                <p class="content__container__text">
                -
                </p>
                <ul class="content__container__list2">
                    <li class="content__container__list__item">L1nk</li>
                    <li class="content__container__list__item">LiNK</li>
                    <li class="content__container__list__item">L1nK</li>
                    <li class="content__container__list__item">LINK</li>
                </ul>
                <p class="content__container__text_dot">
                .
                </p>
                <ul class="content__container__list3">
                    <li class="content__container__list__item">com</li>
                    <li class="content__container__list__item">C0m</li>
                    <li class="content__container__list__item">c0m</li>
                    <li class="content__container__list__item">COM</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="url-input_container">
        <div class="url-input_content">
            <form class="url-input-form-container" method="POST" action="">
                <div class="url-input-form-content">
                    <input class="url-input" type="text" name="url" placeholder="ex: https://cutmyl1nk.fr ">
                    <div class="bars">
                        <div class="bar arrow" style="--rotate:45deg"></div>
                        <div class="bar left" style="--rotate:-45deg;"></div>
                    </div>
                </div>
                <div class="input-submit-url">
                    <input type="submit" name="submitUrl" value="Raccourcir">
                </div>
            </form>
            <?php if($isShort): ?>
                <h4 style="color: #ecf0f191"><?php echo $message ?></h4>
            <?php else: ?>
                <h4 style="color: #721313"><?php echo $message ?></h4>
            <?php endif; ?>
            <h5>Entrer votre url à raccourcir juste au dessus</h5>
        </div>
    </div>
    <script src="./inc/functions/front/deleteContentInput.js"></script>
    <script src="./inc/functions/front/displayingLoginForm.js"></script>
<?php  include("./inc/components/footer/footer.php");?>