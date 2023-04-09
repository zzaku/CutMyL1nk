<?php
    include("./inc/components/header/header.php");
    require_once('./inc/functions/back/getMyShortUrls.php');
    require_once('./inc/functions/back/getSumNbrClic.php');
    
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
                <div class='card flex-row open'>
                    <div class='flex-column info-container'>
                        <div class='link-original'>
                            <h3><?php echo $domain ?></h3>
                        </div>
                        <hr/>
                        <div class='link-copy'>
                            <h3><input id="short-link" type="text" class="form-control" value="localhost/CutMyLink/<?php echo $shortUlr['short_url'] ?>"></h3>
                        </div>
                        <div class='link-redirect'><a href=<?php echo $shortUlr['short_url'] ?>>CutMyLink/<?php echo $shortUlr['short_url'] ?></a></div>
                        <hr />
                        <div class='date-link'><span>Crée le <?php echo $shortUlr['created_at'] ?></span></div>
                    </div>
                    <div class="flex-column QRcode-container">
                        <div class="box">
                            <h3>QR Code Generator</h3>
                            <hr />
                            <div class="sqrcode"></div>
                            <div class="qrcode" id="qrcode-link<?php echo $key ?>"></div>
                        </div>
                    </div>
                    <div class='flex-column preview-container'>
                        <div class='link-preview'>
                            <h3>Preview</h3>
                            <hr />
                            <iframe id="preview-link-frame<?php echo $key ?>"
                                width="100%"
                                height="100%"
                                src=<?php echo $shortUlr['short_url'] ?>>
                            </iframe>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php  include("./inc/components/footer/footer.php");?>

<script src="./inc/functions/front/generateQrCode.js"></script>
