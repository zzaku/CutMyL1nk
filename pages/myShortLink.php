<?php
    include("./inc/components/header/header.php");
    require_once('./inc/functions/back/getMyShortUrls.php');
    require_once('./inc/functions/back/getSumNbrClic.php');

    if(!isset($_SESSION['userId'])){
        header('location: /index.php?page=home');
        exit();
    }
    
    [$message, $myShortUlrs, $messageNbrClic];
    ?>

    <script >
        let myShortUrlsArray = <?php echo json_encode($myShortUlrs); ?>;
    </script>

    <div class="user-info-urls-container">

        <div class="list-user-url-container">
            <?php if(!isset($myShortUlrs)): ?>
                <h2><?php echo $message ?></h2>
            <?php endif; ?>
            <?php include("./inc/components/graph/graph.php"); ?>
        </div>

        <div class='container'>
            <div class='center list flex-column'>
                <?php foreach($myShortUlrs as $key=>$shortUlr): ?>
                <?php 
                    require('./inc/functions/back/getOnlyHostName.php'); 
                    [$domain];
                ?>
                <script>
                    let iframeShortUrl<?php echo json_encode($key); ?> = 'preview-link-frame' + <?php echo json_encode($key); ?>;
                </script>
                <div class='card flex-row open' style="box-shadow: <?php echo !$shortUlr['is_active'] ? 'rgb(175 31 31) 3px 3px 6px 0px inset, rgb(255 255 255 / 50%) -3px -3px 6px 1px inset' : null ?>">
                    <div class='flex-column info-container' style="border: <?php echo !$shortUlr['is_active'] ? 'rgb(175 31 31) 2px solid' : null ?>">
                        <div class='link-original'>

                            <?php if($shortUlr['is_active']): ?>
                            <a href=<?php echo './inc/functions/back/deactivateLink.php?url=' . $shortUlr['short_url'] ?>><button>Desactiver</button></a>
                            <?php endif; ?>

                            <?php if(!$shortUlr['is_active']): ?>
                            <a href=<?php echo './inc/functions/back/activateLink.php?url=' . $shortUlr['short_url'] ?>><button>Activer</button></a>
                            <?php endif; ?>

                            <h3><?php echo $domain ?></h3>
                            <a href=<?php echo './inc/functions/back/deleteLink.php?url=' . $shortUlr['short_url'] ?>><button>Supprimer</button></a>

                        </div>
                        <hr/>
                        <div class='link-copy'>
                            <h3><input id="short-link" type="text" class="form-control" value="cutmyl1nk.fr/<?php echo $shortUlr['short_url'] ?>"></h3>
                        </div>
                        <div class='link-redirect'><a href=<?php echo $shortUlr['short_url'] ?>><?php echo $shortUlr['short_url'] ?></a></div>
                        <hr />
                        <div class='date-link'><span>Crée le <?php echo $shortUlr['created_at'] ?></span></div>
                    </div>
                    <div class="flex-column QRcode-container" style="border: <?php echo !$shortUlr['is_active'] ? 'rgb(175 31 31) 2px solid' : null ?>">
                        <div class="box">
                            <h3>QR Code Generator</h3>
                            <hr />
                            <div class="sqrcode"></div>
                            <div class="qrcode" id="qrcode-link<?php echo $key ?>"></div>
                        </div>
                    </div>
                    <div class='flex-column preview-container' style="border: <?php echo !$shortUlr['is_active'] ? 'rgb(175 31 31) 2px solid' : null ?>">
                        <div class='link-preview'>
                            <h3>Preview</h3>
                            <hr />
                            <iframe id="preview-link-frame<?php echo $key ?>"
                                width="100%"
                                height="100%"
                                src=<?php echo 'https://' . $shortUlr['original_url']; ?>>
                            </iframe>
                        </div>
                    </div>
                </div>
                <script>
                    //--------------------- Vérifie si l'iframe à été chargé pour chaque lien ---------------------------------------------
                    /*  let iframe<?php //echo json_encode($key); ?> = document.getElementById(iframeShortUrl<?php //echo json_encode($key); ?>);
                        iframe<?php //echo json_encode($key); ?>.onload = () => {
                            const isLoaded = checkIframeLoaded(iframe<?php //echo json_encode($key); ?>);
                            if (isLoaded) {
                                console.log('L\'iframe a été chargée avec succès');
                            } else {
                                console.log('L\'iframe a été bloquée');
                            }
                        }; */
                    //------------------------------------------------------------------------------------------------------------------------
                </script>
                <script src="./inc/functions/front/checkIframe.js"></script>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php  include("./inc/components/footer/footer.php");?>
<script src="./inc/functions/front/graphChart.js"></script>
<script src="./inc/functions/front/generateQrCode.js"></script>
